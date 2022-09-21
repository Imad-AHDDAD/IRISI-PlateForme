<?php
session_unset();
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

   <section class="form">
      <form action="ListeModulesContr.php" method="POST">
      
      <h1>Merci de choisir la promotion et le semestre</h1>
         <select name="promo" id="promo">
            <option value="1" selected>IRISI 1</option>
            <option value="2">IRISI 2</option>
            <option value="3">IRISI 3</option>
         </select>
         <select name="semestre" id="semestre">
            <option value="1" selected>Semestre 1</option>
            <option value="2">Semestre 2</option>
         </select>
         
         <button type="submit">Voir la liste</button>
      </form>
   </section>
   
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