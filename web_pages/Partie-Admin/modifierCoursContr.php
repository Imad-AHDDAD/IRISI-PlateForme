<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"] && $_SESSION["ref"] && isset($_POST["modifierId"])){

   $_SESSION["modifierId"] = $_POST["modifierId"];
   header("Location: modifierCoursForm.php");
   exit();
   
}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?errorContr");
   exit();
}