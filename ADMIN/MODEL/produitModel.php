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

    public function insertDatasProduit($id_categorie,$nom,$description,$prix_produit,$photo,$status,$pdo=null){
        $sql="insert into $this->table_name set id_categorie,=?nom,=?description,=?prix_produit,=?photo,=?status=?";
        $params=array($id_categorie,$nom,$description,$prix_produit,$photo,$status);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    public function disabledProduit($id_produit ,$status="INACTIF",$pdo=null){
        $sql="update from $this->table_name set status=? where $this->table_id=?";
        $params=array($status,$id_produit);
         if($pdo==null){
          $this->bd->saveBd($sql,$params,false);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }

    public function activeProduit($id_produit,$status="ACTIF",$pdo=null){
       $sql="update from $this->table_name set status=? where $this->table_id=?";
        $params=array($status,$user_id);
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

    public function updateProduit($id_produit,$id_categorie,$nom,$description,$prix_produit,$photo,$status,$pdo=null){
    $sql="update from $this->table_name set id_categorie=?,nom=?,description=?,prix_produit=?,photo=?,status=? where $this->table_id=?";
    $params=array($id_categorie,$nom,$description,$prix_produit,$photo,$status,$id_produit);
    if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd);
       return $datas;
    }
    public function updateStockProduit($id_produit,$type_mouvement,$quantite){
        try {
            $transaction=$this->bd->beginTransaction();
            try {
            $this->mouvement->insertDatasMouvement($id_produit,$type_mouvement,$quantite,$transaction);
            } catch (EXCEPTION $e) {
             echo "ERROR".$e->getMessage();
             $this->bd->rollBack($transaction);
            }
            try{
            }catch(EXCEPTION $e){
            echo "ERROR".$e->getMessage();
           $this->bd->rollBack($transaction);  
            }
            
        } catch (EXCEPTION $e) {
           echo "ERROR".$e->getMessage();
           $this->bd->rollBack($transaction);  
        }
    }
  public function verifyDisponibiliteProduit($id_produit,$quantite){
  $stockBd=$this->stock->readStock($id_produit);
  $verify=false;
  if($stockBd->stock_disponible >=$quantite){
    $verify=true;
  }
  return $verify;
    }

}
?>