<?php
session_start();
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (!empty($email) && !empty($password)) {
        // Connexion BDD
        $pdo = new PDO('mysql:host=localhost;dbname=Inscriptions;', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ]);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstname'] = $user['firstname'];
            header("Location: index.php");
            exit();
        } else {
            $loginError = "❌ Email ou mot de passe incorrect.";
        }
    } else {
        $loginError = "⚠️ Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Archeo-IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <h2 class="text-center mb-4">🔐 Connexion</h2>

    <?php if (!empty($loginError)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($loginError) ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 shadow rounded">
        <div class="form-floating mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            <label for="email">Adresse e-mail</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required>
            <label for="password">Mot de passe</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
</main>
</body>
</html>
