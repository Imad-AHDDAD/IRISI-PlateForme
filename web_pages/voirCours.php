<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["promo"] && $_SESSION["semestre"] && $_POST["RefCours"]){
   $ref = filter_var($_POST["RefCours"] , FILTER_SANITIZE_STRING);
   $_SESSION["ref"] = $ref;
   header("Location: cours.php");
   exit();
}else{
   session_unset();
   session_destroy();
   header("Location: form.php?error");
   exit();
}
?>