<?php
class Paiement{
 private $table_name;
    private $table_id;
    private $bd;
    public function __construct($bd){
        $this->table_name="paiement";
        $this->table_id="id_paiement";
        $this->bd=$bd;
    } 

    public function insertDatasPaiement($id_commande,$mode_paiement,$status_paiement,$pdo=null){
        $sql="insert into $this->table_name set id_commande=?,mode_paiement=?,status_paiement=?";
        $params=array($id_commande,$mode_paiement,$status_paiement);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }
   
     // $pdo est un objet ou parametre qui permet de savoir si il y'a une transaction ou pas
    // si $pdo="" cela veut dire que il n'y a pas de transaction en cours
    public function readPaiement($id,$pdo=null){ 
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

    public function readAllPaiement($pdo=null){
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

    public function updatePaiement($id_paiement,$id_commande,$mode_paiement,$status_paiement,$pdo=null){
    $sql="update from $this->table_name set id_commande=?,mode_paiement=?,status_paiement=? where $this->table_id=?";
    $params=array($id_commande,$mode_paiement,$status_paiement);
    if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd);
       return $datas;
    }


}
?>