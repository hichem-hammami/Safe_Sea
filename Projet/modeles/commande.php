<?php
    require_once("modeles/Database.php");
    class Commande{
        private $idSession;
        
        public function __construct($idSession){
            $this->idSession = $idSession;
            
        }
        
        public function ajouterArticle($identifiant, $quantite){

            $sql = "INSERT INTO Commande VALUES(?, ?, ?)";
            $connexion = Database::connect();
            $requetePreparee = $connexion->prepare($sql);
            $count = $requetePreparee->execute(array($this->idSession, $identifiant, $quantite));
            if($count > 0){
                /*L'insertion de l'article a réussi : on met à jour la quantité disponible dans la table Article et 
                 on affiche alors le commande pour la session courante*/
                 GestionnaireArticles::updateQuantiteArticle($identifiant, $quantite);
            }
            else 
                //On fait une mise à jour de la quantité de l'article déjà dans le Commande
                 $this->modifierArticle($identifiant, $quantite + $this->getQuantiteArticleCommande($identifiant));   
            Database::disconnect();
        }

        public function getDataCommande(){
            $connexion = Database::connect();
            $sql = "SELECT Article.identifiant as idArticle, Article.nom as nom, Article.ImageArticle as image,
            Article.prix as prix,  Article.quantiteDisponible as quantiteDisponible, Commande.quantiteArticle as quantite 
            FROM Article, Commande WHERE Article.identifiant = Commande.idArticle AND Commande.identifiant = ?";
            $requetePreparee = $connexion->prepare($sql);
            $requetePreparee->execute(array($this->idSession));
            $data = $requetePreparee->fetchAll();
            Database::disconnect();
            return $data;
        }
        public function supprimerArticle($identifiant){
            $connexion = Database::connect();
            //Suppression de l'article dans la table Commande
            //On récupère la quantité de l'article dans le Commande
            $quantite = $this->getQuantiteArticleCommande($identifiant);;
            //Ensuite, suppression de l'article du Commande
            $sql = "DELETE FROM Commande WHERE idArticle = ?";
            $requetePreparee = $connexion->prepare($sql);
            $count = $requetePreparee->execute(array($identifiant));
            Database::disconnect();
            if($count > 0){
                //Il faut remetre à jour la quantité disponible de l'article dans la table Article
                $sql = "UPDATE Article SET quantiteDisponible = quantiteDisponible + ? WHERE identifiant = ?";
                $requetePreparee = $connexion->prepare($sql);
                $count = $requetePreparee->execute(array($quantite, $identifiant));
                //Affichage le Commande.
                header("location:index.php?action=5");
            }else{//Ici, une erreur est survenu : impossible de supprimer l'article car celui-ci n'existe pas
                header("location:index.php?action=0&code=4");
            }
        }

        public function modifierArticle($identifiant, $quantite){
            $connexion = Database::connect();
            if($quantite == 0)
                $this->supprimerArticle($identifiant, 0);
            else {
                /*On récupère la quantite de l'article dans le Commande puis on met à jour sa quantité la table article.
                  Enfin, on met à jour la quantité de l'article dans le Commande*/
                  $ancienneQuantite = $this->getQuantiteArticleCommande($identifiant);
                  if($ancienneQuantite > 0){
                    //On met à jour la quantité disponible de l'article dans la table Article
                    $sql = "UPDATE Article SET quantiteDisponible = quantiteDisponible + ? WHERE identifiant = ?";
                    $requetePreparee = $connexion->prepare($sql);
                    $count = $requetePreparee->execute(array($ancienneQuantite - $quantite, $identifiant));
                    
                    //On met à jour le Commande avec la nouvelle quantité de l'article
                    $sql = "UPDATE Commande SET quantiteArticle =  ? WHERE idArticle = ?";
                    $requetePreparee = $connexion->prepare($sql);
                    $count = $requetePreparee->execute(array($quantite, $identifiant));
                    Database::disconnect();
                    //On réaffiche le Commande.
                    header("location:index.php?action=5");
                  }else{//On essaie de mettre à jour un article qui n'existe pas dans le Commande : erreur
                    header("location:index.php?action=0&code=4");
                  }
            }
        }

        private function getQuantiteArticleCommande($identifiant){
            $connexion = Database::connect();
            $sql = "SELECT quantiteArticle as quantite FROM Commande WHERE idArticle = ?";
            $requetePreparee = $connexion->prepare($sql);
            $requetePreparee->execute(array($identifiant));
            $quantite = $requetePreparee->fetchColumn(0);
            Database::disconnect();
            return $quantite;
        }
        function compterArticles(){
            $connexion = Database::connect();
            $sql = "SELECT SUM(quantiteArticle) AS totalArticles FROM Commande WHERE identifiant = ?";
            $requetePreparee = $connexion->prepare($sql);
            $requetePreparee->execute(array($this->idSession));
            $totalArticles = $requetePreparee->fetchColumn(0);
            Database::disconnect();
            return $totalArticles;
        }
    }