<div class="container bg-white py-1 px-1">
    <div class="row justify-content-between custom-line">
        <div class="col-12 col-lg-3 text-center">
            <a href="accueil.php"><img src='logo_gbaf.png' alt="logo_gbaf" class="img-fluid"/></a>
        </div>


        <div class="col-3">

        <?php

        if (isset($_SESSION['nom']))
        {
        
        ?>
            
            <p><img src="compte.png" /><?php echo $prenom . $nom ;?></p>
        
            <p><a role="button" class="btn btn-dark my-1" href="session_end.php">Déconnexion</a></p>

            <p><a role="button" class="btn btn-dark my-1" href="parametres.php?id_user=<?php echo $id_user; ?>">Paramètres</a></p>

        </div>

        <?php
        }
        ?>

    </div>
