<?php

session_start();
include "db_conn.php";

if($_SESSION["code"] && $_SESSION["email"]){
   $email = $_SESSION["email"];
   if(isset($_POST["code"])){

      $code = filter_var($_POST["code"] , FILTER_SANITIZE_NUMBER_INT);
      
      if($code == $_SESSION["code"]){
         $cne = $_SESSION["cne"];
         $apogee = $_SESSION["apogee"];

         $sql2 = "UPDATE etudiant set active = 1 , email = '$email' where cne = '$cne' and apogee = '$apogee'";
         mysqli_query($conn , $sql2);
         session_unset();
         session_destroy();
         header("Location: form.php?success=Votre compte a été activé avec succes");
         exit();    

      }else{
         header("Location: Verification.php?error=code incorrect !");
         exit();
      }
   }else{
      session_unset();
      session_destroy();
      header("Location: form.php?error");
      exit();

   }
}else{
   session_unset();
   session_destroy();
   header("Location: form.php?error");
   exit();
}

?>