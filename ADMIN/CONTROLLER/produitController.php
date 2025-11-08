<?php
session_start();
require_once "../SERVICES/service.php";
if(isset($_GET['action'])){
    $action=$_GET['action'];
    if($action=="create_produit"){
    try {
        /* formulaire de creation de produit*/ 

        $nom=$_POST["nom"];
        $prix_produit=$_POST["prix_produit"];
        $status=$_POST["status"];
        $quantite=$_POST["quantite"];
        $type_mouvement=$_POST["type_mouvement"];
        $categorie=$_POST["categorie"];
        if($categorie==1){
        $id_sous_categorie=(int)$_POST["sous_categorie1"];
        }
        if($categorie==2){
        $id_sous_categorie=(int)$_POST["sous_categorie2"];
        }
         if($categorie==3){
        $id_sous_categorie=(int)$_POST["sous_categorie3"];
        }
         if($categorie==4){
        $id_sous_categorie=(int)$_POST["sous_categorie4"];
        }
       
        $photo=$_FILES["photo"];
        $extension=pathinfo( $photo["name"],PATHINFO_EXTENSION);
        $img_renom= $pack1->renameFile($extension);
        $pack1->uploadedFile($img_renom,$photo["tmp_name"]);  
        $photo=$img_renom;
        /*informations formulaires */ 
        /*implementation de la logique metier par exemple un produit ne peut appartenir que à un seul categorie*/
            $transaction=$bd->beginTransaction();
            $produit->insertDatasProduit($id_sous_categorie,$nom,$prix_produit,$photo,$status,$transaction);
            $last_id=$bd->getLastId($transaction);
            if($type_mouvement=="ENTREE"){
                $stock->insertDatasStock($last_id,$quantite,$transaction); 
                $mouvementStock->insertDatasMouvement($last_id,$type_mouvement,$quantite,$transaction);
            }
            $bd->commit($transaction);

            header ("Location:../index.php?ch=PRODUITS");
    } catch (EXCEPTION $e) {
            $pack1->deleteFile("../FILES/$photo");
            $bd->rollBack($transaction);
             echo "ERROR".$e->getMessage();
    }     
    }
     if($action=="readAllProduit"){
      header ("content-Type:application/json");
      try {
        $data = $produit->readAllProduit();
        http_response_code(200);
        echo  json_encode($data);
      } catch (EXCEPTION $e) {
        http_response_code(500);
        echo json_encode(array(
            'message' => "ERROR REQUEST:".$e->getMessage())
        );
      } 

    }
    if($action=="actived"){
        try {
         $id_produit=(int)$_GET["id_produit"];
        //  var_dump($id_produit);
        //  echo "$id_produit";
        //  die("merci");
         $produit->activeProduit($id_produit);
         $_SESSION["message"]="PRODUIT ACTIVE AVEC SUCCESS";
         header("Location:../index.php?ch=PRODUITS&active=alert_success");
        } catch (EXCEPTION $e) {
            echo "ERROR".$e->getMessage();
        }
    }
    if($action=="desactived"){
        try {
         $id_produit=(int)$_GET["id_produit"];
         $produit->disabledProduit($id_produit);
          $_SESSION["message"]="PRODUIT DESACTIVER AVEC SUCCESS";
         header("Location:../index.php?ch=PRODUITS&active=alert_danger");
        } catch (EXCEPTION $e) {
            echo "ERROR".$e->getMessage();
        }
    }
    if($action=="readAllProduitCategorie"){
        header ("content-Type:application/json");
      try {
        $id_categorie=$_GET["id_categorie"];
        $data = $produit->readAllProduitCategorie($id_categorie);
        http_response_code(200);
        echo  json_encode($data);
      } catch (EXCEPTION $e) {
        http_response_code(500);
        echo json_encode(array(
            'message' => "ERROR REQUEST:".$e->getMessage())
        );
      } 

    }

    if($action=="ajoutpanier"){
       try{
        if($_GET["recherche"]=="false"){
         $id_categorie=(int)$_GET["id_categorie"];
        }
          $id_produit=(int)$_POST["id_produit"];
          $quantite=(int)$_POST["quantite"];
         $reponse= $stock->verifyDisponibiliteStock((int)$id_produit,$quantite);
         $stock1=$stock->readStock((int)$id_produit);
          if($reponse==false){
        $_SESSION["message"]="Stock insuffisant pour cette quantité.La quantite disponible en stock est $stock1->stock_disponible.";
            if($_GET["recherche"]=="true"){
         header("Location:../../pagePrincipaleFronted.php?chf=RESEARCH&active=alert_danger");
         exit;
            }else{
         header("Location:../../pagePrincipaleFronted.php?chf=CATALOGUE$id_categorie&active=alert_danger");
         exit;
            }
           
          }

          if(!isset($_SESSION["panier"])){
            $_SESSION["panier"]=[];
            $_SESSION["nbre_click"]=0;
          }
        //   var_dump();
        //   die();
        //   1 partie
          if(isset($_SESSION["panier"]["$id_produit"])){
            $_SESSION["message"]="Ce produit a déja étè ajouter au panier!";
             if($_GET["recherche"]=="true"){
         header("Location:../../pagePrincipaleFronted.php?chf=RESEARCH&active=alert_danger");
         exit;
            }else{
         header("Location:../../pagePrincipaleFronted.php?chf=CATALOGUE$id_categorie&active=alert_danger");
         exit;
            }
        }else{
         $_SESSION["panier"]["$id_produit"]=array(
            "object"=>$_SESSION["object-produit"]["$id_produit"],
            "quantite"=>$quantite,
            "total-produit"=>($quantite*(int)($_SESSION["object-produit"]["$id_produit"])->prix_produit)
            );
             $_SESSION["nbre_click"] +=1;
        }
        if($_GET["recherche"]=="true"){
               header("Location:../../pagePrincipaleFronted.php?chf=RESEARCH");
        }else{
              header("Location:../../pagePrincipaleFronted.php?chf=CATALOGUE$id_categorie");
        }
       }catch(EXCEPTION $e){
         echo "ERROR:".$e->getMessage();
       }
    }


    if($action=="verifySession"){
        header("content-type:application/json");
       try{
        $exist=false;
         $id_produit=(int)$_GET["id_produit"];
         $object=json_decode(file_get_contents("php://input"));
        //  var_dump(json_encode($object));
        //  exit;
        //  die("merci");
         if(!isset($_SESSION["object-produit" ]["$id_produit"])){
          $_SESSION["object-produit"]["$id_produit"]=$object; 
          $exist=true; 
         }
         http_response_code(200);
         echo json_encode($exist);
       }catch(EXCEPTION $e){
        http_response_code(500);
        echo json_encode("ERROR:".$e->getMessage());
       }
        
        }
    if($action=="viderpanier"){
        unset($_SESSION["object-produit"]);
        unset($_SESSION["panier"]);
        unset($_SESSION["nbre_click"]);
        header("Location:../../pagePrincipaleFronted.php?chf=PANIER");
    }

    if($action=="research"){
        header ("content-Type:application/json");
      try {
        $query=$_GET["q"];
        $data = $produit->searchProduit($query);
        http_response_code(200);
        echo  json_encode($data);
      } catch (EXCEPTION $e) {
        http_response_code(500);
        echo json_encode(array(
            'message' => "ERROR REQUEST:".$e->getMessage())
        );
      } 

    }
}







// $_SESSION["panier"]["$id_produit"]["quantite"]+=$quantite;
            // $_SESSION["panier"]["$id_produit"]["total-produit"]+=((int)$quantite*(int)($_SESSION["panier"]["$id_produit"]["object"])->prix_produit);
            

        //     var_dump($_SESSION["object-produit"]);
        //   die(); :uuid 30fb65c6-62e6-41d2-805b-4a10d8e99c9c
        //   api key:2e1dbda574af4cd5bbc264e4885a6624
       //subcription key:5855e688949a44f2ba7d48d1596cf5cf
        //encoded: MzBmYjY1YzYtNjJlNi00MWQyLTgwNWItNGExMGQ4ZTk5YzljOjJlMWRiZGE1NzRhZjRjZDViYmMyNjRlNDg4NWE2NjI0IA==
          

//  if($action=="update_stock_cote_admin"){
//        try{
//              $nom=$_GET["id_produit"];
//              $type_mouvement=$_GET["type_mouvement"];
//              $quantite=$_GET["quantite"];
//              $transaction=$bd->beginTransaction();
//               if(($type_mouvement=="ENTREE")||($type_mouvement=="RETOUR")){
//              $stockBd=$stock->readStock($id_produit,$transaction);
//              $stock_disponible=$stockBd->stock_disponible + $quantite;
//              $this->stock->updateStock($id_produit,$stock_disponible,$transaction);
//             }
//             // if($type_mouvement=="SORTIE"){
//             //  $stockBd=$this->stock->readStock($id_produit,$transaction);
//             //  $stock_disponible=$stockBd->stock_disponible-$quantite;
//             //  $this->stock->updateStock($id_produit,$stock_disponible,$transaction); 
//             // }

//        }catch(EXCEPTION $e){
//           echo "ERROR".$e->getMessage();
//           $bd->rollBack($transaction);  
//        }
//     }
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
   
?>