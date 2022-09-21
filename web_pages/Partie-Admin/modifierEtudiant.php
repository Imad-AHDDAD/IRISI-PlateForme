<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["modifierId"] && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["cne"]) && isset($_POST["apogee"]) && isset($_POST["email"]) && isset($_POST["promo"]) && isset($_POST["active"])){

   $id = $_SESSION["modifierId"];
   $nom = filter_var($_POST["nom"] , FILTER_SANITIZE_STRING);
   $prenom = filter_var($_POST["prenom"] , FILTER_SANITIZE_STRING);
   $cne = filter_var($_POST["cne"] , FILTER_SANITIZE_STRING);
   $apogee = filter_var($_POST["apogee"] , FILTER_SANITIZE_NUMBER_INT);
   $email = filter_var($_POST["email"] , FILTER_VALIDATE_EMAIL);
   $promo = filter_var($_POST["promo"] , FILTER_SANITIZE_STRING);
   $active = filter_var($_POST["active"] , FILTER_SANITIZE_NUMBER_INT);

   if($nom && $prenom && $cne && $apogee && $promo){

         $sql = "UPDATE etudiant SET nom='$nom',prenom='$prenom',cne='$cne',apogee = $apogee , email = '$email' , promo = $promo , active = $active WHERE id = '$id'";
         if(mysqli_query($conn , $sql)){
            $_SESSION["promo"] = $promo;
            header("Location: ListeEtudiants.php?msg=1 ligne modifiée");
            exit();
         }else{
            $_SESSION["modifierId"] = $id;
            header("Location: modifierEtudiantForm.php?error");
            exit();
         }
      

   }else{
      header("Location: modifierEtudiantForm.php?error=informations incompletes");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}

?>

