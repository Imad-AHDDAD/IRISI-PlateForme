<?php
session_start();
include "navbar2.html";
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"] && $_SESSION["ref"]){

   if($_FILES['partieCours']['name'] || $_FILES['partieTD']['name'] || $_FILES['partieTP']['name']){
      $username = $_SESSION["user"];
      $nom = $_SESSION["nom"];
      $prenom = $_SESSION["prenom"];

      $ref = $_SESSION["ref"];

      $partieCours="";
      $partieTD="";
      $partieTP="";

      $uploadCours = "C:/wamp64/www/IRISI/cours/".basename($_FILES['partieCours']['name']);
      $uploadTD = "C:/wamp64/www/IRISI/TD/".basename($_FILES['partieTD']['name']);
      $uploadTP = "C:/wamp64/www/IRISI/TP/".basename($_FILES['partieTP']['name']);

      if(copy($_FILES['partieCours']['tmp_name'] , $uploadCours)){
         $partieCours=basename($_FILES['partieCours']['name']);
      }
      if(copy($_FILES['partieTD']['tmp_name'] , $uploadTD)){
         $partieTD=basename($_FILES['partieTD']['name']);
      }
      if(copy($_FILES['partieTP']['tmp_name'] , $uploadTP)){
         $partieTP=basename($_FILES['partieTP']['name']);
      }
      
      $sql = "INSERT INTO cours (REF,partieCours,partieTD,partieTP) VALUES ('$ref' , '$partieCours' , '$partieTD' , '$partieTP')";
      if(mysqli_query($conn , $sql)){
         header("Location: module.php?msg=1 ligne ajoutée");
         exit();
      }else{
         header("Location: AjouterCoursForm.php?error");
         exit();
      }

   }else{
      header("Location: AjouterCoursForm.php?error=informations incompletes");
      exit();
   }
  
  
}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}








?>