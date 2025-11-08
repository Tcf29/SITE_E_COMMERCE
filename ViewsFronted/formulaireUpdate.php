<?php
$profil=$_SESSION["profil"];
$id_user=$profil["id_user"];
$email=$profil["email"];
$nom=$profil["nom"];
$actife="d-none";
?>
<div class="container">
   <h3 class="text-center text-info fs-sm-1">MISE A JOUR DU PROFIL</h3>
   <form action="ADMIN/CONTROLLER/userController.php?action=updateUser&id_user=<?=$id_user?>" method="POST" class="text-dark fs-sm-1">
   <div class="row position-relative start-25">
     <div>
        <label for="nom" class="form-label">NOM D'UTILISATEUR</label>
        <input type="text" name="nom" id="nom" value="<?=$nom?>"  class="form-control" required>
    </div>
    <div>
        <label for="email" class="form-label">EMAIL</label>
        <input type="email" name="email" id="email"value="<?=$email?>" class="form-control" required>
    </div>
    <div>
        <label for="password" class="form-label">ANCIEN MOT DE PASSE </label>
        <input type="password" name="ancien_password" id="password" class="form-control" required>
    </div>
     <div>
        <label for="password" class="form-label">NOUVEAU MOT DE PASSE </label>
        <input type="password" name="new_password" id="password" class="form-control" required>
    </div>
   <div class="col-sm-12  py-3 d-flex justify-content-evenly" >
                <button type="reset" class="btn btn-danger btn-lg text-center w-25 fs-6"><a href="pagePrincipaleFronted.php?chf=ACCUEIL" class="nav-link">ANULLER</a></button>
               <button type="submit" class="btn  btn-success btn-lg text-center w-25 fs-6 dropdown">ENVOYER</button>
   </div>
   </div>
   </form>
</div>