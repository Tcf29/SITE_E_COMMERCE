<?php
class Commande{
 private $table_name;
    private $table_id;
    private $bd;
    public function __construct($bd){
        $this->table_name="commande";
        $this->table_id="id_commande";
        $this->bd=$bd;
    } 

    public function insertDatasCommande($id_user,$prix_commande,$status,$pdo=null){
        $sql="insert into $this->table_name set id_user=?,prix_commande=?,status=?";
        $params=array($id_user,$prix_commande,$status);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }
   
     // $pdo est un objet ou parametre qui permet de savoir si il y'a une transaction ou pas
    // si $pdo="" cela veut dire que il n'y a pas de transaction en cours
    public function readCommande($id,$pdo=null){ 
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

    public function readAllCommande($pdo=null){
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

    public function updateCommande($id_commande,$id_user,$prix_commande,$status,$pdo=null){
    $sql="update from $this->table_name set id_user=?,nom=?,prix_commande=?,status=? where $this->table_id=?";
    $params=array($id_user,$prix_commande,$status,$id_commande);
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