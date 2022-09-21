<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"] && $_SESSION["ref"]){

   $username = $_SESSION["user"];
   $nom = $_SESSION["nom"];
   $prenom = $_SESSION["prenom"];

   $semestre = $_SESSION["semestre"];
   $table = "cours";
   $table2 = "module";
   $promo = $_SESSION["promo"];
   $ref = $_SESSION["ref"];
   
   $sql = "SELECT * FROM $table WHERE REF = '$ref'";
   $result = mysqli_query($conn , $sql);


   // pour trouver le titre du module
   $sql2 = "SELECT nomModule FROM $table2 WHERE promo = '$promo' and REF = '$ref'";
   $result2 = mysqli_query($conn , $sql2);
   $row = mysqli_fetch_assoc($result2);
   $titre = $row["nomModule"];


   ?>

   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home| Admin : <?php echo strtoupper($nom)?></title>
      <link rel="stylesheet" href="../../css/module.css">
      <link rel="stylesheet" href="../../css/pageHomeAdmin.css">
   </head>
   <body>

      <nav class="nav2">
         <label for="">Admin : <?php echo strtoupper($nom)." ".$prenom?></label>
         <a href="logout.php">Deconnexion</a>
      </nav>
      <table class="table-modules table-modules2">
         <thead>
            <tr>
               <th class="table-head" colspan="5"><?php echo $titre ?></th>
            </tr>
            <tr>
               <th>Les Cours</th>
               <th>Les TD</th>
               <th>Les TP</th>
               <th>Supprimer</th>
               <th>Modifier</th>
            </tr>
         </thead>
         <tbody>
            <?php while($donnees = $result->fetch_assoc()){ 
               // partie cours 
             
               $srcCours = $donnees["partieCours"];
               if($srcCours){
                  $uploadCours = "../../cours/";
                  $fileCours = $uploadCours.$srcCours;
               }else{
                  $fileCours = "";
               }
   
               // Copy partie TD
               $srcTD = $donnees["partieTD"];
               if($srcTD){
                  $uploadTD = "../../TD/";
                  $fileTD = $uploadTD.$srcTD;
               }else{
                  $fileTD = "";
               }
               
               // Copy partie TP
               $srcTP = $donnees["partieTP"];
               if($srcTP){
                  $uploadTP = "../../TP/";
                  $fileTP = $uploadTP.$srcTP;
               }else{
                  $fileTP = "";
               }
               
               ?>
               <tr>
                  <td> <a target="_blank" href="<?php echo $fileCours ?>"><?php echo $srcCours ?></a></td>
                  <td> <a target="_blank" href="<?php echo $fileTD ?>"><?php echo $srcTD ?></a></td>
                  <td> <a target="_blank" href="<?php echo $fileTP ?>"><?php echo $srcTP ?></a></td>
                  <td class="manage">
                     <form action="supprimerCours.php" method="POST">
                        <button name="supprimerId" type="submit" value="<?php echo $donnees["id"]?>">Supprimer</button>
                     </form>
                  </td>
                  <td>
                     <form action="modifierCoursContr.php" method="POST">
                        <button name="modifierId" type="submit" value="<?php echo $donnees["id"]?>">Modifier</button>
                     </form>
                  </td>
               </tr>
               <?php } ?>
         </tbody>
      </table>
      <?php
      if(isset($_GET["msg"])){ ?>
         <p class="msg"><?php echo $_GET["msg"] ?></p>
      <?php } ?>
   
      <div class="buttons">
         <a class="home" href="pageHomeAdmin.php">Acceuil</a>
         <a class="home" href="AjouterCoursForm.php">Ajouter</a>
      </div>
   </body>
   </html>
   
   <?php
   
   }else{
      session_unset();
      session_destroy();
      header("Location: LoginAdminForm.php");
   }
   
   ?>