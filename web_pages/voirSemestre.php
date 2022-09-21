<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["promo"] && $_POST["semestre"]){
   $semestre = filter_var($_POST["semestre"] , FILTER_SANITIZE_NUMBER_INT);
   $_SESSION["semestre"] = $semestre;
   header("Location: irisi-semestre.php");
   exit();
}else{
   session_unset();
   session_destroy();
   header("Location: form.php?error");
   exit();
}
?>