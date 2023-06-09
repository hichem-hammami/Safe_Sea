<?php $titre="Panier d'achat"?>
<?php ob_start();?>
    <div>
        <img id="radin" src="/images/radin.jpg">
    </div>
    <div class="container site">
        <h1 class="text-logo"><span class="glyphicon glyphicon-grain"></span>Safe Sea<span class="glyphicon glyphicon-grain"></span></h1>  
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active"><a href="./index.php">Nos produits</a></li>
            </ul>
        </div>
        <div class="row">
            <div id ="contenu">
                <div class="caption">
                    <?php
                    if(empty($data)){

                    ?>
                        <h4 class='nom' id="vide">Votre panier d'achat est vide </h4>
                    <?php
                       }else{
                    ?>
                    <h4 class="nom">Votre panier d'achat</h4>
                    <table class="table table-striped table-bordered fond-dark" id="panier">
                        <thead class="thead-light">
                            <tr>
                                <th>Article</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total article</th>
                            </tr>
                        </thead>
                        <?php
                            $total = 0;
                            foreach($data as $lignePanier){
                                $identifiant = $lignePanier["idArticle"];
                                $nom = $lignePanier["nom"];
                                $image = "images/".$lignePanier["image"];
                                $quantite = $lignePanier["quantite"];
                                $quantiteDisponible = $lignePanier["quantiteDisponible"];
                                $prix = $lignePanier["prix"];
                                $total += $quantite * $prix;
                            
                        ?>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="img-thumbnail" src="<?=$image?>" alt="<?=$nom?>" width="80">
                                        </div>
                                        <div class="card-footer">
                                            <p class="card-text"><?=$nom?></p>
                                        </div>
                                    </div>

                                </td>
                                <td><?=number_format($prix, 2)."$"?></td>
                                
                                <td>
                                    <form method="get" action="index.php">       
                                        <input type="hidden" name="action" value="4">
                                        <input type="hidden" name="id" value="<?=$identifiant?>">
                                        <div class="form-group">
                                        <p class="card-text"><?=$quantite?>    
                                        </div>
                                    
                                    </form>
                                </td>
                                <td><?=number_format($prix * $quantite, 2)."$"?></td>
                            </tr>
                            <?php     
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="container-fluid" >
            <ul class="nav navbar-nav">
                <li class="active"><a href="./index.php" style="text-align:center;"><h1 >Votre Commande a ete Enregistre Prix Total est :: <?=number_format($total, 2)?>$<h1></a></li>
            </ul>
            <td>
                                 <a href="vues/pdfpost.php" class="text-warning" ><h4>Telecharger Contenu du Panier <i class="fa fa-download" aria-hidden="true"></i></h4> </a>
                            </td>
        </div>
                </div>
               
                <?php
                        }
                ?>
                <div>
                    <img id="felicitations" img src="./images/animations/felicitations.gif">
                </div>
                <div>
                    <a href="./index.php">Retour à la page d'accueil</a>
                </div>
            </div>
        </div>
    </div>
<?php $contenu = ob_get_clean();?>
<?php require("gabarits/template.php");?>
<script>
    var total = document.getElementById("total");
    montant = parseFloat(total.getAttribute("montant"));
    if(montant >= 200){
        alert("Wow. Un montant de plus de 200$ mérite un cadeau");
    }
</script>