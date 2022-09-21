<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["supprimerId"])){

   $id = $_POST["supprimerId"];
   $sql = "DELETE FROM cours WHERE id = '$id'";
   if(mysqli_query($conn , $sql)){
      header("Location: module.php?msg=1 ligne supprimée");
      exit();
   }else{
      header("Location: module.php?msg=0 lign supprimée");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}
?>