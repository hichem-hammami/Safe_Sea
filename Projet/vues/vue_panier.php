<?php $titre="Panier d'achat"?>
<?php ob_start();?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
           <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>      
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
           <script src="../js/jquery.superslides.min.js"></script>
  <script src="../js/images-loded.min.js"></script>
  <script src="../js/isotope.min.js"></script>
  <script src="../js/baguetteBox.min.js"></script>
  <script src="../js/picker.js"></script>
  <script src="../js/picker.date.js"></script>
  <script src="../js/picker.time.js"></script>
  <script src="../js/legacy.js"></script>
  <script src="../js/form-validator.min.js"></script>
    <script src="../js/contact-form-script.js"></script>
    <script src="../js/custom.js"></script>
        <script src="../js/progressbar.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../css/templatemo-style.css">
    <title> Afficher Liste posts </title>
    <style type="text/css">
.myOtherTable { background-color:#85dcc2;border-collapse:collapse;color:#000;font-size:14px; }
.myOtherTable th { background-color:#3949c6;color:white;width:10%; }
.myOtherTable td, .myOtherTable th { padding:1px;border:1; }
</style>
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
                    <table id="employee_data" class="table table-hover tm-table-small tm-product-table">
                             <thead class="thead-light">
                            <tr>
                                <th>Article</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total article</th>
                                <th>Suppression</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
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
                                            <input type="number" min="0" max="<?=$quantite + $quantiteDisponible?>" 
                                                value="<?=$quantite?>" class="form-control" name="quantite" style="text-align:center">    
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"  class="btn btn-primary">
                                                <span class="glyphicon glyphicon-edit"></span> Modfier la quantité
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td><?=number_format($prix * $quantite, 2)."$"?></td>
                                <td>
                                    <a href="index.php?action=3&id=<?=$identifiant?>&quantite=<?=$quantite?>" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-remove-sign"></span> Supprimer l'article
                                    </a>
                                </td>
                            </tr>
                            <?php     
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="card">
                    <div class="card-body">
                        
                        <?php
                            $total = $total * (1 + 0.05 + 0.09975);
                        ?>
                        <h4 class="total card-text" id="total" montant="<?=$total?>"></h4>
                    </div>
                </div>
                    <div class="container-fluid" >
            <ul class="nav navbar-nav">
                <li class="active"><a href="./index.php?action=7" style="text-align:center;"><h1 >Paaser une Commande<h1></a></li>
            </ul>
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
    </html>
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  
    <!-- ALL PLUGINS -->
        <script src="../js/bootstrap.min.js"></script>
<?php $contenu = ob_get_clean();?>
<?php require("gabarits/template.php");?>
<script>
    var total = document.getElementById("total");
    montant = parseFloat(total.getAttribute("montant"));
    if(montant >= 200){
        alert("Wow. Un montant de plus de 200$ mérite un cadeau");
    }
</script>