<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && $_SESSION["modifierId"] && isset($_POST["nomAdmin"]) && isset($_POST["prenomAdmin"]) && isset($_POST["usernameAdmin"]) && isset($_POST["passwordAdmin"]) && isset($_POST["passwordAdminCnf"])){

   $id = $_SESSION["modifierId"];
   $nomAdmin = filter_var($_POST["nomAdmin"] , FILTER_SANITIZE_STRING);
   $prenomAdmin = filter_var($_POST["prenomAdmin"] , FILTER_SANITIZE_STRING);
   $usernameAdmin = filter_var($_POST["usernameAdmin"] , FILTER_SANITIZE_STRING);
   $passwordAdmin = filter_var($_POST["passwordAdmin"] , FILTER_SANITIZE_STRING);
   $passwordAdminCnf = filter_var($_POST["passwordAdminCnf"] , FILTER_SANITIZE_STRING);

   $sql2 = "SELECT * FROM user WHERE id = '$id'";
   $result2 = mysqli_query($conn , $sql2);
   $row = mysqli_fetch_assoc($result2);
   $adminModifié = $row["username"];

   if(!empty($nomAdmin) && !empty($prenomAdmin) && !empty($passwordAdmin) && !empty($passwordAdminCnf) && !empty($usernameAdmin)){

      if($passwordAdmin == $passwordAdminCnf){
         $sql = "UPDATE user SET Nom='$nomAdmin',Prenom='$prenomAdmin',username='$usernameAdmin',pass = '$passwordAdmin' WHERE id = '$id'";
         if(mysqli_query($conn , $sql)){
            if($adminModifié == $_SESSION["user"]){
               session_unset();
               session_destroy();
               header("Location: LoginAdminForm.php?error=Votre compte a été modifié");
               exit();
            }
            header("Location: ListeAdmins.php?msg=1 ligne modifiée");
            exit();
         }else{
            $_SESSION["modifierId"] = $id;
            header("Location: modifierAdminForm.php?error requete");
            exit();
         }
      }else{
         header("Location: modifierAdminForm.php?error=confirmation incorrecte");
         exit();
      }
      

   }else{
      header("Location: modifierAdminForm.php?error=informations incompletes");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}

?>

