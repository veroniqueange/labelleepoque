<?php
session_start();

// J'inclus une connexion vers la BDD
include('./model/db_connexion.php');

$reponse = '';
/* Page: contact.php */
// Mettez ici votre adresse mail
$AdresseMail = "veronique.angenieux@gmail.com";

// Si le bouton "Envoyer" est cliqué
if (isset($_POST['envoyer'])) {
    // On vérifie que le champ mail est correctement rempli
    if (empty($_POST['mail'])) {
        $reponse = "Le champ mail est vide";
    } else {
        // On vérifie que l'adresse est correcte
        if (!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i", $_POST['mail'])) {
            $reponse = "L'adresse mail entrée est incorrecte";
        } else {
            // On vérifie que le nom est correct
            if (empty($_POST['name'])) {
                $reponse = "Le champ nom est vide";
            } else {
                // On vérifie que le champ sujet est correctement rempli
                if (empty($_POST['sujet'])) {
                    $reponse = "Le champ sujet est vide";
                } else {
                    // On vérifie que le champ message n'est pas vide
                    if (empty($_POST['message'])) {
                        $reponse = "Le champ message est vide";
                    } else {
                        // Tout est correctement renseigné, on envoie le mail
                        // On renseigne les entêtes de la fonction mail de PHP
                        $Entetes = "MIME-Version: 1.0\r\n";
                        $Entetes .= "Content-type: text/html; charset=UTF-8\r\n";
                        $Entetes .= "From: LA BELLE EPOQUE <" . $_POST['mail'] . ">\r\n";
                        $Entetes .= "Reply-To: LA BELLE EPOQUE <" . $_POST['mail'] . ">\r\n";

                        // On prépare les champs
                        $Name = $_POST['name'];
                        $Mail = $_POST['mail'];
                        $Sujet = '=?UTF-8?B?' . base64_encode($_POST['sujet']) . '?=';
                        $Message = htmlentities($_POST['message'], ENT_QUOTES, "UTF-8");

                        // Tentative d'envoi du courriel
                        try {
                            // Utilisation de la fonction mail()
                            mail($AdresseMail, $Sujet, nl2br($Message), $Entetes);

                            // Si l'envoi réussit, afficher un message de succès
                            $reponse = 'Le mail a été envoyé avec succès.';
                        } catch (Exception $e) {
                            // En cas d'erreur, afficher un message d'erreur et enregistrer les détails dans un fichier
                            $errorMessage = 'Erreur lors de l\'envoi du courriel : ' . $e->getMessage();
                            $reponse = "Une erreur est survenue, le mail n'a pas été envoyé";

                            // Enregistrement des détails de l'erreur dans un fichier error_mail.txt
                            $errorLogFile = 'error_mail.txt';
                            file_put_contents($errorLogFile, $errorMessage . "\n", FILE_APPEND);
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index,follow">
    <meta name="description" content="Page de contact ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="assets/img/logo.png" width="60px">
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 text-white">Accueil</a></li>
                    <li><a href=" #" class="nav-link px-2 text-white">Contact</a></li>
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
            <h1 class="text-white">Contactez-nous !</h1>
        </div>
        <!-- Formulaire de contact -->
        <!--Section: Contact v.2-->
        <section class="container mb-4">

            <div class="row my-4">

                <!--Grid column-->
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="#" method="POST">
                        <p><?= $reponse ?></p>
                        <!--Grid row-->
                        <div class="row mb-5">

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control">
                                    <label for="name" class="">Nom</label>
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="mail" name="mail" class="form-control">
                                    <label for="email" class="">email</label>
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <input type="text" id="sujet" name="sujet" class="form-control">
                                    <label for="subject" class="">Sujet</label>
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row mb-5">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                    <label for="message">message</label>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->



                        <div class="text-center text-md-left">
                            <input class="btn btn-primary" name="envoyer" type="submit" value="Soumettre"></input>
                        </div>
                    </form>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-map-marker-alt fa-2x"></i>
                            <p>San Francisco, CA 94126, USA</p>
                        </li>

                        <li><i class="fas fa-phone mt-4 fa-2x"></i>
                            <p>+ 01 234 567 89</p>
                        </li>

                        <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                            <p>contact@mdbootstrap.com</p>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

            </div>

        </section>
        <!--Section: Contact v.2-->
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