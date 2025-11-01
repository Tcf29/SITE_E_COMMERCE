<?php
require_once "../MODEL/dataBase.php";
require_once "../MODEL/userModel.php";
require_once "../MODEL/roleUserModel.php";
require_once "../MODEL/produitModel.php";
require_once "../MODEL/categorieModel.php";
require_once "../MODEL/mouvementStockModel.php";
require_once "../MODEL/stockModel.php";
require_once "../MODEL/commandeModel.php";
require_once "../MODEL/detail_produit_commandeModel.php";
require_once "../MODEL/paiementModel.php";
$bd=new Database();
$user=new Usersdb($bd);
$roleUser=new Roleuser($bd);
$produit=new Produit($bd);
$categorie=new($bd);
$mouvementStock=new Mouvementstock($bd);
$stock=new Stock($bd);
$commande=new Commande($bd);
$detailProduitCommande=new Detailproduitcommande($bd);
$paiement=new Paiement($bd);
?>