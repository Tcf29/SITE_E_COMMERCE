<?php
class Stock{
    private $table_name;
    private $table_id;
    private $bd;
    
    public function __construct($bd){
        $this->table_name="stock";
        $this->table_id="id_stock";
        $this->bd=$bd;
    } 

    public function insertDatasStock($id_produit,$stock_disponible,$pdo=null){
        $sql="insert into $this->table_name set id_produit=?,stock_disponible=?";
        $params=array($id_produit,$stock_disponible);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
        $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    public function readStock($id,$pdo=null){
        $sql="select stock_disponible from $this->table_name where id_produit=?";  
        $params=array($id);
          if($pdo==null){
          $saveBd=$this->bd->saveBd($sql,$params);   
        }else{
        $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
       $datas=$this->bd->getDatas($saveBd);
       return $datas;
       
    }
    public function updateStock($id_produit,$stock_disponible,$pdo=null){
        $sql="update from $this->table_name set stock_disponible=? where $this->table_id=?";
        $params=array($stock_disponible,$id_produit);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
        $this->bd->saveBd($sql,$params,$pdo);
        }
    }
   
       public function readAllStock($pdo=null){
        $sql="select S.stock_disponible,P.id_user,P.photo,P.status from $this->table_name as S join produit as P ON S.id_produit=P.id_produit";
        $params=null;
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
        $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
        return $datas;
    }

     public function verifyDisponibiliteStock($id_produit,$quantite){
  $stockBd=$this->readStock($id_produit);
  $verify=false;
  if((int)$stockBd->stock_disponible >= $quantite){
    $verify=true;
  }
  return $verify;
    }

}
?>