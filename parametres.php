<?php
session_start();

if (isset($_SESSION['id_user']))
{

    $id_user = $_SESSION['id_user'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];

    if (isset($_POST['nom']) OR isset($_POST['prenom']) OR isset($_POST['motdepasse']) OR isset($_POST['question']) OR isset($_POST['reponse']))
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

        // Récupération des données initiales de l'utilisateur
        $req_user = $bdd->query("SELECT nom, prenom, password, question, reponse FROM account WHERE id_user = '{$id_user}'");
        $data_user = $req_user->fetch();

        // Nomination des variables

        if (!empty($_POST['nom']))
        {
            $new_nom = htmlspecialchars($_POST['nom']);
        }
        else
        {
            $new_nom = $data_user['nom'];
        }

        if (!empty($_POST['prenom']))
        {
            $new_prenom = htmlspecialchars($_POST['prenom']);
        }
        else
        {
            $new_prenom = $data_user['prenom'];
        }

        if (!empty($_POST['motdepasse']))
        {
            $motdepasse = htmlspecialchars($_POST['motdepasse']);
            $pass_hash = password_hash($motdepasse, PASSWORD_DEFAULT);
        }
        else
        {
            $pass_hash = $data_user['password'];
        }

        if (!empty($_POST['question']))
        {
            $question = htmlspecialchars($_POST['question']);
        }
        else
        {
            $question = $data_user['question'];
        }

        if (!empty($_POST['reponse']))
        {
            $reponse = htmlspecialchars($_POST['reponse']);
        }
        else
        {
            $reponse = $data_user['reponse'];
        }




        $infos = $bdd->prepare("UPDATE account SET nom = :nom, prenom = :prenom, password = :pass_hash, question = :question, reponse = :reponse WHERE id_user = :id_user");
        $infos->execute(array(
            'nom' => $new_nom,
            'prenom' => $new_prenom,
            'pass_hash' => $pass_hash,
            'question' => $question,
            'reponse' => $reponse,
            'id_user' => $id_user
        ));

        header("Location:accueil.php");

    }

    else
    {
        ?>

        <!DOCTYPE html>

        <html>

            <head>
                <meta charset="utf-8" />
                <title>Paramètres</title>
            </head>

            <body>

                <p>Remplissez les champs que vous souhaitez changer plus cliquez sur Valider</p>

                <form action="parametres.php" method="post">
                    <p>
                    <input type="text" name="nom" />
                    <input type="text" name="prenom" />
                    <input type="password" name="motdepasse" />
                    <input type="text" name="question" />
                    <input type="text" name="reponse" />
                    <input type="submit" value="valider" />
                    </p>
                </form>


            </body>

        </html>
    <?php
    }
}

else
{
    header("Location:connexion.php");
}