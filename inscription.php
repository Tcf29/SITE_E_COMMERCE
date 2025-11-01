<?php
require_once "ADMIN/SERVICES/cheminsBackend.php";
$actif="d-none";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTION</title>
    <link rel="stylesheet" href="assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <link rel="stylesheet" href="assets/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <script src="assets/JS/bootstrap.bundle.min.js" defer></script>
</head>
<body class="forme">
    <button class="btn btn-sm btn-dark btn-outline-primary text-white"><a href="#" class="text-white"><i class="fas fa-angle-left"> Retour</i></a></button>
    <div class="alert alert-success alert-dismissible 
    <?php if(isset($_GET["active"])){
                 if ($_GET["active"]=="alert_success"){ $actif="";}else{ $actif="d-none";} } echo $actif;?>">
      <p class="text-white fw-5 h5 text-center"> vous avez étè enregistré avec succès !S'il vous plait veuiller vous connecter maintenant.</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
    <div class="alert alert-danger alert-dismissible <?php if(isset($_GET["active"])){
                 if ($_GET["active"]=="alert_danger"){ $actif="";}else{ $actif="d-none";} } echo $actif; ?>">
      <p class="text-white fw-5 h5 text-center"> Cette adresse E-mail existe déja.veuiller changer s'il vous plait.</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
    <div class="container">
            <div class="text-primary inscription">
                BIENVENUE SUR L'INTERFACE D'INSCRIPTION DE <span class="text-warning">KJLS_FAST</span>
            </div>
        <form action="ADMIN/CONTROLLER/userController.php?action=inscription&cote=client" method="POST" class="w-75 formes p-2 position-relative">
            <div class="position-relative row">
                <div>
                    <label for="name" class="form-label text-info">NOM UTILISATEUR</label>
                    <input type="text" name="nom" id="name"  placeholder="NOM" required class="form-control w-100">
            </div>
            <div class="py-2">
                <label for="EMAIL" class="form-label text-info">EMAIL</label>
                <input type="email" name="email" id="EMAIL" placeholder="EMAIL" required class="form-control w-100">
            </div>
            <div class="py-2">
                <label for="password" class="form-label text-info">MOT DE PASSE</label>
                <input type="password" name="password" id="password" placeholder="MOT DE PASSE" required class="form-control w-100">
            </div>
            <div class="text-center py-3"> 
                <button type="submit"  class="btn btn-lg btn-outline-warning text-info w-50 forme">S'inscrire</button>
            </div>
            <div class="text-info text-center">
                <p class="compte">vous avez déja un compte? <a href="connexion.php" class="text-success">connexion</a></p>
                <p class="compte">Retrouver nous sur <br />
                <a href="https://www.google.com"><i class="fa-brands fa- fa-google"></i></a>   
                <a href="https://www.facebook.com"><i class="fa-brands fa- fa-facebook"></i></a>      
                <a href="https://www.instagram.com"><i class="fa-brands fa- fa-instagram"></i></a>
                </p>
            </div>
            </div>
        </form>
    </div>
    <script>
        const nav=document.querySelector(".alert");
document.addEventListener("scroll",()=>{
nav.classList.add("d-none");
});
    </script>
</body>
</html>
    <!-- <i class="fa-classic fa-solid fa-user position-absolute top-50"></i> -->
     <!--  <i class="fa-classic fa-solid fa-lock"></i> -->