<?php
session_start();
include "navbar2.html";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"]){

   $username = $_SESSION["user"];
   $nom = $_SESSION["nom"];
   $prenom = $_SESSION["prenom"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home| Admin : <?php echo strtoupper($nom)?></title>
   <link rel="stylesheet" href="../../css/pageHomeAdmin.css">
   <link rel="stylesheet" href="../../css/form.css">
   <link rel="stylesheet" href="../../css/module.css">
</head>
<body>

   <nav class="nav2">
      <label for="">Admin : <?php echo strtoupper($nom)." ".$prenom?></label>
      <a href="logout.php">Deconnexion</a>
   </nav>

      <form action="ajouterAdmin.php" method="POST" class="activate">
         <h1>Ajouter un admin</h1>
         <input type="text" name="nomAdmin" id="nom" placeholder="Nom">
         <input type="text" name="prenomAdmin" id="prenom" placeholder="Prenom">
         <input type="text" name="usernameAdmin" id="usernameAdmin" placeholder="Nom d'utilisateur">
         <input type="password" name="passwordAdmin" id="passwordAdmin" placeholder="Mot de passe">
         <input type="password" name="passwordAdminCnf" id="passwordAdminCnf" placeholder="Confirmation">
         <button id="envoyer" type="submit">Ajouter</button>

         <?php
         if(isset($_GET["error"])){ ?>
            <p class="errorAccount"><?php echo $_GET["error"]?></p>
         <?php } ?>
         
      </form>
      <div class="buttons">
         <a class="home" href="pageHomeAdmin.php">Acceuil</a>
      </div>
   
</body>
</html>

<?php
}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}


?>