<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["promo"]){
   include "navbar.html";
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <link rel="stylesheet" href="../css/home.css">
</head>
<body>
     
   <?php
      $nom = strtoupper($_SESSION["nom"]) . " " . $_SESSION["prenom"];
      $promo =  $_SESSION["promo"];
   ?>

   <div class="container">

      <div class="infos-bar">
         <div class="infos">
            <img src="../images/avatar.jpg" alt="profile">
            <p><?php echo $nom ?></p>
            <p>IRISI <?php echo $promo ?></p>
         </div>

         <div class="logout-div">
            <a class="logout" href="logout.php">Deconnexion</a>
         </div>
      </div>

      <section>
         <form action="voirSemestre.php" method="POST">

            <div class="title">
               <h1>Merci de choisir le semestre</h1>
            </div>
            
            <select name="semestre" id="semestre">
               <option value="1" selected>Semestre 1</option>
               <option value="2">Semestre 2</option>
            </select>

            <button type="submit">Voir</button>
            
         </form>
      </section>

   </div>
   
</body>
</html>

<?php

}else{
   session_unset();
   session_destroy();
   header("Location: form.php");
}

?>