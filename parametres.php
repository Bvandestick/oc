<?php
session_start();

// Vérification session

if (isset($_SESSION['id_user']))
{

    $id_user = $_SESSION['id_user'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];

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
            $req_user = $bdd->query("SELECT nom, prenom, username, password, question, reponse FROM account WHERE id_user = '{$id_user}'");
            $data_user = $req_user->fetch();

    // Si un champ a été complété on effectue le chnagement de paramètre

    if (isset($_POST['nom']) OR isset($_POST['prenom']) OR isset($_POST['motdepasse']) OR isset($_POST['question']) OR isset($_POST['reponse']))
    {


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
            $reponse_hash = password_hash($reponse, PASSWORD_DEFAULT);
        }
        else
        {
            $reponse = $data_user['reponse'];
        }


        // Changement de paramètres

        $infos = $bdd->prepare("UPDATE account SET nom = :nom, prenom = :prenom, password = :pass_hash, question = :question, reponse = :reponse WHERE id_user = :id_user");
        $infos->execute(array(
            'nom' => $new_nom,
            'prenom' => $new_prenom,
            'pass_hash' => $pass_hash,
            'question' => $question,
            'reponse' => $reponse_hash,
            'id_user' => $id_user
        ));

        header("Location:accueil.php");

    }

    // Si aucun champ complété on renvoie à la page paramètres
    else
    {
        ?>

        <!DOCTYPE html>

        <html>

            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
                <link href="css/style.css" rel="stylesheet">
                <title>Paramètres</title>
            </head>

            <body>

                <header>
                    <?php include("header.php") ?>
                </header>

                <div class="container bg-light">

                    <div class="row text-center bg-danger py-1 px-1">

                        <h1 class="col-12 text-white">Mes paramètres</h1>

                    </div>

                    <div class="row text-center bg-white py-1 px-1">

                        <p>Nom : <?php echo $data_user['nom']; ?></p>
                        <p>Prénom : <?php echo $data_user['prenom']; ?></p>
                        <p>Username : <?php echo $data_user['username']; ?></p>
                        <p>Question secrète : <?php echo $data_user['question']; ?></p>

                    </div>



                    <div class="row text-center">

                        <h2 class="col-12">Remplissez les champs que vous souhaitez changer puis cliquez sur Valider</h2>

                        <form action="parametres.php" method="post" class="col-12">
                            <p>
                            <label for="nom">Nom :</label>
                            <br />
                            <input type="text" name="nom" />
                            <br />

                            <label for="prenom">Prénom :</label>
                            <br />
                            <input type="text" name="prenom" />

                            <br />
                            <label for="motdepasse">Mot de passe :</label>
                            <br />
                            <input type="password" name="motdepasse" />

                            <br />
                            <label for="question">Votre question secrète :</label>
                            <br />
                            <input type="text" name="question" />

                            <br />
                            <label for="reponse">Réponse à votre question secrète :</label>
                            <br />
                            <input type="text" name="reponse" />

                            <br />
                            <input type="submit" value="valider" />
                            </p>
                        </form>
                    
                    </div>

                </div>

                <footer>
                    <?php include("footer.php") ?>
                </footer>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </body>

        </html>
    <?php
    }
}

// Si session inexistante on renvoie à la page de connexion

else
{
    header("Location:connexion.php");
}