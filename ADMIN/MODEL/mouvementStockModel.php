<?php
class Mouvementstock{
    private $table_name;
    private $table_id;
    private $bd;
    
    public function __construct($bd){
        $this->table_name="mouvement_stock";
        $this->table_id=" id_mouvement_stock";
        $this->bd=$bd;
    } 

    public function insertDatasMouvement($id_produit,$type_mouvement,$quantite,$pdo=null){
        $sql="insert into $this->table_name set id_produit=?,type_mouvement=?,quantite=?";
        $params=array($id_produit,$type_mouvement,$quantite);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
        $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    // public function read($id,$pdo=null){
    //     $sql="select role.nom from $this->table_name inner join role on $this->table_name.id_role = role.id_role where $this->table_name.id_user=?";  
    //     $params=array($id);
    //       if($pdo==null){
    //       $saveBd=$this->bd->saveBd($sql,$params);   
    //     }else{
    //     $saveBd=$this->bd->saveBd($sql,$params,$pdo);
    //     }
    //    $datas=$this->bd->getDatas($saveBd,false);
    //    return $datas;
    // }
}
?>