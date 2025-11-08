<?php
class Souscategorie{
    private $table_name;
    private $table_id;
    private $bd;
    
    public function __construct($bd){
        $this->table_name="sous_categorie";
        $this->table_id="id_sous_categorie";
        $this->bd=$bd;
    } 

    public function insertDatasSousCategorie($id_categorie,$nom,$pdo=null){
        $sql="insert into $this->table_name set id_categorie=?,nom=?";
        $params=array($id_categorie,$nom);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
        $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    public function readSousCategorie($id,$pdo=null){
        $sql="select * from $this->table_name";  
        $params=null;
          if($pdo==null){
          $saveBd=$this->bd->saveBd($sql,$params);   
        }else{
        $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
       $datas=$this->bd->getDatas($saveBd);
       return $datas;
    }

}
?>