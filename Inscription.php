<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Archeo-IT</title>
    <link rel="stylesheet" href="Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="my_navbar navbar navbar-expand-lg w-100 navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">Archeo-IT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="./index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Listes.php">Listes</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Contact.php">Contacts</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./Inscription.php">Inscriptions</a></li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Recherche">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>
</header>
<main class="mt-5 pt-5">
    <div class="container">
        <h1 class="mb-4">Inscription</h1>
<?php
$success = "";
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'mysql:host=localhost;dbname=Inscriptions;';
    $login = 'root';
    $passwordDB = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ];

    try {
        $pdo = new PDO($host, $login, $passwordDB, $options);
    } catch (PDOException $e) {
        die('<div class="alert alert-danger">Erreur de connexion : ' . $e->getMessage() . '</div>');
    }

    $email = trim($_POST['email'] ?? '');
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $sex = $_POST['sex'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $postalcode = trim($_POST['postalcode'] ?? '');
    $conditions = isset($_POST['terme']);

    $errors = [];
    if (strlen($firstname) < 3) $errors[] = "⚠ Le prénom doit contenir au moins 3 caractères.";
    if (strlen($lastname) < 3) $errors[] = "⚠ Le nom doit contenir au moins 3 caractères.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "⚠ Adresse email invalide.";
    if (strlen($postalcode) !== 5 || !ctype_digit($postalcode)) $errors[] = "⚠ Code postal invalide.";
    if (!$conditions) $errors[] = "⚠ Vous devez accepter les conditions d'utilisation.";

    if (count($errors) > 0) {
        echo '<div class="alert alert-danger"><ul>';
        foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>';
        echo '</ul></div>';
    } else {
        // Exécute le script Python
        $mode = $_POST['mode'] ?? '2'; // Mode = lettres + chiffres
        $cmd = escapeshellcmd("python Inscription.py $mode");
        $mot_de_passe = trim(shell_exec($cmd));

        // Hash du mot de passe
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (email, password, firstname, lastname, sex, address, city, postalcode)
                VALUES (:email, :password, :firstname, :lastname, :sex, :address, :city, :postalcode)");

        $stmt->execute([
            ':email' => $email,
            ':password' => $hashedPassword,
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':sex' => $sex,
            ':address' => $address,
            ':city' => $city,
            ':postalcode' => $postalcode
        ]);

        echo '<div class="alert alert-success">✅ Inscription réussie ! Votre mot de passe généré est : <strong>' . htmlspecialchars($mot_de_passe) . '</strong></div>';
    }
}
?>


        <form action="" method="POST" id="myformulaire" class="mt-4">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
                <label for="email">E-mail</label>
            </div>
            <!-- <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                <label for="password">Mot de passe</label>
            </div> -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" required>
                <label for="firstname">Prénom</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" required>
                <label for="lastname">Nom</label>
            </div>
            <div class="mb-3">
                <label>Sexe :</label><br>
                <input type="radio" id="male" name="sex" value="male" checked>
                <label for="male">Homme</label>
                <input type="radio" id="female" name="sex" value="female">
                <label for="female">Femme</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="address" name="address" placeholder="Adresse" required>
                <label for="address">Adresse</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="city" name="city" placeholder="Ville" required>
                <label for="city">Ville</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="postalcode" name="postalcode" placeholder="Code postal" required>
                <label for="postalcode">Code postal</label>
            </div>
            <div class="mb-3">
                <input type="checkbox" name="terme" id="terme" value="1" required>
                <label for="terme">J'ai lu et j'accepte les conditions générales d'utilisation</label>
            </div>
            <div class="mb-3">
                <label for="mode">Niveau de sécurité du mot de passe :</label>
                <select class="form-select" name="mode" id="mode" required>
                  <option value="1">1 - Lettres uniquement</option>
                  <option value="2" selected>2 - Lettres + Chiffres</option>
                  <option value="3">3 - Lettres + Chiffres + Caractères spéciaux</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary w-100" value="✅ S'inscrire" name="ok">
            </div>
            <div class="text-center mt-3">
               🔐 Déjà inscrit ? <a href="connexion.php">Cliquez ici pour vous connecter</a>
            </div>

        </form>
    </div>
</main>
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
      <p>&copy; 2025 Archeo-IT – Tous droits réservés.</p>
      <div class="d-flex justify-content-center gap-3">
        <a href="https://www.instagram.com" target="_blank" class="text-white"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com" target="_blank" class="text-white"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.tiktok.com" target="_blank" class="text-white"><i class="fab fa-tiktok"></i></a>
        <a href="https://www.snapchat.com" target="_blank" class="text-white"><i class="fab fa-snapchat-ghost"></i></a>
      </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
