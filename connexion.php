<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8" />
        <title>Page de connexion</title>
    </head>

    <body>
    
        <p>Veuillez entrer vos identifiant et mot de passe</p>

        <form action="connec_user.php" method="post">
            <p>
            <input type="text" name="username" />
            <input type="password" name="motdepasse" />
            <input type="submit" value="valider" />
            </p>
        </form>
        <p><a href="lostpass.php">Mot de passe oublié</a></p>


    </body>

</html>