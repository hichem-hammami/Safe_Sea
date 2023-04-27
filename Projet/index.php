<?php
    session_start();
    require("controleurs/controleur.php");
    if(!isset($_GET["action"]))
        afficherArticles();
    else{
        $action = $_GET["action"];

        if($action == 0){
            /*Une erreur est survenue.*/
            if(isset($_GET["code"])){
                $code = $_GET["code"];
                switch($code){
                    case 1 : $erreur = "L'article sélectionné n'existe pas dans notre catalogue</div>";
                            break;
                    case 2 : $erreur = "L'article que vous essayé d'ajouter n'existe pas dans notre catalogue";
                            break;
                    //A remplacer par une mise à jour de la quantité
                    /*case 3 : $erreur ="L'article que vous essayé d'ajouter est déjà dans le panier";
                             $erreur .=" <a href=../index.php?action=5>Cliquez ici pour voir votre votre panier</a>";
                            break;*/
                    case 3 : $erreur = "L'article que vous essayé de supprimer n'existe pas dans notre catalogue";
                            break;
                    case 4 : $erreur = "L'article que vous essayer de mettre à jour n'existe pas dans le panier";
                            break;
                    default : $erreur = "Erreur inconnue";
                }
            }else
                $erreur = "URL malformée";
            afficherErreur($erreur);
        }else if($action == 1){
            /*Ici, l'utilisateur à demandé l'affichage des détails d'un article. On passe l'indentifiant 
            de ce dernier au contrôleur afin qu'il puisse exécuter l'action correspondant par le biais 
            de la fonction afficherDetailsArticle($id)
            */
            $identifiant = $_GET["id"];
            afficherDetailsArticle($identifiant);
        }else if($action == 2){
            /*Ici, l'utilisateur a ajouté un produit au panier. On récupère les informations sur le produit et 
              on vérifie que celui-ci existe dans notre et on l'ajoute au panier le cas échéant.
            */
            if(isset($_GET["id"]) && isset($_GET["quantite"])){
                $identifiant = $_GET["id"];
                $quantite = $_GET["quantite"];
                //A remplacer par une mise à jour de la quantité d'article dans le panier
                //afficherPanier($identifiant, $quantite);
                //On réaffiche tout simplement la page des produits
                afficherArticles($identifiant, $quantite);
            }else
                afficherErreur("URL incomplète");
        }else if($action == 3){
            if(isset($_GET["id"])){
                $identifiant = $_GET["id"];
                $quantite = $_GET["quantite"];
                updateAffichagePanier(3, $identifiant, $quantite);
                //Suppression de l'article dans la table Panier
                //Penser à restituer la quantité disponible dans la table article
                //Réaffiche le panier
            }
            
        }else if($action == 4){
            //Mise à jour de la quantité d'un article dans le panier
            $identifiant = $_GET["id"];
            $quantite = $_GET["quantite"];
                //Mettre à jour la quantité de l'article dans le panier
                //Penser à mettre à jour la quantité disponible dans la table article
                //Réaffiche le panier
                updateAffichagePanier(4, $identifiant, $quantite);
        }else if($action == 5){
            //On affiche le panier

            ListerContenuPanier();
        }else if($action == 6){
            afficherCoordonnees();
        }else if($action == 7){
            //On affiche le panier

            ListerContenuCommande();
        }
            else{
            afficherErreur("Action non reconnue");
        }
        //session_destroy();
    }




/*
   Valeurs du paramètre action :
   0 : une erreur est survenue. Un code d'erreur est également transmis dans l'URL. 
   1 : demande d'affichage des détails d'un article
     URL?action=1&id=$identifiant
   2 : ajouter l'article au panier
     URL?action=2?id=$identifiant&qte=quantite
   3 : supprimer un article du panier
     URL?action=3&id=$identifiant
   4 : mettre à jour le panier
     URL?action=3&id1=$identifiant&qte1=quanite&....
   5 : afficher le panier
   autre : erreur action non reconnue
*/

