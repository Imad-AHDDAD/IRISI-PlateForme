

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | Admin</title>
   <link rel="stylesheet" href="../../css/LoginAdminForm.css">
</head>
<body>

   <?php include "navbar2.html" ?>

   <section>
   <form action="LoginAdmin.php" method="POST">
         <h1>Se Connecter</h1>
         <?php
         if(isset($_GET["error"])){ ?>
            <p class="error"><?php echo $_GET["error"]?></p>
         <?php } ?>
         <input type="text" name="user" id="user" placeholder="Nom d'utilisateur">
         <input type="password" name="pass" id="pas" placeholder="Mot de passe">
         <button type="submit">Se Connecter</button>
      </form>
   </section>

   
</body>
</html>