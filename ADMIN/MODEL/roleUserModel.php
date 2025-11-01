<?php
class Roleuser{
    private $table_name;
    private $table_id;
    private $bd;
    
    public function __construct($bd){
        $this->table_name="role_user";
        $this->table_id="id_role_user";
        $this->bd=$bd;
    } 

    public function insertDatasRoleUser($id_user,$id_role,$pdo=null){
        $sql="insert into $this->table_name set id_user=?,id_role=?";
        $params=array($id_user,$id_role);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
        $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    public function readRoleUser($id,$pdo=null){
        $sql="select role.nom from $this->table_name inner join role on $this->table_name.id_role = role.id_role where $this->table_name.id_user=?";  
        $params=array($id);
          if($pdo==null){
          $saveBd=$this->bd->saveBd($sql,$params);   
        }else{
        $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
       $datas=$this->bd->getDatas($saveBd,false);
       return $datas;
    }

}
?>