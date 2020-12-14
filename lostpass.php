<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <title>Page de connexion</title>
    </head>

    <body>

        <header>
            <?php include('header.php'); ?>
        </header>

        <div>

            <?php 
                if (isset($_POST['username']))
                {
                    // Connexion à la base
                    try
                    {
                        $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
                    }
                    catch (Exception $e)
                    {
                            die('Erreur : ' . $e->getMessage());
                    }

                    // Récupération des données

                    $username = htmlspecialchars($_POST['username']);


                    $reponse = $bdd->query("SELECT id_user, question, reponse FROM account WHERE username = '{$username}'");
                    $resultat = $reponse->fetch();

                    // Question à l'utilisateur
                    ?>

                        <p>Veuillez répondre à cette question : <?php echo $resultat['question']; ?></p>
                        <form action="lostpass.php?username=<?php echo $username; ?>" method="post">
                                <p>
                                Votre réponse:<input type="text" name="reponse" />
                                <input type="submit" value="valider" />
                                </p>
                        </form>
                <?php
                }
            
                if (isset($_POST['reponse']) AND isset($_GET['username']))
                {
                    // Connexion à la base
                    try
                        {
                            $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
                        }
                        catch (Exception $e)
                        {
                                die('Erreur : ' . $e->getMessage());
                        }

                        // Récupération des données du formulaire

                        $answer = htmlspecialchars($_POST['reponse']);
                        $username = htmlspecialchars($_GET['username']);

                        // Récupération des données de la base

                        $reponse = $bdd->query("SELECT id_user, nom, prenom, reponse FROM account WHERE username = '{$username}'");
                        $resultat = $reponse->fetch();

                        // Vérification

                        if ($answer == $resultat['reponse'])
                        {

                        session_start();
                        $_SESSION['id_user'] = $resultat['id_user'];
                        $_SESSION['nom'] = $resultat['nom'];
                        $_SESSION['prenom'] = $resultat['prenom'];
                        header("Location:newpass.php");


                        }

                        else
                        {
                            header("Location:lostpass.php");
                        }
                }

                elseif (!isset($_POST['username']) AND !isset($_POST['reponse']) AND !isset($_GET['username']))
                {


                ?>


            
                <p>Veuillez entrer votre identifiant</p>

                <form action="lostpass.php" method="post">
                    <p>
                    <input type="text" name="username" />
                    <input type="submit" value="valider" />
                    </p>
                </form>
                <?php
                }
                ?>

        </div>

        <footer>
            <?php include('footer.php'); ?>
        </footer> 

    </body>

</html>