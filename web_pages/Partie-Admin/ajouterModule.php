<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["promo"] && $_SESSION["semestre"] && isset($_POST["nomModule"]) && isset($_POST["profModule"])){

   $nomModule = filter_var($_POST["nomModule"] , FILTER_SANITIZE_STRING);
   $profModule = filter_var($_POST["profModule"] , FILTER_SANITIZE_STRING);
   $promo = $_SESSION["promo"];
   $semestre = $_SESSION["semestre"];
   $ref = substr($nomModule , 0 , 1)."-".$promo."-".$semestre;

   if($nomModule && $profModule && $promo && $semestre && $ref){

         $sql = "INSERT INTO module (nomModule,prof,promo,semestre,REF) VALUES ('$nomModule' , '$profModule' , $promo , $semestre , '$ref')";
         if(mysqli_query($conn , $sql)){
            header("Location: ListeModules.php?msg=1 ligne ajoutée");
            exit();
         }else{
            header("Location: ajouterModuleForm.php?error");
            exit();
         }
      

   }else{
      header("Location: AjouterModuleForm.php?error=informations incompletes");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}

?>

