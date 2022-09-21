<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"] && isset($_POST["RefCours"])){

   $ref = filter_var($_POST["RefCours"] , FILTER_SANITIZE_STRING);
   $_SESSION["ref"] = $ref;
   header("Location: module.php");
   exit();


}else{
   session_unset();
   session_destroy();
   header("Location: logout.php");
   exit();
}