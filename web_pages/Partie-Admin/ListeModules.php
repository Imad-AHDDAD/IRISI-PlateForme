<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"]){

   $username = $_SESSION["user"];
   $nom = $_SESSION["nom"];
   $prenom = $_SESSION["prenom"];
   $promo = $_SESSION["promo"];
   $semestre = $_SESSION["semestre"];

   $table = 'module';
   $sql = "SELECT * FROM $table WHERE promo = $promo and semestre = $semestre";
   $result = mysqli_query($conn , $sql);

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
            <th colspan="7">Les Modules d'IRISI <?php echo $promo ?> - S<?php echo $semestre ?></th>
         </tr>
         <tr>
            <th>Nom du module</th>
            <th>Prof du module</th>
            <th>Promotion</th>
            <th>Semestre</th>
            <th>Consulter</th>
            <th>Supprimer</th>
            <th>Modifier</th>
         </tr>
      </thead>
      <tbody>
         <?php while($donnees = $result->fetch_assoc()){ ?>
            <tr>
               <td> <?php echo $donnees["nomModule"] ?></td>
               <td> <?php echo $donnees["prof"] ?></td>
               <td> IRISI <?php echo $donnees["promo"] ?></td>
               <td> S<?php echo $donnees["semestre"] ?></td>
               <td>
                  <form action="voirModule.php" method="POST">
                     <button name="RefCours" type="submit" value="<?php echo $donnees["REF"]?>">Voir</button>
                  </form>
               </td>
               <td>
                  <form action="supprimerModule.php" method="POST">
                     <button name="supprimerREF" type="submit" value="<?php echo $donnees["REF"]?>">Supprimer</button>
                  </form>
               </td>
               <td>
                  <form action="modifierModuleContr.php" method="POST">
                     <button name="modifierREF" type="submit" value="<?php echo $donnees["REF"]?>">Modifier</button>
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
      <a class="home" href="AjouterModuleForm.php">Ajouter</a>
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