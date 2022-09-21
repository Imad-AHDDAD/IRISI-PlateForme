<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["cne"]) && isset($_POST["apogee"])){

   $nom = filter_var($_POST["nom"] , FILTER_SANITIZE_STRING);
   $prenom = filter_var($_POST["prenom"] , FILTER_SANITIZE_STRING);
   $cne = filter_var($_POST["cne"] , FILTER_SANITIZE_STRING);
   $apogee = filter_var($_POST["apogee"] , FILTER_SANITIZE_NUMBER_INT);
   $promo = $_SESSION["promo"];

   if($nom && $prenom && $cne && $apogee && $promo){

      $sql1 = "SELECT * from etudiant WHERE cne = '$cne'";
      $sql2 = "SELECT * from etudiant WHERE apogee = '$apogee'";
      $res1 = mysqli_query($conn , $sql1);
      $res2 = mysqli_query($conn , $sql2);
      if(mysqli_num_rows($res1)>=1 || mysqli_num_rows($res2)>=1){
         header("Location: ajouterEtudiantForm.php?error=CNE ou Apogee deje existant");
         exit();
      }else{
         $sql = "INSERT INTO etudiant (nom,prenom,cne,apogee,promo) VALUES ('$nom' , '$prenom' , '$cne' , $apogee , $promo)";
         if(mysqli_query($conn , $sql)){
            header("Location: ListeEtudiants.php?msg=1 ligne ajoutée");
            exit();
         }else{
            header("Location: ajouterEtudiantForm.php?error");
            exit();
         }
      }

   }else{
      header("Location: AjouterEtudiantForm.php?error=informations incompletes");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}

?>

