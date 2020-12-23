<div class="container bg-white">
    <div class="row justify-content-between custom-line">
        <div class="col-12 col-lg-3 text-center">
            <img src='logo_gbaf.png' class="img-fluid"/>
        </div>


        <div class="col-3">
            
            <p><img src="compte.png" /><?php echo $prenom . $nom ;?></p>
        
        <?php
        if (isset($_SESSION['id_user']))
        {
        ?>
            <a href="session_end.php">Déconnexion</a>

            <a href="parametres.php">Paramètres</a>

        </div>

        <?php
            }
        ?>

    </div>
