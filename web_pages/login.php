<?php
session_start();
include "db_conn.php";

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["promoLogin"])){


   $user = filter_var($_POST["username"] , FILTER_SANITIZE_STRING);
   $pass = filter_var($_POST["password"] , FILTER_SANITIZE_STRING);
   $promo = filter_var($_POST["promoLogin"] , FILTER_SANITIZE_STRING);

   if(!$user){
      header("Location: form.php?error2=username incorrect");
      exit();
   }else if(!$pass){
      header("Location: form.php?error2=mot de passe incorrect");
      exit();
   }else{

      $table = 'etudiant';

      $sql = "SELECT * FROM $table WHERE cne = '$user' and promo = '$promo'";
      $result = mysqli_query($conn , $sql);

      if(mysqli_num_rows($result) === 1){
         $row = mysqli_fetch_assoc($result);
         if ($row["cne"] === $user && $row["apogee"] === $pass) {
            if($row["active"] == 1){
               $_SESSION["nom"] = $row["nom"];
               $_SESSION["prenom"] = $row["prenom"];
               $_SESSION["promo"] = $promo;
               header("Location: home.php");
               exit();
            }else{
               header("Location: form.php?error2=Votre Compte n'est pas activé");
               exit();
            }
         }else{
         header("Location: form.php?error2=username ou mot de passe incorrect");
         exit();
         }
      }else{
         header("Location: form.php?error2=username ou mot de passe incorrect");
         exit();
      }
   }

}else{
   header("Location: form.php?error");
   exit();
}

?>