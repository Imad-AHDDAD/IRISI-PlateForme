<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["promo"] && $_SESSION["semestre"] && $_SESSION["ref"]){
   include "navbar.html";
   include "db_conn.php";
   $table = "cours";
   $table2 = "module";
   $promo = $_SESSION["promo"];
   $ref = $_SESSION["ref"];
   $nom = strtoupper($_SESSION["nom"]) . " " . $_SESSION["prenom"];
   $sql = "SELECT * FROM $table WHERE REF = '$ref'";
   $result = mysqli_query($conn , $sql);


   // pour trouver le titre du module
   $sql2 = "SELECT nomModule FROM $table2 WHERE promo = '$promo' and REF = '$ref'";
   $result2 = mysqli_query($conn , $sql2);
   $row = mysqli_fetch_assoc($result2);
   $titre = $row["nomModule"];

   
   // $destCours = "C:/wamp64/www/IRISI/cours/introduction.pdf";
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>IRISI <?php echo $_SESSION["promo"]?> | Semestre <?php echo $_SESSION["semestre"]?></title>
   <link rel="stylesheet" href="../css/module.css">
</head>
<body>

   <div class="container">
      <section class="infos-bar">
            <div class="infos">
               <img src="../images/avatar.jpg" alt="profile">
               <p><?php echo $nom ?></p>
               <p>IRISI <?php echo $promo ?></p>
            </div>

            <div class="logout-div">
               <a class="logout" href="logout.php">Deconnexion</a>
            </div>
      </section>
      <section class="tableau">
         <table class="table-modules">
            <thead>
               <tr>
                  <th class="table-head" colspan="3"><?php echo $titre ?></th>
               </tr>
               <tr>
                  <th>Les Cours</th>
                  <th>Les TD</th>
                  <th>Les TP</th>
               </tr>
            </thead>
            <tbody>
               <?php while($donnees = $result->fetch_assoc()){ 
                  // partie cours 
             
                  $srcCours = $donnees["partieCours"];
                  if($srcCours){
                     $uploadCours = "../cours/";
                     $fileCours = $uploadCours.$srcCours;
                  }else{
                     $fileCours = "";
                  }
      
                  // Copy partie TD
                  $srcTD = $donnees["partieTD"];
                  if($srcTD){
                     $uploadTD = "../TD/";
                     $fileTD = $uploadTD.$srcTD;
                  }else{
                     $fileTD = "";
                  }
                  
                  // Copy partie TP
                  $srcTP = $donnees["partieTP"];
                  if($srcTP){
                     $uploadTP = "../TP/";
                     $fileTP = $uploadTP.$srcTP;
                  }else{
                     $fileTP = "";
                  }
                  
                  ?>
                  <tr>
                     <td> <a target="_blank" href="<?php echo $fileCours ?>"><?php echo $srcCours ?></a></td>
                     <td> <a target="_blank" href="<?php echo $fileTD ?>"><?php echo $srcTD ?></a></td>
                     <td> <a target="_blank" href="<?php echo $fileTP ?>"><?php echo $srcTP ?></a></td>
                  </tr>
                  <?php } ?>
            </tbody>
         </table>

         <div class="buttons">
            <!-- <a class="logout" href="logout.php">Deconnexion</a> -->
            <a class="home" href="home.php">Acceuil</a>
         </div>
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