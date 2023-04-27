<?php $titre = "Détails de l'article sélectionné"?>
<?php ob_start();?>
    <?php
        $identifiant = $article[0]["identifiant"];
        $image = "images/".$article[0]["imageArticle"];
        $nom = $article[0]["nom"]; 
        $prix = $article[0]["prix"];
        $description = $article[0]["description"];
        $categorie = $article[0]["categorie"];
        $quantiteDisponible = $article[0]["quantiteDisponible"];
    ?>
    <div class="container site">
        <h1 class="text-logo"><span class="glyphicon glyphicon-grain"></span>Pépinière Labranche<span class="glyphicon glyphicon-grain"></span></h1>    
        <div id="panier" class="fond-dark text-dark">
            <p>Votre panier d'achat
                <a href="../index.php?action=5" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span> 
                        <?=empty($totalArticles)?"0 ":$totalArticles." "?>article(s)
                </a>
            </p> 
        </div>
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li ><a href="../index.php">Nos produits</a></li>
                <li><a href="../index.php?action=6">Nous trouver</a></li>
                <li><button class="btn btn-primary" id="btnChangerTheme" onclick="changerTheme(this)">Passer au thème light</button></li>
            </ul>
        </div>
        <div class="row card-group">
            <div  class="col-sm-5 col-md-5 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <img class="img-thumbnail" style="width:100%" src="<?=$image?>" alt="<?=$nom?>" width="400">
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-md-7 col-lg-7">
                <div class="card">
                    <div class="card-header">
                            <h4 id="prix"><?=number_format($prix, 2)?> $</h4>
                            <h4 class="nom"><?=$nom?></h4>
                            <h4 class="nom">Catégorie :  <?=$categorie?></h4>
                            <p class="card-text"><?=$description?></p>
                            <?php
                                if($quantiteDisponible == 0){
                            ?>
                            <h4 class="quantite">En rupture de stock</h4></div>
                            <div class="form-group">
                            <a href="index.php" role="button" class="btn btn-info">Retour à la page des produits</a>
                            </div>
                            <?php
                                }else{

                            ?>
                            <h4 class="quantite"><?=$quantiteDisponible?> article(s) en stock</h4>
                    </div>
                    <div class="card-body">
                        <form method="get" action="index.php">
                            <!--Ici, on  transmet la nature de l'action et l'id du produit en tant que champs cachés-->
                            <input type="hidden" name="action" value="2">
                            <input type="hidden" name="id" value="<?=$identifiant?>">
                            <div style="padding: 5px;">
                            <div class="form-group">
                                <label> Quantité</label>
                                <select class="form-control" name="quantite">
                                    <?php
                                        for($i = 1; $i <= $quantiteDisponible; $i++){

                                        
                                    ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-order">Ajouter au panier</button>
                            </div>
                            <div class="form-group">
                                <a href="index.php" role="button" class="btn btn-info">Retour à la page des produits</a>
                            </div>
                        </form>
                    </div>
                    <?php
                            }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php $contenu = ob_get_clean()?>
<?php require("gabarits/template.php");?>



