<img src='logo_gbaf.png' />
<?php 
echo $prenom . $nom ;

if (isset($_SESSION['id_user']))
{
?>
<a href="session_end.php">Déconnexion</a>
<a href="parametres.php">Mes paramètres</a>
<?php
}
?>