<?php
session_start();
require_once "../SERVICES/service.php";
if(isset($_GET["action"])){
    $action=$_GET["action"];
if($action=="commander"){
    try{
    $i=1;
  foreach($_SESSION["panier"] as $product){
    $id_produit=(int)$product["object"]->id_produit;
    $quantite=$product["quantite"];
    $nom=$product["object"]->nom;
   $reponse= $stock->verifyDisponibiliteStock($id_produit,$quantite);
   $stock1=$stock->readStock($id_produit);
   if($reponse==false){
    $_SESSION["message-special"][]=array(
        "$i"=>"Stock indisponible pour<<$nom>>(disponible: $stock1->stock_disponible, demandé:$quantite",
    );
    $i+=1;
   }
}
if(isset($_SESSION["message-special"])){
    header("Location:../../pagePrincipaleFronted.php?active=alert_danger_special&chf=PANIER");
    exit;
}else{
    header("location:../../pagePrincipaleFronted.php?chf=INFOSLIVRAISON");
}
    }catch(EXCEPTION $e){
        echo "ERROR:".getMessage();
    }
}

 if( $action=="finaliserCommande"){
// on verifie d'arbord si le client est connecté
// si c'est le cas on recupére son panier via la session["panier"] crée lors  de l'ajout des produits au panier
// Avant de commencer à enregistrer sa commande on reverifie encore si les produits 
// que il a ajouté au panier sont disponibles 
//  si c'est le cas on crée une commande et on enregistre les produits choisis par le client
//  dans la table detail commande avec le statut de la commande qui passe en attente de paiement
// dans la table paiement on crée une commande pour ce client
try{
   if(!isset($_SESSION["profil"])){
    $_SESSION["message"]="Veuillez d'arbord vous connecter à votre compte";
    header("Location:../../connexion.php?active=alert_danger");
    exit;
   }
//    if(!isset($_SESSION["panier"])){
//     $_SESSION["message"]="Vous n'avez aucun panier en cours!Merci de bien vouloir créer un panier";
//     header("Location:")
//    }
//    infos necessaies pour enregistrer une commande en bd
   $id_user=(int)$_SESSION["profil"]["id_user"];
   $prix_commande=(int)$_POST["total_commande"];
   $status="EN ATTENTE DE PAIEMENT";
// fin infos necessaies pour enregistrer une commande en bd 
// infos necessaies pour enregistrer une livraison  en bd
 $nom=$_POST["nom"];
 $email=$_POST["email"];
 $telephone=$_POST["telephone"];
 $adresse_livraison_commande=$_POST["adresse_livraison_commande"];
 $zone_livraison=$_POST["zone_livraison"];
 $frais=(int)$_POST["frais_livraison"];
 $status_livraison="EN ATTENTE DE PAIEMENT";
 $status_paiement="EN ATTENTE DE PAIEMENT";
 $mode_paiement="NULL";
// fin infos necessaies pour enregistrer une livraison et un paiement en bd
   $transaction=$bd->beginTransaction();
   $commande->insertDatasCommande($id_user,$prix_commande,$status,$transaction);
   $last_id=$bd->getLastId($transaction);
   $id_user_livreur=NULL;
   $status_livraison="EN ATTENTE";

//  remplie la table detail produit commande
foreach($_SESSION["panier"] as $product){
    $id_produit=(int)$product["object"]->id_produit;
    $quantite=(int)$product["quantite"];
    $detailProduitCommande->insertDatasDetailProduitCommande($last_id,$id_produit,$quantite,$transaction);
}
// remplie la table paiement
$paiement->insertDatasPaiement($last_id,$mode_paiement,$status_paiement,$transaction);

//remplie la table paiement 
 $livre1->insertDatasLivraison($id_user_livreur,$last_id,$nom,$email,$telephone,$zone_livraison,$adresse_livraison_commande,$frais,$status_livraison,$transaction);
 $bd->commit($transaction);
 unset($_SESSION["panier"]);
 unset($_SESSION["nbre_click"]);
 unset($_SESSION["total_produit"]);
 $_SESSION["message"]="Votre commande à étè enregistrer avec succés!";
 header("Location:../../pagePrincipaleFronted.php?chf=ACCUEIL&active=alert_success");

}catch(EXCEPTION $e){
 $bd->rollBack($transaction);
 echo "ERROR:".$e->getMessage();
}
}
}
?>