<?php
session_start();
$username = $_SESSION['username'];
$id_user = $_SESSION['id_user'];





?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <title>Page d'inscription</title>
    </head>

    <body>

        <p>Bienvenu, <?php echo $username; ?>. C'est votre première visite. Merci de compléter votre profil et choisir un nouveau mot de passe.</p>

        <form action="modif_user.php" method="post">
            <p>
            <input type="text" name="nom" />
            <input type="text" name="prenom" />
            <input type="texte" name="username" />
            <input type="password" name="motdepasse" />
            <input type="text" name="question" />
            <input type="text" name="reponse" />
            <input type="submit" value="valider" />
            </p>
        </form>


    </body>

</html>