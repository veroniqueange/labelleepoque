<?php
session_start();
    
// J'inclus une connexion vers la BDD
include('./model/db_connexion.php');

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
    'mail' => '',
    'cpasswd' => ''
];
$message = '';




?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
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
                    <li><a href="#" class="nav-link px-2 text-white">Contact</a></li>
                </ul>
                <div class="text-end">
                    <a href="connexion.php" class="btn btn-outline-light me-2">Connexion</a>
                    <a href="creat_account.php" class="btn btn-outline-warning">Inscription</a>
                    

                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="s01 text-center">
        <h1 class="text-white">Mot de passe perdu!</h1>
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
                                        <input type="email" name="mail" id="mail" class="form-control" />
                                        <label class="form-label" for="mail">Email</label>
                                        <?= $errors['mail'] ? '<p class="text-error">' . $errors['mail'] . '</p>' : '' ?>
                                    </div>
                                </div>
                        </div>  
                        <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="password" name="passwd" id="passwd" class="form-control" />
                                        <label class="form-label" for="passwd">Nouveau mot de passe</label>
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
                               <a href="#!" class="text-reset"></a> </p>
                                                      
                           <p>
                               <a href="#!" class="text-reset">Protection de la  vie privée et cookies</a></p>
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
                        
                           <p><i class="fas fa-phone me-3"></i>   </p>
                           <p><i class="fas fa-print me-3"></i>  </p>
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