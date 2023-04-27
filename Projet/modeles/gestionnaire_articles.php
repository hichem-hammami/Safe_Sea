<?php
    require_once("modeles/Database.php");
    class GestionnaireArticles{
        public static function getArticles(){
            //Connexion à la BD Pepiniere en utilisation la methode static connect() de la classe Database
            $connexion = Database::connect();

            //Extraction des informations qui nous intéressent sur les articles
            $requeteSQL = "SELECT identifiant, nom, imageArticle,  prix FROM Article ORDER BY nom";
            $curseur = $connexion->query($requeteSQL);

            //Formatage des données et renvoie du résultat
            $data = [];
            while($ligne = $curseur->fetch()){
                $dataLigne["identifiant"] = $ligne["identifiant"];
                $dataLigne["nom"] = $ligne["nom"];
                //voir après que faire de la catégorie
                $dataLigne["imageArticle"] = $ligne["imageArticle"];
                $dataLigne["prix"] = $ligne["prix"];
                $data[] = $dataLigne;
            }
            $curseur->closeCursor();
            Database::disconnect();

            //On renvoie le résultat
            return $data;
        }

        public static function getDetailsArticle($identifiant){
            $connexion = Database::connect();  
            $requeteSQL = "SELECT * FROM Article WHERE identifiant = ?";
            $requetePreparee = $connexion->prepare($requeteSQL);
            $requetePreparee->execute(array($identifiant));
            Database::disconnect();
            return $requetePreparee->fetchAll();
        }

        public static function updateQuantiteArticle($identifiant, $quantite){
            $connexion = Database::connect(); 
            $sql= "UPDATE Article SET quantiteDisponible = quantiteDisponible - ? WHERE identifiant = ?";
            $requetePreparee = $connexion->prepare($sql);
            $count = $requetePreparee->execute(array($quantite,$identifiant));
            Database::disconnect();

        }
        public static function rechercherArticle($identifiant){
            $article = self::getDetailsArticle($identifiant);
            return $article;                
        }
    }

    
