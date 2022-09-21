<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["modifierId"]){

   $username = $_SESSION["user"];
   $nom = $_SESSION["nom"];
   $prenom = $_SESSION["prenom"];

   $id = $_SESSION["modifierId"];

   $nomAdmin="";
   $prenomAdmin="";
   $usernameAdmin="";
   $passwordAdmin="";
   $passwordAdminCnf="";


   $sql = "SELECT * FROM user WHERE id = '$id'";
   $result = mysqli_query($conn , $sql);
   if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      $nomAdmin = $row["Nom"];
      $prenomAdmin = $row["Prenom"];
      $usernameAdmin = $row["username"];
      $passwordAdmin = $row["pass"];
      $passwordAdminCnf = $row["pass"];
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

   <form action="modifierAdmin.php" method="POST" class="activate">
         <h1>Modifier un Admin</h1>
         <label class="label" for="">Nom</label>
         <input type="text" name="nomAdmin" id="nomAdmin" value="<?php echo $nomAdmin ?>">
         <label class="label" for="">Prenom</label>
         <input type="text" name="prenomAdmin" id="prenomAdmin" value="<?php echo $prenomAdmin ?>">
         <label class="label" for="">Nom d'utilisateur </label>
         <input type="text" name="usernameAdmin" id="usernameAdmin" value="<?php echo $usernameAdmin ?>">
         <label class="label" for="">Mot de passe</label>
         <input type="password" name="passwordAdmin" id="passwordAdmin" value="<?php echo $passwordAdmin ?>">
         <label class="label" for="">Confirmation</label>
         <input type="password" name="passwordAdminCnf" id="passwordAdmin" value="<?php echo $passwordAdminCnf ?>">
         
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