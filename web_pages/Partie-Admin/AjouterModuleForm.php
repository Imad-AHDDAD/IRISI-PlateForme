<?php
session_start();
include "navbar2.html";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"]){

   $username = $_SESSION["user"];
   $nom = $_SESSION["nom"];
   $prenom = $_SESSION["prenom"];

   $promo = $_SESSION["promo"];
   $semestre = $_SESSION["semestre"];

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

      <form action="ajouterModule.php" method="POST" class="activate">
         <h1>Ajouter un module</h1>
         <label class="label" for="">Titre de module</label>
         <input type="text" name="nomModule" id="nomModule">
         <label class="label" for="">prof de module</label>
         <input type="text" name="profModule" id="profModule">
         
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