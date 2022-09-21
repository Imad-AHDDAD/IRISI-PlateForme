<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"] && $_SESSION["ref"] && $_SESSION["modifierId"]){

   if($_FILES['partieCoursm']['name'] || $_FILES['partieTDm']['name'] || $_FILES['partieTPm']['name']){
      $username = $_SESSION["user"];
      $nom = $_SESSION["nom"];
      $prenom = $_SESSION["prenom"];

      $ref = $_SESSION["ref"];
      $id = $_SESSION["modifierId"];

      $partieCours="";
      $partieTD="";
      $partieTP="";

      $sql = "SELECT * FROM cours WHERE id = $id";
      $result = mysqli_query($conn , $sql);
      if(mysqli_num_rows($result) === 1){
         $row = mysqli_fetch_assoc($result);
         $partieCours=$row["partieCours"];
         $partieTD=$row["partieTD"];
         $partieTP=$row["partieTP"];
      }
      
      $uploadCours = "C:/wamp64/www/IRISI/cours/".basename($_FILES['partieCoursm']['name']);
      $uploadTD = "C:/wamp64/www/IRISI/TD/".basename($_FILES['partieTDm']['name']);
      $uploadTP = "C:/wamp64/www/IRISI/TP/".basename($_FILES['partieTPm']['name']);

      if(copy($_FILES['partieCoursm']['tmp_name'] , $uploadCours)){
         $partieCours=basename($_FILES['partieCoursm']['name']);
      }
      if(copy($_FILES['partieTDm']['tmp_name'] , $uploadTD)){
         $partieTD=basename($_FILES['partieTDm']['name']);
      }
      if(copy($_FILES['partieTPm']['tmp_name'] , $uploadTP)){
         $partieTP=basename($_FILES['partieTPm']['name']);
      }
      
      $sql2 = "UPDATE cours SET partieCours='$partieCours' , partieTD = '$partieTD' , partieTP='$partieTP' WHERE id = '$id'";
      if(mysqli_query($conn , $sql2)){
         header("Location: module.php?msg=1 ligne modifiée");
         exit();
      }else{
         header("Location: modifierCoursForm.php?errorRequete");
         exit();
      }

   }else{
      header("Location: modifierCoursForm.php?error=informations incompletes");
      exit();
   }
  
  
}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}








?>