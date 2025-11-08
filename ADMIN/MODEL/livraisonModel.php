<?php
class Livraison{
    private $table_name;
    private $table_id;
    private $bd;
    public $role_user;
    
    public function __construct($bd){
        $this->table_name="livraison";
        $this->table_id="id_livraison";
        $this->bd=$bd;
    } 

    public function insertDatasLivraison($id_user,$id_commande,$nom,$email,$telephone,$zone_livraison_commande,$adresse_livraison_commande,$frais_livraison,$status_livraison,$pdo=null){
        $sql="insert into $this->table_name set id_user=?,id_commande=?,nom=?,email=?,telephone=?,zone_livraison_commande=?,adresse_livraison_commande=?,frais_livraison=?,status_livraison=?";
        $params=array($id_user,$id_commande,$nom,$email,$telephone,$zone_livraison_commande,$adresse_livraison_commande,$frais_livraison,$status_livraison);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    // public function disabledUser($user_id ,$status="INACTIF",$pdo=null){
    //     $sql="update from $this->table_name set status=? where $this->table_id=?";
    //     $params=array($status,$user_id);
    //      if($pdo==null){
    //       $this->bd->saveBd($sql,$params,false);   
    //     }else{
    //       $this->bd->saveBd($sql,$params,$pdo);
    //     }
    // }

//     public function activeUser($user_id,$status="ACTIF",$pdo=null){
//        $sql="update from $this->table_name set status=? where $this->table_id=?";
//         $params=array($status,$user_id);
//          if($pdo==null){
//           $this->bd->saveBd($sql,$params);  
//         }else{
//           $this->bd->saveBd($sql,$params,$pdo); 
//         }
//     }

//       public function readUser($id,$pdo=null){
//         $sql="select * from $this->table_name where $this->table_id=?";
//         $params=array($id);
//         if($pdo==null){
//           $saveBd=$this->bd->saveBd($sql,$params);  
//         }else{
//           $saveBd=$this->bd->saveBd($sql,$params,$pdo);
//         }  
//         $datas=$this->bd->getDatas($saveBd);
//        return $datas;
//       }
//     // $pdo est un objet ou parametre qui permet de savoir si il y'a une transaction ou pas
//     // si $pdo="" cela veut dire que il n'y a pas de transaction en cours
//     public function readUser1($id,$pdo=null){ 
//         $sql= "select U.*,R.nom from $this->table_name as U inner join role_user as RU on 
//         U.id_user=RU.id_user inner join role as R on  RU.id_role=R.id_role where U.id_user=?";
//         $params=array($id);
//       if($pdo==null){
//           $saveBd=$this->bd->saveBd($sql,$params);  
//         }else{
//           $saveBd=$this->bd->saveBd($sql,$params,$pdo);
//         }  
//         $datas=$this->bd->getDatas($saveBd);
//        return $datas; 
//     }

//     public function readAllUsers($pdo=null){
// //  $sql = "select U.*,group_concat(R.nom SEPARATOR "|") as nom_role from $this->table_name as U join role_user as RU on 
// //         U.id_user = RU.id_user join role as R on  RU.id_role = R.id_role  group by U.id_user";
// $sql="select  U.*, group_concat(R.nom separator '|') as nom_role  from $this->table_name as U join role_user as RU on 
//         U.id_user = RU.id_user  join role as R on  RU.id_role = R.id_role
//         GROUP by U.id_user DESC";
//         $params=null;
//       if($pdo==null){
//         $saveBd=$this->bd->saveBd($sql,$params);   
//         }else{
//          $saveBd=$this->bd->saveBd($sql,$params,$pdo);
//         }
//         $datas=$this->bd->getDatas($saveBd,false);
//        return $datas;
//     }

//     public function updateUser($id_user,$nom,$email,$password,$pdo=null){
//       $sql="update $this->table_name set nom=?,email=?,password=? where $this->table_id=?";
//       $params=array($nom,$email,$password,$id_user);
//       if($pdo==null){
//         $saveBd=$this->bd->saveBd($sql,$params); 
//         }else{
//          $saveBd= $this->bd->saveBd($sql,$params,$pdo);
//         }
//         $datas=$this->bd->getDatas($saveBd);
//        return $datas;

//     }
}
?>