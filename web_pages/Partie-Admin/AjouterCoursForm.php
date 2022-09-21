<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"] && $_SESSION["ref"]){

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
   
      <form action="ajouterCours.php" method="POST" class="activate" enctype="multipart/form-data">
            <h1>Ajouter un Cours</h1>
            <label class="label" for="">partie cours</label>
            <input type="file" name="partieCours" id="partieCours">
            <label class="label" for="">partie td</label>
            <input type="file" name="partieTD" id="partieTD">
            <label class="label" for="">partie tp</label>
            <input type="file" name="partieTP" id="partieTP">
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