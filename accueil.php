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
                <title>Accueil</title>

            </head>

            <body>

                <header>

                    <?php
                        include('header.php');
                    ?>

                </header>

                <div>

                    <?php
                    // Récupération des données de l'acteur
                    
                    $req_acteur_1 =  $bdd->prepare('SELECT acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs WHERE id_acteur = :id_acteur');
                    $req_acteur_1->execute(array('id_acteur' => '1'));
                    $data_acteur_1 = $req_acteur_1->fetch();
                    
                    ?>

                    <div>

                        <div>
                        <p><img src="<?php echo $data_acteur_1['logo']; ?>" /></p>
                        </div>

                        <div>
                            <h3><?php echo $data_acteur_1['acteur']; ?></h3>
                            <p><?php echo $data_acteur_1['SUBSTRING(description, 1, 120)']; ?>...</p>
                        </div>

                        <div>
                        <a href="acteur.php?id_acteur=1">Lire la suite</a>
                        </div>

                    </div>

                    <?php

                    // Récupération des données de l'acteur
                    
                    $req_acteur_2 =  $bdd->prepare('SELECT acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs WHERE id_acteur = :id_acteur');
                    $req_acteur_2->execute(array('id_acteur' => '2'));
                    $data_acteur_2 = $req_acteur_2->fetch();
                    
                    ?>

                    <div>

                        <div>
                        <p><img src="<?php echo $data_acteur_2['logo']; ?>" /></p>
                        </div>

                        <div>
                            <h3><?php echo $data_acteur_2['acteur']; ?></h3>
                            <p><?php echo $data_acteur_2['SUBSTRING(description, 1, 120)']; ?>...</p>
                        </div>

                        <div>
                        <a href="acteur.php?id_acteur=2">Lire la suite</a>
                        </div>

                    </div>

                    <?php

                    // Récupération des données de l'acteur

                    $req_acteur_3 =  $bdd->prepare('SELECT acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs WHERE id_acteur = :id_acteur');
                    $req_acteur_3->execute(array('id_acteur' => '3'));
                    $data_acteur_3 = $req_acteur_3->fetch();

                    ?>

                    <div>

                        <div>
                        <p><img src="<?php echo $data_acteur_3['logo']; ?>" /></p>
                        </div>

                        <div>
                            <h3><?php echo $data_acteur_3['acteur']; ?></h3>
                            <p><?php echo $data_acteur_3['SUBSTRING(description, 1, 120)']; ?>...</p>
                        </div>

                        <div>
                        <a href="acteur.php?id_acteur=3">Lire la suite</a>
                        </div>

                    </div>

                    <?php

                    // Récupération des données de l'acteur

                    $req_acteur_4 =  $bdd->prepare('SELECT acteur, logo, SUBSTRING(description, 1, 120) FROM acteurs WHERE id_acteur = :id_acteur');
                    $req_acteur_4->execute(array('id_acteur' => '4'));
                    $data_acteur_4 = $req_acteur_4->fetch();

                    ?>

                    <div>

                        <div>
                        <p><img src="<?php echo $data_acteur_4['logo']; ?>" /></p>
                        </div>

                        <div>
                            <h3><?php echo $data_acteur_4['acteur']; ?></h3>
                            <p><?php echo $data_acteur_4['SUBSTRING(description, 1, 120)']; ?>...</p>
                        </div>

                        <div>
                        <a href="acteur.php?id_acteur=4">Lire la suite</a>
                        </div>

                    </div>



                
                </div>

                <footer>

                    <?php include('footer.php'); ?>

                </footer>




            </body>

        </html>
    <?php
    }
    
    else
    {
        header("Location:connexion.php");
    }
    
    ?>