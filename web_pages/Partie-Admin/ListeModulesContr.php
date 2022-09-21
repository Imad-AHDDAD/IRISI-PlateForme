<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["promo"]) && isset($_POST["semestre"])){

   $promo = filter_var($_POST["promo"],FILTER_SANITIZE_NUMBER_INT);
   $semestre = filter_var($_POST["semestre"],FILTER_SANITIZE_NUMBER_INT);
   $_SESSION["promo"] = $promo;
   $_SESSION["semestre"] = $semestre;
   header("Location: ListeModules.php");
   exit();

}else{
   header("Location: LoginAdminForm.php?error");
   exit();
}

?>