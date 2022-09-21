<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["modifierREF"] && isset($_POST["nomModule"]) && isset($_POST["profModule"])){

   $ref = $_SESSION["modifierREF"];
   $nomModule = filter_var($_POST["nomModule"] , FILTER_SANITIZE_STRING);
   $profModule = filter_var($_POST["profModule"] , FILTER_SANITIZE_STRING);

   if($nomModule && $profModule){

         $sql = "UPDATE module SET nomModule='$nomModule',prof='$profModule'WHERE REF = '$ref'";
         if(mysqli_query($conn , $sql)){
            header("Location: ListeModules.php?msg=1 ligne modifiée");
            exit();
         }else{
            $_SESSION["modifierREF"] = $ref;
            header("Location: modifierModuleForm.php?error");
            exit();
         }
      

   }else{
      header("Location: modifierModuleForm.php?error=informations incompletes");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}

?>

