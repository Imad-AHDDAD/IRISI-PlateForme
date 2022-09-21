<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["modifierId"])){

$_SESSION["modifierId"] = $_POST["modifierId"];
header("Location: modifierAdminForm.php");
exit();

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?errorContr");
   exit();
}

?>