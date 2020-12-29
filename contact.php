<?php
session_start();

// Vérification session

if (isset($_SESSION['id_user']))
{

    $id_user = $_SESSION['id_user'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];

?>

    <!DOCTYPE html>

    <html>

        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="css/style.css" rel="stylesheet">              
            <title>Contact</title>
        </head>

        <body>

            <header>
                <?php
                include("header.php");
                ?>
            </header>

            <div class="container">
                <div class="row bg-light">

                    <h1 class="col-12 bg-danger text-white py-3 px-3">Contact<h1>
                    <div class="col-12 text-center bg-light py-3 px-3">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>

            <footer>
                <?php
                include("footer.php");
                ?>
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