<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["supprimerREF"])){

   $ref = $_POST["supprimerREF"];
   $sql = "DELETE FROM module WHERE REF = '$ref'";
   if(mysqli_query($conn , $sql)){
      header("Location: ListeModules.php?msg=1 ligne supprimée");
      exit();
   }else{
      header("Location: ListeModules.php?msg=0 lign supprimée");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}
?>