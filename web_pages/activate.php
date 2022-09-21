<?php
include "db_conn.php";

if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["cne"]) && isset($_POST["apogee"]) && isset($_POST["email"]) && isset($_POST["promo"])){

   $nom = filter_var($_POST["nom"] , FILTER_SANITIZE_STRING);
   $prenom = filter_var($_POST["prenom"] , FILTER_SANITIZE_STRING);
   $cne = filter_var($_POST["cne"] , FILTER_SANITIZE_STRING);
   $apogee = filter_var($_POST["apogee"] , FILTER_SANITIZE_NUMBER_INT);
   $email = filter_var($_POST["email"] , FILTER_VALIDATE_EMAIL);
   $promo = filter_var($_POST["promo"] , FILTER_SANITIZE_STRING);

   if($nom && $prenom && $cne && $apogee && $email && $promo){

      $table = 'etudiant';

      $sql = "SELECT * FROM $table WHERE cne = '$cne' and apogee = '$apogee' and promo = '$promo'";
      $result = mysqli_query($conn , $sql);
      if (mysqli_num_rows($result)==0){
         header("Location: form.php?error=Vous n'etes pas dans la liste IRISI");
         exit();
      }else if(mysqli_num_rows($result)==1){
         $row = mysqli_fetch_assoc($result);
         if($row["active"] == 0){

            session_start();

            $verificationCode = rand();
            $message = "
            
                     <html lang='en'>
            <head>
               <style>

                  section{
                     padding : 10px;
                     border : 1px solid black;
                     border-radius: 5px;
                  }
                  p{
                     font-size: 18px;
                     text-align: center;
                  }
                  h1{
                     text-align: center;
                  }
               </style>
            </head>
            <body>
               <section>
                  <h1>Verifier le Compte IRISI</h1>
                  <p>Votre code de verification est : "."<h1 style>$verificationCode<h1>"."</p>
               </section>
               
            </body>
            </html>

            ";

            require 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;                                // Enable verbose debug output
            
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'ahddadmailer@gmail.com';           // SMTP username
            $mail->Password = 'ahddadMailer$$$$';                 // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS 587 encryption, `ssl` also accepted 465
            $mail->Port = 465;                                    // TCP port to connect to
            
            $mail->setFrom('ahddadmailer@gmail.com', 'imad');
            $mail->addAddress("$email", 'imad');  // Add a recipient 
            $mail->addReplyTo('ahddadmailer@gmail.com', 'reply');
            
            $mail->isHTML(true);                                  // Set email format to HTML
            
            $mail->Subject = 'Verifier le compte IRISI';
            $mail->Body    = $message;
            $mail->AltBody = 'Verifier le compte IRISI';
            
            if(!$mail->send()) {
               header("Location: form.php?error=failed to activate your account verify your connection");
               exit();
               // $mail->ErrorInfo
            } else {
               $_SESSION["code"] = $verificationCode;
               $_SESSION["cne"] = $cne;
               $_SESSION["apogee"] = $apogee;
               $_SESSION["email"] = $email;
               header("Location: Verification.php");
               exit();
            }

         }else{
            header("Location: form.php?success=Votre compte est deja activé");
            exit();
         }
         
      }else{
         header("Location: form.php?success=plusieurs lignes ont été trouvées");
         exit();
      }
   }else if(!$email){
      header("Location: form.php?error=email invalid");
      exit();
   }else{
      header("Location: form.php?error=failed to activate your account");
      exit();
   }

}else{
   header("Location: form.php?errorIsset");
   exit();
}

?>