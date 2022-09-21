<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"]){

   $username = $_SESSION["user"];
   $nom = $_SESSION["nom"];
   $prenom = $_SESSION["prenom"];

   $sql = "SELECT * FROM user";
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
            <th colspan="5">Les administrateurs</th>
         </tr>
         <tr>
            <th>Nom</th>
            <th>prenom</th>
            <th>Nom d'utilisateur</th>
            <th>Supprimer</th>
            <th>Modifier</th>
         </tr>
      </thead>
      <tbody>
         <?php while($donnees = $result->fetch_assoc()){ ?>
            <tr>
               <td> <?php echo $donnees["Nom"] ?></td>
               <td> <?php echo $donnees["Prenom"] ?></td>
               <td> <?php echo $donnees["username"] ?></td>
               <td class="manage">
                  <form action="supprimerAdmin.php" method="POST">
                     <button name="supprimerId" type="submit" value="<?php echo $donnees["id"]?>">Supprimer</button>
                  </form>
               </td>
               <td>
                  <form action="modifierAdminContr.php" method="POST">
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
      <a class="home" href="AjouterAdminForm.php">Ajouter</a>
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