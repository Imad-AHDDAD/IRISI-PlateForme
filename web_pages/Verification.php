<?php

session_start();
if($_SESSION["code"]){

include "navbar.html";

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Verification</title>
   <link rel="stylesheet" href="../css/form.css">
</head>
<body>

   <div class="container2">
      <form class="activation" action="verify.php" method="post">
         <p class="check">check your box</p>
         <input type="number" name="code" id="code" required placeholder="Code de verification">
         <button type="submit">Envoyer</button>

         <?php
         if(isset($_GET["error"])){ ?>
            <p class="errorAccount" style="color: red;"><?php echo $_GET["error"]?></p>
         <?php } ?>

      </form>
   </div>
   
</body>
</html>

<?php

}else{
   header("Location: form.php?error2");
   exit();
}

?>