<?php
class Categorie{
    private $table_name;
    private $table_id;
    private $bd;
    
    public function __construct($bd){
        $this->table_name="categorie";
        $this->table_id="id_categorie";
        $this->bd=$bd;
    } 

    public function insertDatasCategorie($nom,$pdo=null){
        $sql="insert into $this->table_name set nom=?";
        $params=array($nom);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
        $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    public function readCategorie($id,$pdo=null){
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