<?php

// Démarrage de la session
session_start();

// Vérification session

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
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
                <link href="css/style.css" rel="stylesheet">              
                <title>Accueil</title>

            </head>

            <body>

                <header>

                    <?php
                        include('header.php');
                    ?>

                </header>

                <div class="container bg-danger px-3 py-3">

                    <div class="row justify-content-center">
                        <h1 class="text-white col-12">Bienvenue sur le réseau extranet du GBAF</h1>
                        <p class="text-white col-10 col-lg-12">Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
                    <div><img src="img/illustration.jpg" alt="Immeuble" class="w-100" /></div>
                    </div>


                </div>


                <div class="container bg-white px-3 py-3">

                    <h2>Acteurs et partenaires</h2>

                    <div class="row justify-content-center">
                        <p class="col-8 col-lg-12">Découvrez les services des acteurs et partenaires du GBAF</p>
                    </div>

                    <?php
                    
                    // Récupération des données de l'acteur
                    
                    $req_acteur =  $bdd->query('SELECT id_acteur, acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs');

                    // Affichage de l'acteur

                    while ($data_acteur = $req_acteur->fetch())
                    {



                    echo '
                    
                        <div class="row border mx-1 my-1 px-1 py-1 bg-light justify-content-end">

                        <div class="col-lg-2 col-md-4 col-12 m-auto">
                        <img src="' . $data_acteur['logo'] . '" class="img-fluid" />
                        </div>

                        <div class="col-md-8 col-12">
                            <h3>' . $data_acteur['acteur'] . '</h3>
                            <p>' . $data_acteur['SUBSTRING(description, 1, 120)'] . '...</p>
                        </div>

                        <div class="col-lg-2 col-md-3 col-6 align-self-end">
                        
                        <a href="acteur.php?id_acteur=' . $data_acteur['id_acteur'] . '" class="btn btn-danger">Lire la suite</a>
                        
                        </div>

                        </div> ';

                    
                    }
                    $req_acteur->closeCursor();
                    ?>




                
                </div>

                <footer>

                    <?php include('footer.php'); ?>

                </footer>


            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </body>

        </html>
    <?php
    }
    
    // Si session inexistante on renvoie à la page de connexion

    else
    {
        header("Location:connexion.php");
    }
    
    ?>