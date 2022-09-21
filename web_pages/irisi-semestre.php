<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["promo"] && $_SESSION["semestre"]){
   include "navbar.html";
   include "db_conn.php";
   $table = "module";
   $promo = $_SESSION["promo"];
   $nom = strtoupper($_SESSION["nom"]) . " " . $_SESSION["prenom"];
   $semestre = $_SESSION["semestre"];
   $sql = "SELECT * FROM $table WHERE promo = '$promo' and semestre = $semestre";
   $result = mysqli_query($conn , $sql);

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
                  <th colspan="3">Les modules d'IRISI <?php echo $promo ?> - S<?php echo $semestre ?></th>
               </tr>
               <tr>
                  <th>Nom de Module</th>
                  <th>Prof de Module</th>
                  <th>Consulter</th>
               </tr>
            </thead>
            <tbody>
               <?php while($donnees = $result->fetch_assoc()){ ?>
                  <tr>
                     <td> <?php echo $donnees["nomModule"] ?></td>
                     <td> <?php echo $donnees["prof"] ?></td>
                     <td>
                        <form action="voirCours.php" method="POST">
                           <button name="RefCours" type="submit" value="<?php echo $donnees["REF"]?>">Voir Ce Cours</button>
                        </form>
                     </td>
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