<?php
session_start();
if(isset($_POST["user"]) && isset($_POST["pass"])){

   include "../db_conn.php";

   $user = filter_var($_POST["user"] , FILTER_SANITIZE_STRING);
   $pass = filter_var($_POST["pass"] , FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM user WHERE username = '$user'";
   $result = mysqli_query($conn , $sql);

   if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      if ($row["username"] === $user && $row["pass"] === $pass) {
         $_SESSION["nom"] = $row["Nom"];
         $_SESSION["prenom"] = $row["Prenom"];
         $_SESSION["user"] = $row["username"];
         header("Location: pageHomeAdmin.php");
         exit();
      }else{
         session_unset();
         session_destroy();
         header("Location: LoginAdminForm.php?error=username ou mot de passe incorrect");
         exit();
      }
   }else{
      session_unset();
      session_destroy();
      header("Location: LoginAdminForm.php?error=username ou mot de passe incorrect");
      exit();
   }

}else{
   session_unset();
   session_destroy();
   header("Location: LoginAdminForm.php?errorIsset");
   exit();
}

?>