<?php
session_start();

if (isset($_SESSION['id_user']))
{

    $id_user = $_SESSION['id_user'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];


    if (isset($_POST['pass']))
        {
            // Connexion à la base de donnée
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }

            // Insertion du nouveau mot de passe


            $pass = htmlspecialchars($_POST['pass']);
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

            $newpass = $bdd->prepare("UPDATE account SET motdepasse = :pass_hash WHERE id_user = :id_user");
            $newpass->execute(array(
                'pass_hash' => $pass_hash,
                'id_user' => $id_user
                ));
            

            // Page d'accueil

            header("Location:accueil.php");
                                
        }
                        
        else
        { ?>    
            <!DOCTYPE html>

            <html>
                        
                <head>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">  
                    <link href="style.css" rel="stylesheet">    
                    <title>Nouveau mot de passe</title>
                </head>
                        
                <body>
                        
                    <header>
                        <?php include('header.php'); ?>
                    </header>
                        
                    <div class="container px-3 py-3 bg-light">
                        <p>Veuillez choisir un nouveau mot de passe</p>
                        <form action="newpass.php" method="post">
                        <p>
                        <input type="password" name="pass" required />
                        <input type="submit" value="valider" />                            
                        </p>
                        </form>
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
}
else
    {
        header('Location:connexion.php');
    }
