<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["promo"])){

   $promo = filter_var($_POST["promo"],FILTER_SANITIZE_NUMBER_INT);
   $_SESSION["promo"] = $promo;
   header("Location: ListeEtudiants.php");
   exit();

}else{
   header("Location: LoginAdminForm.php?error");
   exit();
}

?>