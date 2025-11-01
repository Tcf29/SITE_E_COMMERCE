<?php
require_once "../SERVICES/service.php";
if(isset($_GET['action'])){
    $action=$_GET['action'];
    if($action="create_produit"){
    try {
        //informations get venant du backend manquant

    //  
            $transaction=$bd->beginTransaction();
            $produit->insertDatasProduit($id_categorie,$nom,$description,$prix_produit,$photo,$status,$transaction);
            $last_id=$bd->getLastId($transaction);
            if($type_mouvement=="ENTREE"){
                $stock->insertDatasStock($last_id,$quantite,$transaction); 
                $mouvementStock->insertDatasMouvement($last_id,$type_mouvement,$quantite,$transaction);
            }
            $bd->commit($transaction);

            header ("Location:../index.php?ch=PRODUITS");

    } catch (EXCEPTION $e) {
            echo "ERROR".$e->getMessage();
            $bd->rollBack($transaction);
    }
//   if(($type_mouvement=="ENTREE")||($type_mouvement=="RETOUR")){
//              $stockBd=$this->stock->readStock($id_produit,$transaction);
//              $stock_disponible=$stockBd->stock_disponible + $quantite;
//              $this->stock->updateStock($id_produit,$stock_disponible,$transaction);
//             }
//             if($type_mouvement=="SORTIE"){
//              $stockBd=$this->stock->readStock($id_produit,$transaction);
//              $stock_disponible=$stockBd->stock_disponible-$quantite;
//              $this->stock->updateStock($id_produit,$stock_disponible,$transaction); 
//             }
// $stockBd=$this->stock->readStock($id_produit);
//   $verify=false;
//   if($stockBd->stock_disponible >=$quantite){
//     $verify=true;
//   }

          
    }
    if($action=="update_stock_cote_admin"){
        // informations venant du back office
              if(($type_mouvement=="ENTREE")||($type_mouvement=="RETOUR")){
             $stockBd=$stock->readStock($id_produit,$transaction);
             $stock_disponible=$stockBd->stock_disponible + $quantite;
             $this->stock->updateStock($id_produit,$stock_disponible,$transaction);
            }
            // if($type_mouvement=="SORTIE"){
            //  $stockBd=$this->stock->readStock($id_produit,$transaction);
            //  $stock_disponible=$stockBd->stock_disponible-$quantite;
            //  $this->stock->updateStock($id_produit,$stock_disponible,$transaction); 
            // }
    }
}
?>