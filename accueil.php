<?php

// Démarrage de la session
session_start();

    if (isset($_SESSION['id_user']))
    {

        $id_user = $_SESSION['id_user'];
        $prenom = $_SESSION['prenom'];
        $nom = $_SESSION['nom'];


        // Connexion à la base de données

        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }




        ?>

        <!DOCTYPE html>
        <html>

            <head>

                <meta charset="utf-8" />
                <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
                <title>Accueil</title>

            </head>

            <body>

                <header>

                    <?php
                        include('header.php');
                    ?>

                </header>

                <div class="container-fluid border">


                    <h1 id="presentation">Bienvenue sur le réseau extranet du GBAF</h1>
                    <p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>



                </div>


                <div class="container-fluid border bg-white">

                    <h2>Acteurs et partenaires</h2>
                    <p>Découvrez les services des acteurs et partenaires du GBAF</p>

                    <?php
                    // Récupération des données de l'acteur
                    
                    $req_acteur_1 =  $bdd->prepare('SELECT acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs WHERE id_acteur = :id_acteur');
                    $req_acteur_1->execute(array('id_acteur' => '1'));
                    $data_acteur_1 = $req_acteur_1->fetch();
                    
                    ?>

                    <div class="row border mx-1 ml-1">

                        <div class="col-lg-2 col-12 text-center">
                        <img src="<?php echo $data_acteur_1['logo']; ?>" class="img-fluid" />
                        </div>

                        <div class="col-lg-8 col-12">
                            <h3><?php echo $data_acteur_1['acteur']; ?></h3>
                            <p><?php echo $data_acteur_1['SUBSTRING(description, 1, 120)']; ?>...</p>
                        </div>

                        <div class="col-lg-2 col-12">
                        <a href="acteur.php?id_acteur=1">Lire la suite</a>
                        </div>

                    </div>

                    <?php

                    // Récupération des données de l'acteur
                    
                    $req_acteur_2 =  $bdd->prepare('SELECT acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs WHERE id_acteur = :id_acteur');
                    $req_acteur_2->execute(array('id_acteur' => '2'));
                    $data_acteur_2 = $req_acteur_2->fetch();
                    
                    ?>

                    <div class="row border mx-1 my-1 ">

                        <div class="col-lg-2 col-12 text-center">
                        <img src="<?php echo $data_acteur_2['logo']; ?>" class="img-fluid" />
                        </div>

                        <div class="col-lg-8 col-12">
                            <h3><?php echo $data_acteur_2['acteur']; ?></h3>
                            <p><?php echo $data_acteur_2['SUBSTRING(description, 1, 120)']; ?>...</p>
                        </div>

                        <div class="col-lg-2 col-12">
                        <a href="acteur.php?id_acteur=2">Lire la suite</a>
                        </div>

                    </div>

                    <?php

                    // Récupération des données de l'acteur

                    $req_acteur_3 =  $bdd->prepare('SELECT acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs WHERE id_acteur = :id_acteur');
                    $req_acteur_3->execute(array('id_acteur' => '3'));
                    $data_acteur_3 = $req_acteur_3->fetch();

                    ?>

                    <div class="row border mx-1 my-1">

                        <div class="col-lg-2 col-12 text center">
                        <img src="<?php echo $data_acteur_3['logo']; ?>" class="img-fluid" />
                        </div>

                        <div class="col-lg-8 col-12">
                            <h3><?php echo $data_acteur_3['acteur']; ?></h3>
                            <p><?php echo $data_acteur_3['SUBSTRING(description, 1, 120)']; ?>...</p>
                        </div>

                        <div class="col-lg-2 col-12">
                        <a href="acteur.php?id_acteur=3">Lire la suite</a>
                        </div>

                    </div>

                    <?php

                    // Récupération des données de l'acteur

                    $req_acteur_4 =  $bdd->prepare('SELECT acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs WHERE id_acteur = :id_acteur');
                    $req_acteur_4->execute(array('id_acteur' => '4'));
                    $data_acteur_4 = $req_acteur_4->fetch();

                    ?>

                    <div class="row border mx-1 my-1">

                        <div class="col-lg-2 col-12 text-center">
                        <img src="<?php echo $data_acteur_4['logo']; ?>" class="img-fluid" />
                        </div>

                        <div class="col-lg-8 col-12">
                            <h3><?php echo $data_acteur_4['acteur']; ?></h3>
                            <p><?php echo $data_acteur_4['SUBSTRING(description, 1, 120)']; ?>...</p>
                        </div>

                        <div class="col-lg-2 col-12">
                        <a href="acteur.php?id_acteur=4">Lire la suite</a>
                        </div>

                    </div>



                
                </div>

                <footer class="container-fluid bg-white">

                    <?php include('footer.php'); ?>

                </footer>


                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="/bootstrap/js/bootstrap.min.js"></script>
            </body>

        </html>
    <?php
    }
    
    else
    {
        header("Location:connexion.php");
    }
    
    ?>