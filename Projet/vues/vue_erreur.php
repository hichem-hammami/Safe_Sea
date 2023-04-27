<?php $titre="Page d'erreurs";?>
<?php ob_start();?>
    <div class="container site">
        <h1 class="text-logo"><span class="glyphicon glyphicon-grain"></span>Pépinière Labranche<span class="glyphicon glyphicon-grain"></span></h1>    
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                    <li class="active"><a href="../index.php">Nos produits</a></li>
                    <li><a href="../index.php?action=6">Nous trouver</a></li>
                    <li><button class="btn btn-primary" id="btnChangerTheme" onclick="changerTheme(this)">Passer au thème light</button></li>
            </ul>
        </div>
        <div class="row">
            <div id ="contenu">
                <div class="caption">
                    <h4 class="nom">Erreur : </h4>
                    <?=$erreur?>
                    <div>
                        <a href="../index.php">Retourner à la page du catalogue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $contenu = ob_get_clean();?>
<?php require("gabarits/template.php");?>



