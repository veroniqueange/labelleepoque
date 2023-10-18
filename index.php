<?php
session_start();

// J'inclus une connexion vers la BDD
include('./model/db_connexion.php');

/************************************************************
 *   Traitement des données SI la méthode est bien POST
 ***************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_POST = filter_input_array(
    INPUT_POST,
    [
      'marques' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
      'modeles' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]
  );
  // Initialisation des variables qui vont recevoir les champs du formulaire
  $marques = $_POST['marques'] ?? '';
  $modeles = $_POST['modeles'] ?? '';


  //  Faire requète SELECT 
  if (!empty($marques) && !empty($modeles)) {
  } else {
    $message = "<span class='message'>Veuillez renseigner tous les champs !</span>";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>La Belle Epoque</title>
</head>

<body>
  <header class="p-3 text" style="background-color:rgba(0, 0, 0, 50)">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="assets/img/logo.png" width="60px">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-white">Accueil</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Contact</a></li>
          <?php
          if (isset($_SESSION['id_user'])) {
          ?>
            <li><a href="Pompiers.php" class="nav-link px-2 text-white">Pompiers</a></li>
          <?php
          }
          ?>
        </ul>
        <div class="text-end">
          <?php
          if (isset($_SESSION['id_user'])) {
          ?>
            <a href="deconnexion.php" class="btn btn-outline-light me-2">Déconnexion</a>
          <?php
          } else {
          ?>
            <a href="connexion.php" class="btn btn-outline-light me-2">Connexion</a>
            <a href="creat_account.php" class="btn btn-outline-warning">Inscription</a>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="s01 text-center">
      <?php
      if (isset($_SESSION['id_user'])) {
      ?>
        <form action="#" method="post">
          <fieldset></fieldset>
          <legend>La Belle Epoque</legend>
          </fieldset>
          <div class="inner-form">
            <div class="input-field first-wrap">
              <input id="marques" name="marques" type="text" placeholder="Marque" />
            </div>
            <div class="input-field second-wrap">
              <input id="modeles" name="modeles" type="text" placeholder="Modèle" />
            </div>
            <div class="input-field third-wrap">
              <button class="btn-search" type="submit">Rechercher</button>
            </div>
          </div>
        </form>
      <?php
      } else {
      ?>
        <h1 class="text-white">La Belle Epoque</h1>
      <?php

      }
      ?>

    </div>
    <?php
    if (isset($_SESSION['id_user']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    ?>
      <div class="px-4 py-5 my-5 text-center">

        <p><?php echo $message; ?></p>
      </div>
    <?php
    }
    ?>

    <div class="px-4 py-5 my-5 text-center">
      <img src="assets/img/photo.png" alt="Ma photo" width="150px">
      <h1 class="display-5 fw-bold text-body-emphasis">Qui suis-je </h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Je m'appelle Véronique et je vous invite à embarquer avec moi.</p>

        <p class="lead mb-4">Bienvenue dans mon voyage dans le temps.</p>

        <p class="lead mb-4">Passionnée de voitures anciennes, j'ai créé ce site afin de partager ma passion avec d'autres personnes. Échanger, voire même découvrir de nouvelles voitures que je n'ai peut-être même jamais vues. Je vous invite à vous joindre à moi afin de pouvoir échanger, laisser des commentaires, partager des photos anciennes bien sûr, et voyager dans le monde de nos grands-parents ou arrière-grands-parents. Je pense qu'à notre époque, cela peut nous faire que du bien. N'hésitez pas à me dire si j'ai fait une erreur de date ou de référence d'un véhicule, car je débute vraiment. Avant, je les regardais passer et voilà ! À présent, je peux prendre des photos et les partager avec un grand nombre de personnes, qui parfois n'ont pas le temps ou le courage de se constituer un album sans fin sur le net.
        </p>

      </div>
    </div>
    <div class="album py-5 bg-body-tertiary">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

          <?php
          // Creer un tableau associatif avec du texte et des images 

          $data_Station = array("assets/img/Station/Sans_titre-16.jpg", "assets/img/Station/Sans_titre-20.jpg", "assets/img/Station/Sans_titre-18.jpg", "assets/img/Station/Sans_titre-12.jpg", "assets/img/Station/Sans_titre-19.jpg", "assets/img/Station/Sans_titre-14.jpg",);
          $arrlength = count($data_Station);
          for ($i = 0; $i < $arrlength; $i++) {
          ?>

            <div class="col">
              <div class="card shadow-sm">
                <img src="<?php echo $data_Station[$i] ?>">
                <div class="card-body">
                  <p class="card-text">Le Lorem Ipsum.</p>
                  <p class="card-text">Le Lorem Ipsum est simplement</p>
                  <p class="card-text">Le Lorem Ipsum est simplement du faux.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-body-secondary">9 mins</small>
                  </div>
                </div>
              </div>
            </div>


          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </main>
  <!-- Footer -->
  <footer class="text-center text-lg-start bg-whith text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Get connexion with us </span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>Belle Epoque
            </h6>
            <p>
              Une nouvelle histoire dans le monde de nos grands-parents ou arrière-grands-parents.

            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              CONTACT
            </h6>
            <p>
              <a href="#!" class="text-reset">
              </a>
            </p>
            <p>
              <a href="#!" class="text-reset">Mon Espace Client
              </a>
            </p>
            <p>
              <a href="#!" class="text-reset">GERER MES COOKIES
              </a>
            </p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              info@example.com
            </p>
            <p>
              <a href="#!" class="text-reset"></a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Informations legales
            </h6>
            <p>
              <a href="#!" class="text-reset"></a>
            </p>

            <p>
              <a href="#!" class="text-reset">Protection de la vie privée et cookies</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Accessibilité numérique</a>
            </p>
            <p>
              <a href="#!" class="text-reset"></a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="fas fa-home me-3"></i> INFORMATIONS LEGALES</p>
            <p><i class="fas fa-home me-3"></i> Conditions Générales d'Utilisation</p>

            <p><i class="fas fa-phone me-3"></i> </p>
            <p><i class="fas fa-print me-3"></i> </p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color:rgba(0, 0, 0, 50)">
      © 2021 Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>