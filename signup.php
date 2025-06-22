<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylee.css" >
</head>
<body>
  
<?php
      $host = 'mysql:host=localhost;dbname=myshop;'; 
            $login = 'root'; 
            $password = '';
            $options = [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ];

      try {
        $pdo = new PDO($host, $login, $password, $options);
        echo 'Connexion réussie';
      } catch (PDOException $e) {
        die('Erreur de connexion : ' . $e->getMessage());
      }
      $resultat = $pdo->prepare("INSERT INTO users (email, password, firstname, lastname, sex, address, city, postalcode)
        VALUES (:email, :password, :firstname, :lastname, :sex, :address, :city, :postalcode)");
      $resultat->execute([
        ':email' => $_POST['email'] ,
        ':password' => $_POST['password'] ?? null ,
        ':firstname' => $_POST['firstname'] ?? null,
        ':lastname' => $_POST['lastname'] ?? null,
        ':sex' => $_POST['sex'] ?? null,
        ':address' => $_POST['address'] ?? null,
        ':city' => $_POST['city'] ?? null,
        ':postalcode' => $_POST['postalcode'] ?? null
    ]);
      if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstname']) 
        && !empty($_POST['lastname']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['postalcode']))
           {
             
               $email = trim($_POST['email']);
               $password = trim($_POST['password']);
               $firstname = trim($_POST['firstname']);
               $lastname = trim($_POST['lastname']);
               $address = trim($_POST['address']);
               $city = trim($_POST['city']);
               $postalcode = trim($_POST['postalcode']);

               if(iconv_strlen($_POST['firstname']) < 3 )
               {
                   echo '<div class="alert alert-danger mt-3">⚠ Attention, le nom doit avoir mininum 3 caracteres.</div>';
               }
               else
               {
                   echo '<div class="alert alert-success mt-3">✅ Le nom : ' . $_POST['firstname'] . ' est correct ! Bienvenue sur notre site !</div>';
               }

               if(iconv_strlen($lastname) < 3 )
               {
                   echo '<div class="alert alert-danger mt-3">⚠ Attention, le prenom doit avoir mininum 3 caracteres.</div>';
               }
               else
               {
                   echo '<div class="alert alert-success mt-3">✅ Le prenom : ' . $lastname . ' est correct ! </div>';
               }
               if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
               {
                   echo "<div class='alert alert-danger mt-3'>⚠ Attention, le format de l'adresse email n'est pas correct. Veuillez renseigner une adresse email valide.</div>";
               }
               else
               {
                   echo '<div class="alert alert-success mt-3">✅ L\'email : ' . $email . ' est correct ! </div>';
               }
              if (iconv_strlen($postalcode) !== 5) {
                 echo '<div class="alert alert-danger mt-3">⚠ Attention, le code postal doit contenir exactement 5 chiffres.</div>';
               } elseif (!ctype_digit($postalcode)) {
                 echo '<div class="alert alert-danger mt-3">⚠ Attention, le code postal doit contenir uniquement des chiffres.</div>';
               } else {
                echo '<div class="alert alert-success mt-3">✅ Le code postal : ' . $postalcode. ' est correct !</div>';
               }
            
              if (strlen($password) < 6) {
               echo '<div class="alert alert-danger mt-3">⚠ Le mot de passe doit contenir au moins 6 caractères.</div>';
               }
               if (!preg_match('/[A-Z]/', $password)) {
                echo '<div class="alert alert-danger mt-3">⚠ Le mot de passe doit contenir au moins une lettre majuscule.</div>';
               }
               if (!preg_match('/[0-9]/', $password)) {
                echo '<div class="alert alert-danger mt-3">⚠ Le mot de passe doit contenir au moins un chiffre.</div>';
               }
              else {
                echo '<div class="alert alert-success mt-3">✅ Le mot de passe : ' . $password . ' est correct ! </div>';
              }

           }
?>
    <div class="container">
        <header>
            <h1>myShop</h1>
            <nav>
                <a href="admin.php"> All users </a>
            </nav><br>
        </header>
        <div class="body">
            <h2>Inscription</h3><br>
            <div class="error"> </div>
          <form  action="" method="POST"  id="myformulaire">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
                <label for="email">e-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="password" name="password" placeholder="password" required>
                <label for="password">password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname" required>
                <label for="firstname">firstname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname" required>
                <label for="lastname">lastname</label>
            </div>
            <div class="mb-3">
                <input type="radio"  id="male" name="sex" value="male" checked>
                <label for="male">Male</label>
                <input type="radio" id="female" name="sex" value="female" >
                <label for="female">female</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="address" name="address" placeholder="address" required>
                <label for="address">address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="city" name="city" placeholder="city" required>
                <label for="city">city</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="postalcode" name="postalcode" placeholder="postalcode" required>
                <label for="postalcode">postalcode</label>
            </div>
            <div class="mb-3">
             <input type="checkbox" value="j'ai lu et j'aprouve les conditions" id="terme" require>
             <label for="terme">J'ai lu et j'approuve les conditions generales d'utilisation</label>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary w-100" value="✅ submit" name="ok">
            </div>
          </form>
        </div>
        <div class="footer">
            <h2>Follow Us</h2>
            <div class="icon">
                <a href="https://facebook.com" target="_blank">
                    <img src="images/facebook.png" alt="facebook" width="40px" height="40px">
                </a>
                <a href="https://instagram.com" target="_blank">
                    <img src="images/instagram.png" alt="instagram" width="45px" height="45px">
                </a>
                <a href="https://twitter.com" target="_blank">
                    <img src="images/logos.png" alt="twitter" width="45px" height="45px">
                </a>
            </div>
        </div>
    </div>
    <script src="scripts.js" defer ></script>
</body>
</html>
 