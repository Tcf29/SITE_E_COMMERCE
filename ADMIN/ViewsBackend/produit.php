<?php
// phpinfo();
$request=curl_init("http://localhost/E_COMMERCE/ADMIN/CONTROLLER/produitController.php?action=readAllProduit");
curl_setopt($request,CURLOPT_RETURNTRANSFER,true);
$datas=curl_exec($request);
// var_dump($datas);
// die("merci");
$datas=json_decode($datas);
curl_close($request);
$all_produits=$datas;
// var_dump($all_users);
// die("merci");
$actif="d-none";
?>
    <div class="py-3 d-flex justify-content-between px-2 align-items-center">
        <h6 class="d-inline-block text-success">LISTES DES PRODUITS</h6>
        <button class="btn btn-outline-success  d-inline-block w-50"><a href="index.php?ch=FORMULAIRE_CREATION_PRODUIT" class="nav-link">Ajouter un produit</a></button>
    </div>
<div class="table-responsive fs-sm-2 table-bordered px-2">
     <table class="table table-striped fs-6">
        <thead>
            <tr>
            <th>PHOTO</th>
            <th>NOM</th>
            <th>CATEGORIE</th>
            <th>SOUS CATEGORIE</th>
            <th>PRIX</th>
            <th>STATUS</th>
            <th>ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <?php if(sizeof($all_produits)>0):
            foreach($all_produits as $produit):
          ?>
          <tr>
       <td><img src="FILES/<?=$produit->photo?>" class="img img-rounded w-25 h-25" style="width:80px !important;height:70px !important;"/></td>
       <td class="pt-4"><?=$produit->nom?></td>
       <td class="pt-4"><?=$produit->nom_categorie?></td>
        <td class="pt-4"><?=$produit->nom_sous_categorie?></td>
       <td class="pt-4"><?=$produit->prix_produit?></td>
       <td class="pt-4"><?=$produit->status?></td>
       <td class="text-center">
        <button class="btn btn-sm btn-outline-warning mb-1"><a href="CONTROLLER/produitController.php?action=actived&id_produit=<?=$produit->id_produit?>"><i class="fas fa-user-check text-dark"></i></a></button>
        <button class="btn btn-sm btn-outline-danger mb-1"><a href="CONTROLLER/produitController.php?action=desactived&id_produit=<?=$produit->id_produit?>"><i class="fas fa-user-slash text-dark"></i></a></button>
        <button class="btn btn-sm btn-outline-success mb-1"><a href="#"><i class="fas fa-user-edit text-dark"></i></a></button>
       </td>
      </tr>
      <?php endforeach;?>
      <?php endif;?>      
        </tbody>
     </table>
</div>
    