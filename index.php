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
    <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="assets/img/logo.png" width="60px">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Accueil</a></li>
          <li><a href="#" class="nav-link px-2 text-white">A propos</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Contact</a></li>
        </ul>     
        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2">Connexion</button>
          <button type="button" class="btn btn-warning">Inscription</button>
        </div>
      </div>
    </div>    
  </header>
  <main>
        <div class="s01 text-center">
      <form>
        <fieldset>
          <legend>La Belle Epoque</legend>
        </fieldset>
        <div class="inner-form">
          <div class="input-field first-wrap">
            <input id="search" type="text" placeholder="Marques" />
          </div>
          <div class="input-field second-wrap">
            <input id="location" type="text" placeholder="Modèle" />
          </div>
          <div class="input-field third-wrap">
            <button class="btn-search" type="button">Rechercher</button>
          </div>
        </div>
      </form>
    </div>
    <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="display-5 fw-bold text-body-emphasis">Qui je suis </h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Je me nomme Véronique  et vous invite à embarqué avec moi.
        <br>
Bienvenue dans mon voyage dans le temps.
<br>
Passionné de voitures enciennes,j'ai créé se site afin de partager
avec d'autre personnes ma passion.                                               
Echanger voir même découvrir de nouvelles voitures que je n'est peut-être  même jamais vue.
Je vous invites à vous joindre a moi,afin de pouvoir échanger,mettre des commentaires,des photos anciennes biensur,partir dans le monde de nos grands parents ou arrière grand parents.
Je pense qu'à notre époque cela peut nous faire que du bien.

 N'hésitez pas à me dire si j'ai pus faire une erreur de date ou de référence d'un vehicule  ,car je débute  vraiment ,avant je les regarder passe et puis voila ! à  présent je peux faire une photos et les partager avec un grand nombre de personne ,qui parfois non pas le temps ou le courage de se faire un album sans fin sur le net .
</p>
     
    </div>
  </div>
    <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

<?php
    // Creer un tableau associatif avec du texte et des images 

$data_Station = array("assets/img/Station/Sans_titre-19.jpg","assets/img/Station/Sans_titre-13.jpg","assets/img/Station/Sans_titre-16.jpg","assets/img/Station/Sans_titre-12.jpg","assets/img/Station/Sans_titre-17.jpg","assets/img/Station/Sans_titre-20.jpg","assets/img/Station/Sans_titre-14.jpg","assets/img/Station/Sans_titre-15.jpg","assets/img/Station/Sans_titre-18.jpg",);
$arrlength = count($data_Station);
for($i = 0; $i < $arrlength; $i++) {
?>


        <div class="col">
          <div class="card shadow-sm">
            <img src="<?php echo $data_Station[$i] ?>">
            <div class="card-body">
              <p class="card-text">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500.</p>
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
  <footer class="py-5">
    <div class="row">
      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Contact</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Mon espace client</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Gerer mes kookies</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"></a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"></a></li>
        </ul>
      </div>
      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
         <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Accessibilité numérique</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Protection de la  vie privée et cookies</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"></a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"></a></li>
        </ul>
      </div>
      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Information Legales</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Mentions Legales</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Conditions Générales d'Utilisation</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"></a></li>
        </ul>
      </div>
      <div class="col-md-5 offset-md-1 mb-3">
        <form>
          <h5>Subscribe to our newsletter</h5>
          <p>Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
            <button class="btn btn-primary" type="button">Subscribe</button>
          </div>
        </form>
      </div>
    </div>
    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
      <p>© 2023 Company, Inc. All rights reserved.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
        <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
        <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
      </ul>
    </div>
  </footer>
</body>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>