<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Archeo-IT | Accueil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
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
                    <li class="nav-item"><a class="nav-link active" href="./index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Listes.php">Listes</a></li>
                    <li class="nav-item"><a class="nav-link" href="./Contact.php">Contacts</a></li>
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
  <main class="container mt-5 pt-5">
    <h1 class="text-center mb-4 gradient-text">Dernières Actualités de l'Archeo-IT</h1>
    <div class="row g-4">

      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <img src="images/1.jpg" class="card-img-top" alt="Atelier fouilles">
          <div class="card-body">
            <h5 class="card-title">Atelier fouilles numériques</h5>
            <p class="card-text">Retour sur notre atelier de numérisation d’objets archéologiques organisé le mois dernier à Namur.</p>
            <a href="#" class="btn btn-primary">Lire plus</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <img src="images/2.jpg" class="card-img-top" alt="Conférence IA">
          <div class="card-body">
            <h5 class="card-title">Conférence : IA & Archéologie</h5>
            <p class="card-text">L’IA aide les archéologues ? Découvrez comment l’IT transforme la recherche de vestiges anciens.</p>
            <a href="#" class="btn btn-primary">Lire plus</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <img src="images/4.jpg" class="card-img-top" alt="Expo virtuelle">
          <div class="card-body">
            <h5 class="card-title">Expo virtuelle 3D</h5>
            <p class="card-text">Visitez depuis chez vous notre nouvelle exposition interactive des découvertes belges récentes.</p>
            <a href="#" class="btn btn-primary">Explorer</a>
          </div>
        </div>
      </div>
    </div>
  </main>
  <section class="bg-light py-5">
  <div class="container">
    <h2 class="text-center mb-4">À propos de Archéo-IT</h2>
    <p class="lead text-justify">
      Archéo-IT est une plateforme dédiée à la valorisation de l'archéologie en France Cette initiative a pour but de faire découvrir au grand public et aux passionnés 
      les dernières actualités du monde archéologique, les chantiers de fouilles en cours, ainsi que les coulisses du métier d’archéologue.
      Grâce à une interface moderne et accessible, Archéo-IT met à disposition :une carte interactive des chantiers actifs sur le territoire,des galeries photos et fiches descriptives des sites,
      un espace membre pour accéder à plus de contenu,un formulaire de contact pour toute question ou collaboration.
      Le site s’adresse aussi bien aux étudiants, chercheurs, qu’aux curieux souhaitant en apprendre davantage sur le patrimoine enfoui sous nos pieds.
      🔍Explorez le passé, à la lumière des technologies d’aujourd’hui.
    </p>
  </div>
</section>
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
      <p>&copy; 2025 Archeo-IT – Tous droits réservés.</p>
      <div class="d-flex justify-content-center gap-3">
        <a href="https://www.instagram.com" target="_blank" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
        <a href="https://www.facebook.com" target="_blank" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
        <a href="https://www.tiktok.com" target="_blank" class="text-white"><i class="fab fa-tiktok fa-lg"></i></a>
        <a href="https://www.snapchat.com" target="_blank" class="text-white"><i class="fab fa-snapchat-ghost fa-lg"></i></a>
      </div>
    </div>
  </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
