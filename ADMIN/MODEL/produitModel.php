<?php
class Produit{
    private $table_name;
    private $table_id;
    private $bd;
    public function __construct($bd){
        $this->table_name="produit";
        $this->table_id="id_produit";
        $this->bd=$bd;
    } 

    public function insertDatasProduit($id_sous_categorie,$nom,$prix_produit,$photo,$status,$pdo=null){
        $sql="insert into $this->table_name set id_sous_categorie=?,nom=?,prix_produit=?,photo=?,status=?";
        $params=array($id_sous_categorie,$nom,$prix_produit,$photo,$status);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    public function disabledProduit($id_produit ,$status='INACTIF',$pdo=null){
        $sql="Update $this->table_name set status=? where $this->table_id=?";
        $params=array($status,$id_produit);
         if($pdo==null){
          $this->bd->saveBd($sql,$params,false);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }

    public function activeProduit($id_produit,$status="ACTIF",$pdo=null){
       $sql="Update $this->table_name set status=? where $this->table_id =?";
        $params=array($status,$id_produit);
         if($pdo==null){
          $this->bd->saveBd($sql,$params);  
        }else{
          $this->bd->saveBd($sql,$params,$pdo); 
        }
    }
   
    // $pdo est un objet ou parametre qui permet de savoir si il y'a une transaction ou pas
    // si $pdo="" cela veut dire que il n'y a pas de transaction en cours
    public function readProduit($id,$pdo=null){ 
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
   

     
    public function readAllProduit($pdo=null){
$sql="select P.*,(SC.nom) as nom_sous_categorie,(C.nom) as nom_categorie from $this->table_name
    as P join sous_categorie as SC on P.id_sous_categorie=SC.id_sous_categorie 
      join categorie as C on SC.id_categorie=C.id_categorie order by id_produit DESC";
       $params=null;
      if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params);   
        }else{
         $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;
    }
       public function readAllProduitCategorie($id_categorie,$pdo=null){
          $sql="select P.*,(SC.nom) as nom_sous_categorie,(C.nom) as nom_categorie from $this->table_name
    as P join sous_categorie as SC on P.id_sous_categorie=SC.id_sous_categorie 
      join categorie as C on SC.id_categorie=C.id_categorie where C.id_categorie=? and P.status='ACTIF'";
       $params=array($id_categorie);
      if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params);   
        }else{
         $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;
      }
    public function updateProduit($id_produit,$id_sous_categorie,$nom,$prix_produit,$photo,$status,$pdo=null){
    $sql="update from $this->table_name set id_sous_categorie=?,nom=?,prix_produit=?,photo=?,status=? where $this->table_id=?";
    $params=array($id_sous_categorie,$nom,$prix_produit,$photo,$status,$id_produit);
    if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd);
       return $datas;
    }

      public function searchProduit($q,$status="ACTIF",$pdo=null){
        $sql="select * from produit where (nom LIKE ? OR prix_produit LIKE ?) and status=?";
        $params= array("%$q%","%$q%",$status);
        if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;
      }

    // public function updateStockProduit($id_produit,$type_mouvement,$quantite){
    //     try {
    //         $transaction=$this->bd->beginTransaction();
    //         try {
    //         $this->mouvement->insertDatasMouvement($id_produit,$type_mouvement,$quantite,$transaction);
    //         } catch (EXCEPTION $e) {
    //          echo "ERROR".$e->getMessage();
    //          $this->bd->rollBack($transaction);
    //         }
    //         try{
    //         }catch(EXCEPTION $e){
    //         echo "ERROR".$e->getMessage();
    //        $this->bd->rollBack($transaction);  
    //         }
            
    //     } catch (EXCEPTION $e) {
    //        echo "ERROR".$e->getMessage();
    //        $this->bd->rollBack($transaction);  
    //     }
    // }
}
?>