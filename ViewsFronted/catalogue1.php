<?php
$request=curl_init("http://localhost/E_COMMERCE/ADMIN/CONTROLLER/produitController.php?action=readAllProduitCategorie&id_categorie=1");
curl_setopt($request,CURLOPT_RETURNTRANSFER,true);
$datas=curl_exec($request);
// var_dump($datas);
// die("merci");
$datas=json_decode($datas);
curl_close($request);
$all_produits=$datas;
// var_dump($all_produits);
// die("merci");

$tableSousCategorie=[];

foreach($all_produits as $produit){
    $sc=$produit->nom_sous_categorie;
    if(!isset($tableSousCategorie["$sc"])){
        $tableSousCategorie["$sc"]=[];
    }
    $tableSousCategorie["$sc"][]=$produit;
}
?>
<!-- debut section inforamtique -->
<div>
    <section>
          <div class="Informatique fs-sm-1 fs-md-2 fs-lg-3 pt-5 position-relative">
            <div class="text-left pt-5 ps-5 text-white gap-45 position-absolute top-50-1">
              <h1 class="fs-sm-1 fs-md-2 fs-lg-4">La haute gamme de l'informatique</h1>
              <h2 class="fs-sm-1 fs-md-2 fs-lg-4">Rtrouvez des produits tels que des laptops, des desktops avec <br>
              tous les périphériques associés </h2>
              <i class="fa-solid fa-arrow-down fleche fs-sm-1 fs-md-2 fs-lg-5"></i>
            </div>
        </div>
        
                
        <div class="section-card my-5 p-4">
            <h2 class="text-center mb-4">Laptops et Desktops</h2>
            <div class="d-flex mt-5 cards">
                  <?php if(sizeof($tableSousCategorie)>0):?>
             <?php  if(isset($tableSousCategorie["LAPTOPS"])) : ?>
                <!-- code php pour automatiser -->
                <?php foreach($tableSousCategorie["LAPTOPS"] as $product):?>
                <form class="card py-3" method="POST" action="ADMIN/CONTROLLER/produitController.php?action=ajoutpanier&id_categorie=1&recherche=false">
                    <img src="ADMIN/FILES/<?=$product->photo?>" class="promo-img" alt="Promo 1">
                    <h5><?=$product->nom?></h5>
                    <?php if (!isset($_SESSION["object-produit"])){
                         $_SESSION["object-produit"]=[];
                        }
                        if(!isset($_SESSION["object-produit"]["$product->id_produit"])){
                            $_SESSION["object-produit"]["$product->id_produit"]=$product;
                        }
                        ?>
                    <input type="hidden" name="id_produit" value="<?=$product->id_produit?>">
                    <p class="new-price"><?=$product->prix_produit?></p>
                      <label for="quantite"  class="form-label">Quantite</label>
                        <input type="number" min="1" max="100" name="quantite" class="form-control border border-1 border-primary" required placeholder="Entrer une quantite">
                    <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                </form>  
                <?php
             endforeach;?>
                <?php else:
                    echo "<p class='text-center text-info fs-5 fw-5'>AUCUN PRODUIT DISPONIBLE DANS CETTE SOUS CATEGORIE POUR LE MOMENT</p>"; 
                endif; ?>

                <!-- code php pour automatiser -->           
            </div>   
        </div>       
            
            <div class="section-card my-5 p-3 h-50">
                <h2 class="text-center mb-4">Périphériques</h2>
                <!-- code php pour automatiser -->
             <?php  if(isset($tableSousCategorie["PERIPHERIQUES"])) : ?>

                <div class="d-flex mt-5 cards">
                 <?php foreach($tableSousCategorie["PERIPHERIQUES"] as $product):?>
                    <form class="card" method="POST" action="ADMIN/CONTROLLER/produitController.php?action=ajoutpanier&id_categorie=1&recherche=false">
                        <img src="ADMIN/FILES/<?=$product->photo?>" class="promo-img" alt="Promo 1">
                        <h5><?=$product->nom?></h5>
                        <?php if (!isset($_SESSION["object-produit"])){
                         $_SESSION["object-produit"]=[];
                        }
                        if(!isset($_SESSION["object-produit"]["$product->id_produit"])){
                            $_SESSION["object-produit"]["$product->id_produit"]=$product;
                        }
                        ?>
                    <input type="hidden" name="id_produit" value="<?=$product->id_produit?>">
                        <p class="new-price"><?=$product->prix_produit?></p>
                        <label for="quantite"  class="form-label">Quantite</label>
                        <input type="number" name="quantite" min="1" max="100" class="form-control border border-1 border-primary" required placeholder="Entrer une quantite">
                        <button class="btn btn-primary">Ajouter au panier</button>
                    </form>
                 <?php endforeach?>
           <?php else:
                   echo "<p class='text-center text-info fs-5 fw-5'>AUCUN PRODUIT DISPONIBLE DANS CETTE SOUS CATEGORIE POUR LE MOMENT</p>"; 
                endif; ?>
               </div> 
               <!-- code php pour automatiser -->    
           </div>
       <?php else:?>
            <p class='text-center text-info fs-5 fw-5'>AUCUN PRODUIT DISPONIBLE DANS CETTE  CATEGORIE POUR LE MOMENT</p>
          
    <?php endif ?>
 </section>
</div>
        <!-- fin de la section informatique -->