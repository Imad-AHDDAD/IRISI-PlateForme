<?php
session_start();
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["modifierREF"])){

$_SESSION["modifierREF"] = $_POST["modifierREF"];
header("Location: modifierModuleForm.php");
exit();

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?errorContr");
   exit();
}

?>