<?php
$success = "";
$error = "";
$nom = $prenom = $email = $sujet = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars(trim($_POST["nom"] ?? ""));
    $prenom = htmlspecialchars(trim($_POST["prenom"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $sujet = htmlspecialchars($_POST["sujet"] ?? "");
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($sujet) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Connexion à la base de données
        $host = 'mysql:host=localhost;dbname=contacts;';
        $login = 'root';
        $password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];

        try {
            $pdo = new PDO($host, $login, $password, $options);

            $stmt = $pdo->prepare("INSERT INTO messages (nom, prenom, email, sujet, message) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$nom, $prenom, $email, $sujet, $message])) {
                $success = "✅ Merci <strong>$prenom $nom</strong> ! Votre message sur '<em>$sujet</em>' a bien été envoyé.";
                // Réinitialiser les champs
                $nom = $prenom = $email = $sujet = $message = "";
            } else {
                $error = "❌ Une erreur est survenue lors de l’envoi. Veuillez réessayer.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion : " . $e->getMessage();
        }
    } else {
        $error = "⚠️ Veuillez remplir tous les champs correctement.";
    }
}
?>
<?php if (!empty($success)): ?>
  <div class="alert alert-success"><?= $success ?></div>
<?php elseif (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact – L'Archeo-IT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
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
                    <li class="nav-item"><a class="nav-link active" href="./Contact.php">Contacts</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Inscription.php">Inscriptions</a></li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Recherche">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<main class="container py-5 mt-5">
    <h2 class="text-center mb-4">📬 Contact – L'Archeo-IT</h2>
    <form method="POST" action="" class="bg-white p-4 shadow rounded">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $nom ?>" required>
            </div>
            <div class="col-md-6">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $prenom ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
        </div>
        <div class="mb-3">
            <label for="sujet" class="form-label">Sujet</label>
            <select class="form-select" id="sujet" name="sujet" required>
                <option value="">-- Sélectionnez un sujet --</option>
                <option value="Demande d’infos" <?= $sujet == "Demande d’infos" ? "selected" : "" ?>>Demande d’infos</option>
                <option value="Demande de Rendez-vous" <?= $sujet == "Demande de Rendez-vous" ? "selected" : "" ?>>Demande de Rendez-vous</option>
                <option value="Autre" <?= $sujet == "Autre" ? "selected" : "" ?>>Autre</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Votre message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required><?= $message ?></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</main>
<footer class="bg-dark text-white text-center mt-5 p-3">
    <p>&copy; 2025 Archeo-IT – Tous droits réservés.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


