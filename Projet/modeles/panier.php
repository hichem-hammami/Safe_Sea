<?php
    require_once("modeles/Database.php");
    class Panier{
        private $idSession;
        
        public function __construct($idSession){
            $this->idSession = $idSession;
            
        }
        
        public function ajouterArticle($identifiant, $quantite){

            $sql = "INSERT INTO Panier VALUES(?, ?, ?)";
            $connexion = Database::connect();
            $requetePreparee = $connexion->prepare($sql);
            $count = $requetePreparee->execute(array($this->idSession, $identifiant, $quantite));
            if($count > 0){
                /*L'insertion de l'article a réussi : on met à jour la quantité disponible dans la table Article et 
                 on affiche alors le panier pour la session courante*/
                 GestionnaireArticles::updateQuantiteArticle($identifiant, $quantite);
            }
            else 
                //On fait une mise à jour de la quantité de l'article déjà dans le panier
                 $this->modifierArticle($identifiant, $quantite + $this->getQuantiteArticlePanier($identifiant));   
            Database::disconnect();
        }

        public function getDataPanier(){
            $connexion = Database::connect();
            $sql = "SELECT Article.identifiant as idArticle, Article.nom as nom, Article.ImageArticle as image,
            Article.prix as prix,  Article.quantiteDisponible as quantiteDisponible, Panier.quantiteArticle as quantite 
            FROM Article, Panier WHERE Article.identifiant = Panier.idArticle AND Panier.identifiant = ?";
            $requetePreparee = $connexion->prepare($sql);
            $requetePreparee->execute(array($this->idSession));
            $data = $requetePreparee->fetchAll();
            Database::disconnect();
            return $data;
        }
        public function supprimerArticle($identifiant){
            $connexion = Database::connect();
            //Suppression de l'article dans la table Panier
            //On récupère la quantité de l'article dans le panier
            $quantite = $this->getQuantiteArticlePanier($identifiant);;
            //Ensuite, suppression de l'article du panier
            $sql = "DELETE FROM Panier WHERE idArticle = ?";
            $requetePreparee = $connexion->prepare($sql);
            $count = $requetePreparee->execute(array($identifiant));
            Database::disconnect();
            if($count > 0){
                //Il faut remetre à jour la quantité disponible de l'article dans la table Article
                $sql = "UPDATE Article SET quantiteDisponible = quantiteDisponible + ? WHERE identifiant = ?";
                $requetePreparee = $connexion->prepare($sql);
                $count = $requetePreparee->execute(array($quantite, $identifiant));
                //Affichage le panier.
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
                /*On récupère la quantite de l'article dans le panier puis on met à jour sa quantité la table article.
                  Enfin, on met à jour la quantité de l'article dans le panier*/
                  $ancienneQuantite = $this->getQuantiteArticlePanier($identifiant);
                  if($ancienneQuantite > 0){
                    //On met à jour la quantité disponible de l'article dans la table Article
                    $sql = "UPDATE Article SET quantiteDisponible = quantiteDisponible + ? WHERE identifiant = ?";
                    $requetePreparee = $connexion->prepare($sql);
                    $count = $requetePreparee->execute(array($ancienneQuantite - $quantite, $identifiant));
                    
                    //On met à jour le panier avec la nouvelle quantité de l'article
                    $sql = "UPDATE Panier SET quantiteArticle =  ? WHERE idArticle = ?";
                    $requetePreparee = $connexion->prepare($sql);
                    $count = $requetePreparee->execute(array($quantite, $identifiant));
                    Database::disconnect();
                    //On réaffiche le panier.
                    header("location:index.php?action=5");
                  }else{//On essaie de mettre à jour un article qui n'existe pas dans le panier : erreur
                    header("location:index.php?action=0&code=4");
                  }
            }
        }

        private function getQuantiteArticlePanier($identifiant){
            $connexion = Database::connect();
            $sql = "SELECT quantiteArticle as quantite FROM Panier WHERE idArticle = ?";
            $requetePreparee = $connexion->prepare($sql);
            $requetePreparee->execute(array($identifiant));
            $quantite = $requetePreparee->fetchColumn(0);
            Database::disconnect();
            return $quantite;
        }
        function compterArticles(){
            $connexion = Database::connect();
            $sql = "SELECT SUM(quantiteArticle) AS totalArticles FROM Panier WHERE identifiant = ?";
            $requetePreparee = $connexion->prepare($sql);
            $requetePreparee->execute(array($this->idSession));
            $totalArticles = $requetePreparee->fetchColumn(0);
            Database::disconnect();
            return $totalArticles;
        }
    }