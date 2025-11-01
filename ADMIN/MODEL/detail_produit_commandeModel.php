<?php
class Detailproduitcommande{
 private $table_name;
    private $table_id;
    private $bd;
    public function __construct($bd){
        $this->table_name="detail_produit_commande";
        $this->table_id="id_detail_produit_commande";
        $this->bd=$bd;
    } 

    public function insertDatasDetailProduitCommande($id_commande,$id_produit,$quantite,$pdo=null){
        $sql="insert into $this->table_name set id_commande=?,id_produit=?,quantite=?";
        $params=array($id_commande,$id_produit,$quantite);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }
   
     // $pdo est un objet ou parametre qui permet de savoir si il y'a une transaction ou pas
    // si $pdo="" cela veut dire que il n'y a pas de transaction en cours
    public function readDetailProduitCommande($id,$pdo=null){ 
       $sql="select * from $this->table_name where $this->table_id=?";
        $params=array($id);
      if($pdo==null){
          $saveBd=$this->bd->saveBd($sql,$params);  
        }else{
          $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }  
        $datas=$this->bd->getDatas($saveBd);
       return $datas; 
    }

    public function readAllDetailProduitCommande($pdo=null){
        $sql="select * from $this->table_name";
        $params=null;
      if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params);   
        }else{
         $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;
    }

    // public function updateDetailProduitCommande($id_commande,$id_user,$prix_commande,$status,$pdo=null){
    // $sql="update from $this->table_name set id_user=?,nom=?,prix_commande=?,status=? where $this->table_id=?";
    // $params=array($id_user,$prix_commande,$status,$id_commande);
    // if($pdo==null){
    //     $saveBd=$this->bd->saveBd($sql,$params); 
    //     }else{
    //      $saveBd= $this->bd->saveBd($sql,$params,$pdo);
    //     }
    //     $datas=$this->bd->getDatas($saveBd);
    //    return $datas;
    // }


}
?>