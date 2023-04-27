<?php $titre="Nos coordonnées";?>
<?php ob_start();?>
      <div class="container site">
        <h1 class="text-logo"><span class="glyphicon glyphicon-grain"></span>Pépinière Labranche<span class="glyphicon glyphicon-grain"></span></h1>  
        <ul class="nav navbar-nav">
                <li class="active"><a href="../index.php">Nos produits</a></li>
                <li><a href="../index.php?action=6">Nous trouver</a></li>
                <li><button class="btn btn-primary" id="btnChangerTheme" onclick="changerTheme(this)">Passer au thème light</button></li>
        </ul>
        <div class="row">
          <div id="miniature_coordonnees">
            <img class=".img-rounded" src="/images/pepinieres.jpg" alt="Pépinière" style="width:100%">
            <div class="caption">
              <div class="card"> 
                <div class="card-body fond-dark text-dark" id="carte">
                  <h3 class="card-title">Adresse</h3>
                  <p class="card-text">6400, 16e Avenue</p>
                  <p class="card-text">Montréal (Québec) </p>
                  <p class="card-text"> H1X 2S9</p>
                  <h3 class="card-title">Téléphone</h3>
                  <p class="card-text">514 376-1620</p>
                  <a href="../index.php" class="btn btn-primary">Retour à la page de notre catalogue</a>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
<?php $contenu = ob_get_clean();?>
<?php require("gabarits/template.php");?>