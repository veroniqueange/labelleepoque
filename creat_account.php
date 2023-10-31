<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

include('vendor/autoload.php');
// J'inclus une connexion vers la BDD
include('model/db_connexion.php');

/************************************************************
 *   Création de constantes qui contiennent les erreurs possibles
 ***************************************************************/
const ERROR_REQUIRED = 'Veuillez renseigner ce champs.';
const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = 'Le mot de passe doit contenir 10 caractères minimum.';
const ERROR_PASSWORD_DIFF = 'Les deux mots de passe sont différents.';

/************************************************************
 *   Initialisation d'un tableau contenant les erreurs possibles lors des saisies
 ***************************************************************/
$errors = [
    'login' => '',
    'passwd' => '',
    'email' => '',
    'cpasswd' => '',
];
$message = '';

/************************************************************
 *   Traitement des données SI la méthode est bien POST
 ***************************************************************/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(
        INPUT_POST,
        [
            'login' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'passwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'cpasswd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ]
    );
    // Initialisation des variables qui vont recevoir les champs du formulaire
    $login = $_POST['login'] ?? '';
    $passwd = $_POST['passwd'] ?? '';
    $email = $_POST['email'] ?? '';
    $cpasswd = $_POST['cpasswd'] ?? '';


    // Remplissage du tableau concernant les erreurs possibles
    if (!$login) {
        $errors['login'] = ERROR_REQUIRED;
    } elseif (!$email) {
        $errors['email'] = ERROR_REQUIRED;
    } elseif (!$passwd) {
        $errors['passwd'] = ERROR_REQUIRED;
    } elseif (mb_strlen($passwd) < 10) {
        $errors['passwd'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    } elseif ($cpasswd !== $_POST['cpasswd']) {
        $errors['cpasswd'] = ERROR_PASSWORD_DIFF;
    }

    // BDD_BELLE_EPOQUE: Ajouter la condition de 10 caractères sur le mdp
    if (($login) && !empty($login) && ($passwd) && !empty($passwd) && (mb_strlen($passwd) >= 10) && ($passwd === $cpasswd)) {
        $sql = 'SELECT  login FROM users WHERE login = :login';
        $db_statement = $db_connexion->prepare($sql);
        $db_statement->execute(
            array(':login' => $login)
        );

        // Si l'exécution de la requète retourne une valeur <= 0, alors on traite la demande
        $nb = $db_statement->rowCount();
        if ($nb <= 0) {
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+24 hour')); // Le token expire dans 24 heures
            $deleteOldTokens = $db_connexion->prepare("DELETE FROM user_tokens WHERE email = :email");
            $deleteOldTokens->execute([
                ':email' => $email,
            ]);
            $insertToken = $db_connexion->prepare('INSERT INTO user_tokens (login, email, passwd, token, expires_at) VALUES (:login, :email, :passwd, :token, :expires_at)');
            $insertToken->execute([
                ':login' => $login,
                ':email' => $email,
                ':passwd' => $passwd,
                ':token' => $token,
                ':expires_at' => $expires_at,
            ]);
            $message = '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image.png" type="image/x-icon">
    <title>La Belle Epoque | Inscription </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style type="text/css">
        body {
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: "Rubik", sans-serif;
            background-color: #e2e2e2;
            display: block;
        }
        .mb-3 {
            margin-bottom: 30px;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            display: inline-block;
            text-decoration: unset;
        }
        a {
            text-decoration: none;
        }
        h5 {
            margin: 10px;
            color: #777;
        }
        .text-center {
            text-align: center
        }
        .main-logo {
            width: 25px
        }
        .welcome-name h5 {
            font-weight: normal;
            margin: 10px 0 0;
            color: #232323;
            text-align: justify;
            line-height: 1.6;
            letter-spacing: 0.05em;
        }
        .welcome-details p span {
            color: #e22454;
            font-weight: 700;
            margin: 0 2px;
            text-decoration: underline;
        }
        .welcome-details p {
            font-weight: normal;
            font-size: 14px;
            color: #232323;
            line-height: 1.6;
            letter-spacing: 0.05em;
            margin: 0;
            text-align: justify;
        }
        .verify-button a {
            padding: 12px 30px;
            border: none;
            background-color: #6f42c1;
            color: #fff;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: 1.3px;
            border-radius: 5px;
        }
        .how-work li {
            margin: 0 20px;
            color: #232323;
            position: relative;
        }
        .how-work li:after {
            content: "";
            position: absolute;
            top: 50%;
            left: -21px;
            width: 2px;
            height: 70%;
            background-color: #7e7e7e;
            transform: translateY(-50%);
        }
        .how-work li:first-child::after {
            content: none;
        }
        .main-bg-light {
            background-color: #fafafa;
        }
    </style>
</head>
<body style="margin: 20px auto;">
    <table align="center" border="0" cellpadding="0" cellspacing="0"
        style="background-color: white; width: 100%; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);-webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
        <tbody>
            <tr>
                <td style="padding: 25px;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr class="header">
                                <td align="left" valign="top">
                                    <a href="index.html">
                                    <img src="image.png" class="main-logo" alt="logo">
                                    </a>
                                </td>
                                <td class="menu" align="right">
                                    <ul>
                                        <li style="display: inline-block;text-decoration: unset">
                                        <a href="index.php"
                                                style="text-transform: capitalize;color:#444;font-size:16px;margin-right:15px;text-decoration: none;">Accueil</a>
                                        </li>
                                        <li style="display: inline-block;text-decoration: unset">
                                        <a href="contact.php"
                                                style="text-transform: capitalize;color:#444;font-size:16px;margin-right:15px;text-decoration: none;">Contact</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table align="center" border="0" cellpadding="0" cellspacing="0"
        style="background-color: white; width: 100%; padding: 0 30px; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
        <tbody>
            <tr>
                <td class="welcome-image mb-3" style="display: block;">
                    <img src="image.png" style="width: 100%; margin-top: 20px;" alt="">
                </td>
                <td class="welcome-name mb-3" style="text-align: left; display: block;">
                    <h4 style="text-transform: capitalize; margin: 0; font-weight: 500; color: #232323">Bonjour et bienvenue sur La Belle Epoque !</h4>
                    <h5>Pour finaliser ton inscription, tu dois cliquer sur le bouton ci-dessous.</h5>
                </td>
                <td class="verify-button mb-3" style="display: block;">
                    <a href="http://localhost:3000/confirmation.php?token=' . $token . '">Finaliser</a>
                </td>
                <td class="welcome-details mb-3" style="display: block;">
                    <p>Tu reçois cet e-mail car tu t\'es inscrit(e) sur La Belle Epoque avec cette adresse e-mail.
                    Ne réponds pas à ce message, ta demande ne sera pas traitée. Si tu as des questions, 
                    utilise le lien <span>Contact</span>.</p>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="text-center" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="background-color: #eff2f7; color: #232323; padding: 40px 30px;">
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon text-center" align="center"
                    style="margin: 8px auto 20px;">
                    <tr>
                    <td>
                    <a href="#">
                        <img src="image.png" alt=""
                            style="font-size: 25px; margin: 0 18px 0 0;width: 22px;">
                    </a>
                </td>
                <td>
                    <a href="#">
                        <img src="image.png" alt=""
                            style="font-size: 25px; margin: 0 18px 0 0;width: 22px;">
                    </a>
                </td>
                <td>
                    <a href="#">
                        <img src="image.png" alt=""
                            style="font-size: 25px; margin: 0 18px 0 0;width: 22px;">
                    </a>
                </td>
                    </tr>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <ul class="how-work">
                        <li style="margin-left: 0;"><a style="color: #232323;" href="index.php">Accueil</a></li>
                        <li><a style="color: #232323;" href="contact.php">Contact</a></li>
                        <li style="margin-right: 0;"><a style="color: #232323;" href="CGU.php">C.G.U.V.</a></li>
                        </ul>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
            // Utilisation de PHPMailer

            try {
                $mail = new PHPMailer();
                $mail->SMTPDebug = 4;
                // Paramètres du serveur
                $mail->isSMTP();                                       // Définir l'envoi d'e-mail via SMTP
                $mail->Host       = 'sandbox.smtp.mailtrap.io';        // Spécifiez les serveurs SMTP d'OVH
                $mail->SMTPAuth   = true;                              // Activer l'authentification SMTP
                $mail->Username   = 'cba2685a1a8536';                  // Votre adresse e-mail
                $mail->Password   = '73513715e578a8';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Utiliser l'encryption TLS                   // Votre mot de passe de messagerie
                $mail->Port       = 2525;                              // Port pour TLS/STARTTLS

                // Expéditeur
                $mail->setFrom('safimess13@gmail.com', 'La Belle Epoque');

                // Destinataires
                $mail->addAddress($email);
                // Contenu
                $mail->isHTML(true);
                $mail->Subject = 'Ton inscription sur La Belle Epoque';
                $mail->Body = $message;
                $mail->send();
                echo "<div id='success_page' style='padding:25px 0'>";
                echo "<strong>Ton inscription a bien été prise en compte.</strong><br>";
                echo "Pour la valider, vérifie tes e-mails, un nouveau message vient de t'être envoyé avec les instructions nécessaires. Attention ! Vérifie également les sections spam, pourriel ou courriers indésirables si l'e-mail n'est pas visible dans ta boîte de reception.";
                echo "</div>";
            } catch (Exception $e) {
                echo "Une erreur s'est produite lors de la création du compte. Essaie de nouveau. Mailer Error: {$mail->ErrorInfo}";
                // Ici, vous pouvez gérer l'erreur. Par exemple, enregistrez l'erreur dans un fichier journal.
                $messageErreur = "Erreur d'envoi d'e-mail: " . $mail->ErrorInfo . "\n";
                file_put_contents('erreurlog.txt', $messageErreur, FILE_APPEND);
            }
            $message = "
                    <span class='message'>
                        Votre compte est créé ! Aller sur la page \" Se connecter \" et connectez-vous avec vos identifiants !
                    </span>
                ";
        } else {
            $message = "
                    <span class='message'>
                        Le login existe déjà !
                    </span>
                ";
        }
    } else {
        $message = "
                <span class='message'>
                Veuillez renseigner tous les champs !
                </span>
            ";
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow">
    <meta name="description" content="page creation de compte">
    <title>Inscription</title>
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
                    <a href="connexion.php" class="btn btn-outline-light me-2">Connexion</a>
                    <a href="#" class="btn btn-outline-warning">Inscription</a>

                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="s01 text-center">
            <h1 class="text-white">Inscrivez-vous !</h1>
        </div>
        <!-- Formulaire de connexion -->
        <section class="container mt-4">
            <div class="form-container text-center">
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <form action="" method="POST">
                            <p><?= $message ?></p>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" name="login" id="login" class="form-control" />
                                        <label class="form-label" for="login">Pseudo</label>
                                        <?= $errors['login'] ? '<p class="text-error">' . $errors['login'] . '</p>' : '' ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="email" name="email" id="email" class="form-control" />
                                        <label class="form-label" for="email">Email</label>
                                        <?= $errors['email'] ? '<p class="text-error">' . $errors['email'] . '</p>' : '' ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="password" name="passwd" id="passwd" class="form-control" />
                                        <label class="form-label" for="passwd">Mot de passe</label>
                                        <?= $errors['passwd'] ? '<p class="text-error">' . $errors['passwd'] . '</p>' : "" ?>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="password" name="cpasswd" id="cpasswd" class="form-control" />
                                        <label class="form-label" for="cpasswd">Confirmation Mdp</label>
                                        <?= $errors['cpasswd'] ? '<p class="text-error">' . $errors['cpasswd'] . '</p>' : "" ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" checked />
                                <label class="form-check-label" for="form6Example8"> Créer un compte ? </label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">Soumettre</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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