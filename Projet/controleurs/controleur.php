<?php
    require_once("modeles/gestionnaire_articles.php");
    require_once("modeles/panier.php");

    /*function afficherArticles(){
        //Récupération du nombre d'articles du panier (0 si vide)
        $panier = new Panier(session_id());
        $totalArticles = $panier->compterArticles();
        //Récupération de la liste des articles depuis la BD

        $articles = GestionnaireArticles::getArticles();
        //Chargement de la vue pour affichage des articles
        require("vues/vue_articles.php");
    }*/

    function afficherArticles($identifiant = null, $quantite = null){
        //Si la fonction a été appelée avec des paramètres, cela signifie qu'un article a été ajouté au panier
        //Dans ce cas, on effectue l'ajout avant d'afficher la liste des produits.
        if(isset($identifiant) && isset($quantite)){
            $article = GestionnaireArticles::rechercherArticle($identifiant);
            if(empty($article))
                header("location:index.php?action=0&code=2");
            else{
                $panier = new Panier(session_id()); 
                //Enregistrer l'article dans la table Panier et mise à jour de la quantité disponible
                //$data = $panier->ajouterArticle($identifiant, $quantite);
                $panier->ajouterArticle($identifiant, $quantite);
            }
        }
        //Récupération du nombre d'articles du panier (0 si vide)
        $panier = new Panier(session_id());
        $totalArticles = $panier->compterArticles();
        //Récupération de la liste des articles depuis la BD

        $articles = GestionnaireArticles::getArticles();
        //Chargement de la vue pour affichage des articles
        require("vues/vue_articles.php");
        }
    function afficherDetailsArticle($identifiant){
        //Récupération du nombre d'articles du panier (0 si vide)
        $panier = new Panier(session_id());
        $totalArticles = $panier->compterArticles();
        $article = GestionnaireArticles::getDetailsArticle($identifiant);
        if(empty($article))
            header("location:index.php?action=0&code=1");
        require("vues/vue_details_article.php");
    }

    /*function afficherPanier($identifiant, $quantite){
        $article = GestionnaireArticles::rechercherArticle($identifiant);
        if(empty($article))
            header("location:index.php?action=0&code=2");
        else{
            $panier = new Panier(session_id()); 
            //Enregistrer l'article dans la table Panier et mise à jour de la quantité disponible
            $data = $panier->ajouterArticle($identifiant, $quantite);
            //Récupérer les données de la tables Panier et les passer à la vue pour afficher le panier
            require("vues/vue_panier.php");
        }
    }*/

    function ListerContenuPanier(){
        $panier = new Panier(session_id());
        $data = $panier->getDataPanier();
        require("vues/vue_panier.php");
        
    }
    function ListerContenuCommande(){
        $panier = new Panier(session_id());
        $data = $panier->getDataPanier();
        require("vues/vue_commande.php");
        
    }

    function updateAffichagePanier($operation, $identifiant, $quantite){
        $panier = new Panier(session_id());
        if($operation == 4){
            $panier->modifierArticle($identifiant, $quantite);
            
        }else if($operation == 3){
            $panier->supprimerArticle($identifiant);
        }
    }
    function afficherErreur($erreur){
        require("vues/vue_erreur.php");
    }

    function afficherCoordonnees(){
        require("vues/coordonnees.php");
    }
