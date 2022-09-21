<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["modifierId"]){

   $username = $_SESSION["user"];
   $nom = $_SESSION["nom"];
   $prenom = $_SESSION["prenom"];
   $id = $_SESSION["modifierId"];
   $nomEtudiant="";
   $prenomEtudiant="";
   $cne="";
   $apogeeEtudiant=0;
   $emailEtudiant="";
   $promoEtudiant=0;
   $activeEtudiant=0;


   $sql = "SELECT * FROM etudiant WHERE id = '$id'";
   $result = mysqli_query($conn , $sql);
   if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      $nomEtudiant = $row["nom"];
      $prenomEtudiant = $row["prenom"];
      $cne = $row["cne"];
      $apogeeEtudiant = $row["apogee"];
      $emailEtudiant = $row["email"];
      $promoEtudiant = $row["promo"];
      $activeEtudiant = $row["active"]; 
   }else{
      header("Location: logout.php");
      exit();
   }

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

   <form action="modifierEtudiant.php" method="POST" class="activate">
         <h1>Modifier un etudiant</h1>
         <label class="label" for="">Nom d'etudiant</label>
         <input type="text" name="nom" id="nom" placeholder="Nom" value="<?php echo $nomEtudiant ?>">
         <label class="label" for="">Prenom d'etudiant</label>
         <input type="text" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo $prenomEtudiant ?>">
         <label class="label" for="">CNE d'etudiant</label>
         <input type="text" name="cne" id="cne" placeholder="CNE" value="<?php echo $cne ?>">
         <label class="label" for="">Apogee d'etudiant</label>
         <input type="number" name="apogee" id="apogee" placeholder="Apogee" value="<?php echo $apogeeEtudiant ?>">
         <label class="label" for="">Email d'etudiant</label>
         <input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $emailEtudiant ?>">
         <label class="label" for="">Promotion d'etudiant</label>
         <select name="promo" id="promo" placeholder="Promotion" value="<?php echo $promoEtudiant ?>">
            <option value="1" selected>IRISI 1</option>
            <option value="2">IRISI 2</option>
            <option value="3">IRISI 3</option>
         </select>
         <label class="label" for="">Etat de Compte</label>
         <select name="active" id="active" value="<?php echo $activeEtudiant ?>">
            <option value="1" selected>activé</option>
            <option value="0">désactivé</option>
         </select>
         <button id="envoyer" type="submit">Modifier</button>

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