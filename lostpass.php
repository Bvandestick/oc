<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">  
        <link href="style.css" rel="stylesheet">    
        <title>Page de connexion</title>
    </head>

    <body>

        <header>
            <?php include('header.php'); ?>
        </header>

        <div class="container py-3 px-3 bg-light">

            <?php 
                if (isset($_POST['username']) AND !empty($_POST['username']))
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


                if (!isset($_POST['username']) AND !isset($_POST['reponse']) AND !isset($_GET['username']))
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

                if (isset($_POST['username']) AND empty($_POST['username']))
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

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>