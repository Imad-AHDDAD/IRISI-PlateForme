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
</head>
<body>

   <nav class="nav2">
      <label for="">Admin : <?php echo strtoupper($nom)." ".$prenom?></label>
      <a href="logout.php">Deconnexion</a>
   </nav>

   <h1></h1>

   <section class="operations">


      <div class="op">
         <div class="title">
            <h1>les etudiants</h1>
         </div>
         <a href="ListesEtudiantsGenerale.php">Liste des etudiants</a>
         <!-- <a href="AjouterEtudiantForm.php">Ajouter</a> -->
      </div>

      <div class="op">
         <div class="title">
            <h1>les cours</h1>
         </div>
         <a href="ListeModulesGenerale.php">Liste des cours</a>
         <!-- <a href="AjouterEtudiantForm.php">Ajouter</a> -->
      </div>

      <div class="op">
         <div class="title">
            <h1>les admins</h1>
         </div>
         <a href="ListeAdmins.php">Liste des admins</a>
         <!-- <a href="AjouterEtudiantForm.php">Ajouter</a> -->
      </div>
     
   </section>
   
</body>
</html>

<?php
}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?errorIsset");
   exit();
}


?>