<?php
// require_once 'dataBase.php';
class Roleuser{
    private $table_name;
    private $table_id;
    private $bd;
    
    public function __construct($bd){
        $this->table_name="role_user";
        $this->table_id="id_role_user";
        $this->bd=$bd;
    } 

    public function insertDatasRoleUser($id_user,$id_role,$pdo=""){
        $sql="insert into $this->table_name set id_user=?,id_role=?";
        $params=array($id_user,$id_role);
        if($pdo==""){
          $saveBd=$this->bd->saveBd($sql,$params,false);   
        }else{
        $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
     return $saveBd;
    }
    public function readRoleUser($id,$pdo=""){
        $sql="select role.nom from $this->table_name innerjoin role on $this->table_name.id_role=role.id  where $this->table_name.id_user=?";  
        $params=array($id);
          if($pdo==""){
          $saveBd=$this->bd->saveBd($sql,$params,false);   
        }else{
        $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
       $datas=$this->bd->getDatas($saveBd,true);
       return $datas;
    }

}
?>