<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["supprimerCne"])){

   $cne = $_POST["supprimerCne"];
   $sql = "DELETE FROM etudiant WHERE cne = '$cne'";
   if(mysqli_query($conn , $sql)){
      header("Location: ListeEtudiants.php?msg=1 ligne supprimée");
      exit();
   }else{
      header("Location: ListeEtudiants.php?msg=0 lign supprimée");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}
?>