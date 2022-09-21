<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Activate | Login</title>
   <link rel="stylesheet" href="../css/form.css">
   <script src="../js/script.js"></script>
</head>
<body>

   <?php
      include "navbar.html";
      // echo $_SERVER['DOCUMENT_ROOT']
   ?>
   <div class="title-none"><span>Cours-TD-TP</div>
   <div class="container">

      <form action="activate.php" method="POST" class="activate">
         <h1>Activer Votre Compte <?php echo $_SERVER['DOCUMENT_ROOT'] ?></h1>
         <input type="text" name="nom" id="nom" placeholder="Nom">
         <p class="error" id="error_nom">le nom doit contenir au moins 3 caracteres</p>
         <input type="text" name="prenom" id="prenom" placeholder="Prenom">
         <p class="error" id="error_prenom">le prenom doit contenir au moins 3 caracteres</p>
         <input type="text" name="cne" id="cne" placeholder="CNE">
         <p class="error" id="error_cne">le CNE doit contenir au moins 10 caracteres</p>
         <input type="number" name="apogee" id="apogee" placeholder="Apogee">
         <p class="error" id="error_apogee">l'Apogee doit contenir au moins 7 chiffres</p>
         <input type="email" name="email" id="email" placeholder="E-mail">
         <p class="error" id="error_email">E-mail invalid !</p>
         <select name="promo" id="promo" placeholder="Promotion">
            <option value="1" selected>IRISI 1</option>
            <option value="2">IRISI 2</option>
            <option value="3">IRISI 3</option>
         </select>
         <button id="envoyer" type="submit">Activer</button>

         <?php
         if(isset($_GET["error"])){ ?>
            <p class="errorAccount"><?php echo $_GET["error"]?></p>
         <?php } ?>

         <?php
         if(isset($_GET["success"])){ ?>
            <p class="successAccount"><?php echo $_GET["success"]?></p>
         <?php } ?>

      </form>



      <form action="login.php" method="POST" class="login">
         <h1>Se Connecter</h1>
         <?php
         if(isset($_GET["error2"])){ ?>
            <p class="errorAccount"><?php echo $_GET["error2"]?></p>
         <?php } ?>
         <input type="text" name="username" id="username" placeholder="votre CNE">
         <input type="password" name="password" id="password" placeholder="votre APOGEE">
         <select name="promoLogin" id="promoLogin">
            <option value="1" selected>IRISI 1</option>
            <option value="2">IRISI 2</option>
            <option value="3">IRISI 3</option>
         </select>
         <button type="submit">Se Connecter</button>
      </form>
   </div>
   
</body>
</html>