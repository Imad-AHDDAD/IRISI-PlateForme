<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["nomAdmin"]) && isset($_POST["prenomAdmin"]) && isset($_POST["usernameAdmin"]) && isset($_POST["passwordAdmin"]) && isset($_POST["passwordAdminCnf"])){

   $nomAdmin = filter_var($_POST["nomAdmin"] , FILTER_SANITIZE_STRING);
   $prenomAdmin = filter_var($_POST["prenomAdmin"] , FILTER_SANITIZE_STRING);
   $usernameAdmin = filter_var($_POST["usernameAdmin"] , FILTER_SANITIZE_STRING);
   $passwordAdmin = filter_var($_POST["passwordAdmin"] , FILTER_SANITIZE_STRING);
   $passwordAdminCnf = filter_var($_POST["passwordAdminCnf"] , FILTER_SANITIZE_STRING);

   if(!empty($nomAdmin) && !empty($prenomAdmin) && !empty($passwordAdmin) && !empty($passwordAdminCnf) && !empty($usernameAdmin)){

      $sql1 = "SELECT * from user WHERE username = '$usernameAdmin'";
      $res1 = mysqli_query($conn , $sql1);
      if(mysqli_num_rows($res1)>=1){
         header("Location: ajouterAdminForm.php?error=Nom d'utilisateur deje existant");
         exit();
      }else{
         if($passwordAdmin == $passwordAdminCnf){
            $sql = "INSERT INTO user (Nom,Prenom,username,pass) VALUES ('$nomAdmin' , '$prenomAdmin' , '$usernameAdmin' , '$passwordAdmin')";
            if(mysqli_query($conn , $sql)){
               header("Location: ListeAdmins.php?msg=1 ligne ajoutée");
               exit();
            }else{
               header("Location: ajouterAdminForm.php?error");
               exit();
            }
         }else{
            header("Location: ajouterAdminForm.php?error=confirmation incorrecte");
            exit();
         }
      }

   }else{
      header("Location: AjouterAdminForm.php?error=informations incompletes");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}

?>

