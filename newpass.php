<?php
session_start();

if (isset($_SESSION['id_user']))
{

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

            $id_user = $_SESSION['id_user'];

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
                    <title>Nouveau mot de passe</title>
                </head>
                        
                <body>
                        
                    <header>
                        <?php include('header.php'); ?>
                    </header>
                        
                    <div>
                        <p>Veuillez choisir un nouveau mot de passe</p>
                        <form action="newpass.php" method="post">
                        <p>
                        <input type="password" name="pass" />
                        <input type="submit" value="valider" />                            
                        </p>
                        </form>
                    </div>

                    <footer>
                        <?php include('footer.php'); ?>
                    </footer>

                </body>
            </html>
        <?php
        }
}
else
    {
        header('Location:connexion.php');
    }
