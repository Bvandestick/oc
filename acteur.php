<?php

// Démarrage de la session
session_start();

if (isset($_SESSION['id_user']))
{

    $id_user = $_SESSION['id_user'];
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];

    $id_acteur = $_GET['id_acteur'];

    // Connexion à la base de données

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

    // Récupération des données de l'acteur

    $quest_acteur = $bdd->query("SELECT acteur, description, logo FROM acteurs WHERE id_acteur = '{$id_acteur}'");
    $data_acteur = $quest_acteur->fetch();

    $acteur = $data_acteur['acteur'];
    $description = $data_acteur['description'];
    $logo = $data_acteur['logo'];

    // Récupération des votes

    $quest_like = $bdd->query("SELECT COUNT(*) AS nb_likes FROM votes WHERE vote='like' AND id_acteur='{$id_acteur}'");
    $data_like = $quest_like->fetch();

    $quest_dislike = $bdd->query("SELECT COUNT(*) AS nb_dislikes FROM votes WHERE vote='dislike' AND id_acteur='{$id_acteur}'");
    $data_dislike = $quest_dislike->fetch();





    ?>

    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <title>Accueil</title>

    </head>

    <body>

        <header>

            <?php
                include('header.php');
            ?>

        </header>

        <div class="container bg-white">

            <div class="row justify-content-center border px-1 py-3">

                <div class="col-12 col-lg-6 px-1 py-1">
                <img src="<?php echo $logo; ?>" alt="Logo_acteur" class="img-fluid" />
                </div>

                <div class="col-12 col-lg-8 px-1 py-1">
                    <h2><?php echo $acteur; ?></h2>
                </div>

                <div class="col-12 col-lg-8 px-1 py-1">
                    <p><?php echo $description; ?></p>
                </div>

            </div>


            <div class="row justify-content-center border px-3 py-3">

                
                <p class="col-12 col-lg-6 h2">Commentaires</p>

                <button class="btn btn-dark col-6 col-lg-2" type="button" data-toggle="collapse" data-target="#commentaire" aria-expanded="false" aria-controls="commentaire">Nouveau commentaire</button>
                
                <div class="col-6 col-lg-4">
            
                    <div class="container-fluid">
                        <div class="d-flex">
                            <div class="mx-1 d-flex">
                                <a href=like.php?id_acteur=<?php echo $id_acteur; ?>&avis=like><img src="like.png" alt="like" title="J'aime"/></a>
                                <p class="h2" ><?php echo $data_like['nb_likes'] ; ?></p>
                            </div>

                            <div class="mx-1 d-flex">                   
                                <a href=like.php?id_acteur=<?php echo $id_acteur; ?>&avis=dislike><img src="dislike.png" alt="dislike" title="Je n'aime pas"/></a>
                                <p class="h2"><?php echo $data_dislike['nb_dislikes'] ; ?></p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="collapse col-12" id="commentaire">

                <form action="new_post.php?id_acteur=<?php echo $id_acteur; ?>" method="post">
                <p>
                <textarea name="comment" class="w-100 my-1 mx-1" rows="7"></textarea>
                <input type="submit" value="valider" class="btn btn-danger"/>
                </p>
                </form>
                
                </div>



                <div>
                    <?php

                    if (isset($_GET['result']) AND $_GET['result'] == 'already_vote')
                    {
                    ?>
                        <p class="alert alert-danger" role="alert">Vous avez déjà voté</p>
                    <?php    
                    }

                    if (isset($_GET['result']) AND $_GET['result'] == 'already_post')
                    {
                    ?>
                        <p class="alert alert-danger" role="alert">Vous avez déjà déposé un commentaire</p>
                    <?php    
                    }

                    // Récupération des commentaires

                    $quest_comments = $bdd->query("SELECT posts.date_add, posts.post, account.prenom FROM posts, account WHERE posts.id_user = account.id_user AND posts.id_acteur = '{$id_acteur}' ORDER BY date_add DESC");
                    
                    echo '<ul>';

                    while ($data_comments = $quest_comments->fetch())

                    {
                    echo '<li class="border mx-3 my-2 px-1 py-1">' . $data_comments['prenom'] . '<br />' . $data_comments['date_add'] . '<br />' . $data_comments['post'] . '</li>';

                    }

                    echo '</ul>';                

                    $quest_comments->closeCursor();
                    
                    ?>
                </div>

            </div>
        
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
else
{
    header("Location:connexion.php");
}