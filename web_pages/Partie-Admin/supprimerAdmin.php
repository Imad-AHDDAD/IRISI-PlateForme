<?php
session_start();
include "../db_conn.php";
if($_SESSION["nom"] && $_SESSION["prenom"] && $_SESSION["user"] && isset($_POST["supprimerId"])){

   $id = $_POST["supprimerId"];
  
   $sql1 = "SELECT * FROM user";
   $result1 = mysqli_query($conn , $sql1);

   $sql2 = "SELECT * FROM user WHERE id = '$id'";
   $result2 = mysqli_query($conn , $sql2);
   $row = mysqli_fetch_assoc($result2);
   if($row["username"] == $_SESSION["user"]){
      header("Location: ListeAdmins.php?msg=Vous essayez de supprimmer votre compte ! impossible");
      exit();
   }else{
      if(mysqli_num_rows($result1) > 1){
         $sql = "DELETE FROM user WHERE id = '$id'";
         if(mysqli_query($conn , $sql)){
            header("Location: ListeAdmins.php?msg=1 ligne supprimée");
            exit();
         }else{
            header("Location: ListeAdmins.php?msg=0 lign supprimée");
            exit();
         }
      }else{
         header("Location: ListeAdmins.php?msg=c'est le seul Admin ! Vous ne pouvez pas le supprimmer");
         exit();
      }
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?error");
   exit();
}
?>