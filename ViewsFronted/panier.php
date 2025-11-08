<?php
$active1="d-none";
?>
 <div class="alert alert-danger m-0 alert-dismissible bg-danger <?php if(isset($_GET["active"])){
     if ($_GET["active"]=="alert_danger_special"){ $active1="";}else{ $active1="d-none";} } echo $active1; ?>">
    <div class="text-white fw-5 h5 text-center">
      <?php
      if(isset($_SESSION["message-special"])):
        foreach($_SESSION["message-special"] as $message):?>
         <p class="text-white fw-5 h5 text-center">
           <?= $message?>
        </p>
        <?php endforeach;?>
        <?php endif; ?>
     </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
 </div>
 <!-- partir du panier -->
    
<div class="container" style="min-height:52.8vh !important">

     <h4 class="text-center text-dark pt-4">RECAPITULATIF DES PRODUITS AJOUTES AU PANIER</h4>
     <div class="d-flex mt-5 cards mb-3">
                <!-- code php pour automatiser -->
                
                <?php
                if(isset($_SESSION["panier"])):
                    $_SESSION["total_commande"]=0;

            foreach($_SESSION["panier"] as $product):
                // print_r($product["object"]);
                //     die();
               ?>
                <div class="card py-3">
                    <img src="ADMIN/FILES/<?=$product["object"]->photo?>" class="promo-img" alt="Promo 1">
                    <h5 class="text-danger fw-5 fs-5"><?=strtoupper($product["object"]->nom)?></h5>
                    <pre class="border border-success rounded-1 text-dark fw-1 fs-5">Prix:<span class="text-success fs-5 fw-1"><?=$product["object"]->prix_produit?></span></pre>
                    <pre class="border border-success rounded-1  text-dark fw-1 fs-5">Quantité:<span class="text-success fs-5 fw-1"><?=$product["quantite"]?></span></pre>
                    <pre class="border border-success rounded-1  text-dark fw-1 fs-5">Total: <span class="text-success fs-5 fw-1"><?=$product["total-produit"]?></span></pre>
              </div> 
              <?php $_SESSION["total_commande"] +=$product["total-produit"]?> 
              <?php endforeach;?>
      </div>
                <div class="border border-2 rounded-2 text-center bg-light my-2">
                    <p class="fs-3 fw-1 text-dark">TOTAL DE LA COMMANDE<span class="text-danger">(FCFA)</span></p>
                    <p class="btn btn-lg btn-dark text-white fs-2  w-75"><?=$_SESSION["total_commande"]?></p>
                </div>
        <div class="row w-100 d-flex flex-row align-items-center gap-3 border border-1 border-light shadow-5 p-3 mb-3 mt-2 bg-light rounded-1">
        <div class="col-md-12 btn btn-info text-white fs-5 text-center"><a href="pagePrincipaleFronted.php?chf=CATALOGUE1" class="nav-link">Ajouter un produit au panier</a></div>
        <div class="col-md-12 btn btn-danger text-white fs-5 text-center"><a href="ADMIN/CONTROLLER/produitController.php?action=viderpanier" class="nav-link">Vider le panier</a></div>
        <div class="col-md-12 btn btn-success text-white fs-5 text-center"><a href="ADMIN/CONTROLLER/commandeController.php?action=commander" class="nav-link">Commander</a></div>   
         </div>      
              <?php else:
                  echo "<div class=\"text-center fs-5 py-3 w-75 mx-auto mb-3  border border-1 border-info rounded-4 my-auto\">";
                echo '<div class="text-dark text-center fw-2 mx-auto"> Vous n\'avez pas encore ajouté de produit au panier</div>';
                echo "</div>";
            endif;?>
    <!-- code php pour automatiser -->
        </div>           
</div>


           