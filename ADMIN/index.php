<?php
require_once "SERVICES/routes.php";
$actif="lien";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KJLS|ADMIN</title>
    <link rel="stylesheet" href="../assets/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/styleb.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <script src="../assets/JS/bootstrap.bundle.min.js" defer></script>
    <script src="assets/JS/javascriptb.js" defer></script>

</head>
<body>
    <!-- barre de navigation -->
    <nav class="w-100 border border-dark position-fixed z-1 bg-primary">
        <div class="d-inline-block div1"><img src="../assets/IMAGE/LOGO.png" alt="LOGO">
        </div>
        
       <div class="d-inline-block div2 pt-5">
             <ul class="list-inline d-flex justify-content-center onglet">
                <li class="list-inline-item 
                <?php  if(isset($_GET["ch"])){
                 if ($_GET["ch"]=="DASHBOARD"){ $actif="lien";}else{ $actif=" ";} } echo $actif;?>
                "><a href="index.php?ch=DASHBOARD" class="nav-link">DASHBOARD</a>
                </li>

                <li class="list-inline-item
                <?php  if(isset($_GET["ch"])){
                 if ($_GET["ch"]=="PRODUITS"){ $actif="lien";}else{ $actif=" ";} echo $actif;} ?>
                "><a href="index.php?ch=PRODUITS" class="nav-link">PRODUITS</a>
                </li>

                <li class="list-inline-item
                <?php  if(isset($_GET["ch"])){
                 if ($_GET["ch"]=="COMMANDES"){ $actif="lien";}else{ $actif=" ";} echo $actif;} ?>
                "><a href="index.php?ch=COMMANDES" class="nav-link">COMMANDES</a>
                </li>

                <li class="list-inline-item
                <?php  if(isset($_GET["ch"])){
                 if ($_GET["ch"]=="UTILISATEURS"){ $actif="lien";}else{ $actif=" ";} echo $actif;} ?>
                "><a href="index.php?ch=UTILISATEURS" class="nav-link">UTILISATEURS</a>
                </li>
        </ul>
       </div>
        <div class="d-inline-block div3 pt-5">
                <div class="d-flex gap-5 justify-content-end">
               <p class="fa fa-bars fa-xl d-none text-white"></p>
                <p class="fa fa-user fa-2xl d-inline-block text-white"></p>
                </div>
        </div>
      <!-- </div>  -->
    </nav>
     <div class="profil border border-1 border-dark pt-2 rounded-4 text-center bg-light z-1 d-none">
           <h4>JUNIOR</h4>
            <p><button type="button" class="btn btn-lg btn-danger marron "><a href="#" class="nav-link text-white fw-5">DECONNEXION</a></button></p>
            <p><button type="button" class="btn btn-lg btn-warning marron "><a href="#" class="nav-link text-white fw-5">INFORMATIONS COMPTE</a></button></p>
            <p><button type="button" class="btn btn-lg btn-info marron"><a href="#" class="nav-link text-white fw-5">MISE A JOUR DE VOTRE PROFIL</a> </button></p>
      </div> 
    <!-- fin de la barre de navigation -->
<!-- DEBUT DE LA PARTIE MAIN-->
     <main class="z-0">


      <!-- DEBUT DE LA PARTIE PRINCIPALE -->
       <?php include "$ch"?>

    <!-- FIN DE LA SECTION PRINCIPALE -->


    <!-- FOOTER -->
 <footer class="bg-dark position-relative py-4">

        <div class="box-container d-flex flex-row justify-content-center">

            <div class="box d-flex flex-column">
            <h3 class="text-warning">Quick links</h3>
            <a href="#" class="text-info"> <i class="fas fa-angle-right"></i> Accueil</a>
            <a href="#" class="text-info"> <i class="fas fa-angle-right"></i>Catalogue</a>
            <a href="#" class="text-info"> <i class="fas fa-angle-right"></i>Commande</a>
            <a href="#" class="text-info"> <i class="fas fa-angle-right"></i>Contact</a>
            </div>

            <div class="box d-flex flex-column">
            <h3 class="text-warning">Extra links</h3>
            <a href="#" class="text-info"> <i class="fas fa-angle-right"></i>Connexion</a>
            <a href="#" class="text-info"> <i class="fas fa-angle-right"></i>Inscription</a>
            <a href="#" class="text-info"> <i class="fas fa-angle-right"></i>Mise a jour</a>
            </div>

            <div class="box d-flex flex-column">
            <h3 class="text-warning ">Contact us</h3>
            <a href="tel:671628735" class="text-info"><i class="fas fa-phone"></i> +237 697 56 12 72 </a>
            <a href="tel:671628735" class="text-info"><i class="fas fa-phone"></i> +237 6 57 01 92 68</a>
            <a href="#" class="text-info"><i class="fas fa-envelope"></i> kjls_fast@gamil.com</a>
            <!-- <a href="https://www.google.com/myplace"><i class="fas fa-map-marker-alt"></i> douala, cameroun- 400104 </a> -->
            </div>

            <div class="box d-flex flex-column">
            <h3 class="text-warning">Follow us</h3>
            <a href="#" class="text-info"><i class="fab fa-facebook-f"></i>facebook</a>
            <a href="#" class="text-info"><i class="fab fa-twitter"></i>twitter</a>
            <a href="#" class="text-info"><i class="fab fa-instagram"></i>instagram</a>
            <a href="#" class="text-info"><i class="fab fa-linkedin"></i>linkedin</a>
            </div>
      </div>
      <div class="text-center text-white">Devolepped by KJLS_FAST  &copy 2025|all rights reserved.</div>
</footer>
    <!-- END FOOTER -->
     </main>

   
</body>
</html>