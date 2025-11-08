<?php
session_start();
require_once 'routesFronted.php';
$actif="lien";
$active3="d-none";
  ?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME|FAST</title>
    <link rel="stylesheet" href="assets/CSS/bootstrap.min.css">
    <script src="assets/JS/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="assets/CSS/APROPOS.css">
    <link rel="stylesheet" href="assets/CSS/Contact.css">
    <link rel="stylesheet" href="assets/CSS/style1.css">
     <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <script src="assets/JS/javascript.js" defer ></script>
</head>
<body>
    <div class="alert alert-success m-0 alert-dismissible alert-dismiss bg-success bg-opacity-75
    <?php if(isset($_GET["active"])){
                 if ($_GET["active"]=="alert_success"){ $active3="";}else{ $active3="d-none";} } echo $active3;?>">
      <p class="text-white fw-5 h5 text-center"><?=$_SESSION["message"];?></p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
    <div class="alert alert-danger m-0 alert-dismissible bg-danger bg-opacity-75 
    <?php if(isset($_GET["active"])){
                 if ($_GET["active"]=="alert_danger"){ $active3="";}else{ $active3="d-none";} } echo $active3; ?>">
      <p class="text-white fw-5 h5 text-center"><?=$_SESSION["message"];?></p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
    <!-- barre de navigation -->
    <nav class="w-100 border border-dark h-25 position-fixed z-2 bg-light">
        <div class="d-inline-block div1"><img src="assets/IMAGE/LOGO.png" alt="LOGO">
        </div>
        
       <div class="d-inline-block div2 pt-5">
             <ul class="list-inline d-flex justify-content-center gap-3 onglet">
                <li class="list-inline-item 
                <?php  if(isset($_GET["chf"])){
                 if ($_GET["chf"]=="ACCUEIL"){ $actif="lien";}else{ $actif=" ";} } echo $actif;?>
                "><a href="pagePrincipaleFronted.php?chf=ACCUEIL" class="nav-link">ACCUEIL</a></li>
                <li class="dropdown list-inline-item 
                <?php  if(isset($_GET["chf"])){
                 if (($_GET["chf"]=="CATALOGUE1")||($_GET["chf"]=="CATALOGUE2")||($_GET["chf"]=="CATALOGUE3")||($_GET["chf"]=="CATALOGUE4")){ 
                  $actif="lien";}else{ $actif=" ";} echo $actif;} ?>
                ">
                    <a class="dropdown-toggle nav-link"  href="#" data-bs-toggle="dropdown">
                        CATALOGUE</a>
                    <ul class="dropdown-menu">
                        <li><a href="pagePrincipaleFronted.php?chf=CATALOGUE1" class="dropdown-item">INFORMATIQUE</a></li>
                        <li><a href="pagePrincipaleFronted.php?chf=CATALOGUE2" class="dropdown-item">TELEPHONES ET ACCESSOIRES</a></li>
                        <li><a href="pagePrincipaleFronted.php?chf=CATALOGUE3" class="dropdown-item">TELEVISIONS ET AUDIO</a></li>
                        <li><a href="pagePrincipaleFronted.php?chf=CATALOGUE4" class="dropdown-item">ELECTROMENAGERS</a></li> 
                    </ul>   
                </li>
                <li class="list-inline-item
                <?php  if(isset($_GET["chf"])){
                 if ($_GET["chf"]=="A_PROPOS"){ $actif="lien";}else{ $actif=" ";}  echo $actif; } ?>
                
                "><a href="pagePrincipaleFronted.php?chf=A_PROPOS" class="nav-link">A PROPOS</a></li>
                <li class="list-inline-item
                <?php  if(isset($_GET["chf"])){
                 if ($_GET["chf"]=="CONTACT"){ $actif="lien";}else{ $actif=" ";}  echo $actif; } ?>
                "><a href="pagePrincipaleFronted.php?chf=CONTACT" class="nav-link">CONTACT</a></li>
        </ul>
       </div>
        <div class="d-inline-block div3 pt-5">
                <div class="d-flex gap-5">
               <p><i class="fa fa-bars fa-xl d-none pt-3"></i></p>
                <p><a href="pagePrincipaleFronted.php?chf=RESEARCH"><i class="fa fa-search d-inline-block fa-xl text-info pt-3"></i></a></p>
                <p><a href="pagePrincipaleFronted.php?chf=PANIER"><i class="fa fa-shopping-cart fa-xl d-inline-block text-info shop pt-3"><?php if(isset($_SESSION["nbre_click"])):?><span class="bg-warning"><?= $_SESSION["nbre_click"]?></span><?php endif;?></i></a></p>
                <p><i class="fa fa-user fa-xl d-inline-block text-info pt-3"></i></p>
                </div>
        </div>
    </nav>
      <?php
    if(isset($_SESSION["profil"])==true){
     $profil=$_SESSION["profil"];
  echo '
  <div class="profil1 profil border border-1 border-dark py-2 rounded-4 text-center bg-light z-2 d-none position-fixed">
           <h4>'.$profil["nom"].'</h4>
            <p><button type="button" class="btn  btn-warning marron fs-sm-1 fs-md-fs-2" title="Attention veuillez enregistrer votre panier sinon il sera perdu." ><a href="ADMIN/CONTROLLER/userController.php?action=disconnect&id_user='.$profil["id_user"].'" class="nav-link text-white fw-5">DECONNEXION</a></button></p>
            <p><button type="button" class="btn  btn-danger marron  fs-sm-1 fs-md-fs-2"><a href="pagePrincipaleFronted.php?chf=COMMANDECLIENT" class="nav-link text-white fw-5">VOS COMMANDES</a></button></p>
            <p><button type="button" class="btn  btn-info marron fs-sm-1" fs-md-fs-2"><a href="pagePrincipaleFronted.php?chf=FORMUPDATE" class="nav-link text-white fw-5">MISE A JOUR DE VOTRE PROFIL</a> </button></p>
    </div>
  ' ;
 
}else{ 
  echo '
      <div class="profil1 disconnect border border-1 border-dark rounded-4 text-center bg-light p-3 z-2 d-none position-fixed">
        <h5 class="opacity-75 text-primary">S \' il vous plaît veuiller d\'arbord vous incrire ou vous connecter</h5>
    <p><button class="btn btn-warning btn-lg text-white marron "><a href="inscription.php">S\'INSCRIRE</a></button></p>
   <p> <button class="btn btn-warning btn-lg text-white marron "><a href="connexion.php">SE CONNECTER</a></button></p>
      </div>
  ' ;
}
?>
    <!-- fin de la barre de navigation -->
    <!-- DEBUT DE LA PARTIE MAIN-->
     <main class="z-0">

      <!-- DEBUT DE LA PARTIE PRINCIPALE -->
       <?php include_once "$chf" ?>
 
    <!-- FIN DE LA SECTION PRINCIPALE -->
    

    <!-- FOOTER -->
 <footer class="bg-dark position-relative">

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
      <div class="text-white fs-5 text-center">Developped by KJLS &copy 2025 | all rights reserved</div>
</footer>
    <!-- END FOOTER -->
     </main>



  <script type="text/javascript">
        let nav=document.querySelectorAll(".alert");
         document.addEventListener("scroll",()=>{
         for(let i of nav){
        i.classList.add("d-none");
         }
         
         });
</script>

</body>
</html>