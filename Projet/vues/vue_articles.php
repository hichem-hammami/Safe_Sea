<?php
    $titre="Catalogue";
?>
<?php ob_start();?>
    <div class="container site">
        <h1 class="text-logo"><span class="glyphicon glyphicon-grain"></span>Safe Sea<span class="glyphicon glyphicon-grain"></span></h1>    
        <div id="panier" class="fond-dark text-dark">
            <p>Votre panier d'achat
                <a href="./index.php?action=5" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                        <?=empty($totalArticles)?"0 ":$totalArticles." "?>article(s)
                </a>
            </p> 
            <p>Valider commande
                <a href="./index.php?action=7" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                        <?=empty($totalArticles)?"0 ":$totalArticles." "?>article(s)
                </a>
            </p>
        </div>
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Nos produits</a></li>
            </ul>
        </div>
        <div class="row">
            <?php
                foreach($articles as $article){
                    $identifiant = $article["identifiant"];
                    $image = "images/".$article["imageArticle"];
                    $nom = $article["nom"]; 
                    $prix = $article["prix"];
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="thumbnail fond-dark">   
                    <img src="<?=$image?>" alt="<?=$nom?>" width="200">
                    <div class="prix"><?=number_format($prix, 2)?> $</div>
                    <div class="caption">
                        <h4 class="nom text-dark"><?=$nom?></h4>
					    <a href="index.php?action=1&id=<?=$identifiant?>" role="button" class="btn btn-info">Voir plus de détails</a>
                    </div>
                </div>
            </div> 
            <?php
                }
            ?>
        </div>
    </div>
<?php $contenu = ob_get_clean();?>
<?php require("gabarits/template.php");?>
<script>
    //document.addEventListener('mousemove', animerArbre);
    function animerArbre(e){
        arbre.style.display = "inline";
        arbre.style.left =  e.clientX + "px";
        arbre.style.bottom =  e.clientY + "px";
    }

    function desactiverAnimationArbre(){
        arbre.style.display = "none"; 
        document.removeEventListener('mousemove', animerArbre);        
    }
    var arbre = document.getElementById("arbre");
</script>