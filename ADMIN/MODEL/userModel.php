<?php
class Usersdb{
    private $table_name;
    private $table_id;
    private $bd;
    public $role_user;
    
    public function __construct($bd){
        $this->table_name="user";
        $this->table_id="id_user";
        $this->bd=$bd;
    } 

    public function insertDatasUser($name,$email,$password,$status,$zone_livraison_livreur,$disponibilite,$pdo=null){
        $sql="insert into $this->table_name set nom=?,email=?,password=?,status=?,zone_livraison_livreur=?,disponibilite=?";
        $params=array($name,$email,$password,$status,$zone_livraison_livreur,$disponibilite);
        if($pdo==null){
          $this->bd->saveBd($sql,$params);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }
    public function disabledUser($user_id ,$status="INACTIF",$pdo=null){
        $sql="update from $this->table_name set status=? where $this->table_id=?";
        $params=array($status,$user_id);
         if($pdo==null){
          $this->bd->saveBd($sql,$params,false);   
        }else{
          $this->bd->saveBd($sql,$params,$pdo);
        }
    }

    public function activeUser($user_id,$status="ACTIF",$pdo=null){
       $sql="update from $this->table_name set status=? where $this->table_id=?";
        $params=array($status,$user_id);
         if($pdo==null){
          $this->bd->saveBd($sql,$params);  
        }else{
          $this->bd->saveBd($sql,$params,$pdo); 
        }
    }

      public function readUser($id,$pdo=null){
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
    // $pdo est un objet ou parametre qui permet de savoir si il y'a une transaction ou pas
    // si $pdo="" cela veut dire que il n'y a pas de transaction en cours
    public function readUser1($id,$pdo=null){ 
        $sql= "select U.*,R.nom from $this->table_name as U inner join role_user as RU on 
        U.id_user=RU.id_user inner join role as R on  RU.id_role=R.id_role where U.id_user=?";
        $params=array($id);
      if($pdo==null){
          $saveBd=$this->bd->saveBd($sql,$params);  
        }else{
          $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }  
        $datas=$this->bd->getDatas($saveBd);
       return $datas; 
    }

    public function readAllUsers($pdo=null){
//  $sql = "select U.*,group_concat(R.nom SEPARATOR "|") as nom_role from $this->table_name as U join role_user as RU on 
//         U.id_user = RU.id_user join role as R on  RU.id_role = R.id_role  group by U.id_user";
$sql="select  U.*, group_concat(R.nom separator '|') as nom_role  from $this->table_name as U join role_user as RU on 
        U.id_user = RU.id_user  join role as R on  RU.id_role = R.id_role
        GROUP by U.id_user DESC";
        $params=null;
      if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params);   
        }else{
         $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;
    }

    public function updateUser($id_user,$nom,$email,$password,$pdo=null){
      $sql="update $this->table_name set nom=?,email=?,password=? where $this->table_id=?";
      $params=array($nom,$email,$password,$id_user);
      if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd);
       return $datas;

    }
       
    public function UpdateUser1($id_user,$name,$email,$password,$zone_livraison_livreur,$disponibilite,$pdo=null){
    $sql="update from $this->table_name set nom=?,email=?,password=?,zone_livraison_livreur=?,disponibilite=?
        where $this->table_id=?";
    $params=array($name,$email,$password,$zone_livraison_livreur,$disponibilite,$id_user);
    if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd);
       return $datas;
    }
// debut inscription 
    public function readAllEmailUsers($pdo=null){
        $sql="select email from $this->table_name";
        $params=null;
       if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;  
    }
// fin inscription 
// debut connexion
public function readAllUser1($pdo=null){
     $sql="select * from $this->table_name";
        $params=null;
       if($pdo==null){
        $saveBd=$this->bd->saveBd($sql,$params); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;  
}
        
//fin connexion
   
//     public function updateUserReal($id_user,$name,$email,$password,$zone_livraison_livreur,$disponibilite,$role){

//         // je vais laisser le fait que on puisse desactiver un role;
    
//       try{
//         $transaction=$this->bd->beginTransaction();

//       $result=$this->role_user->readRoleUser($id_user,$name,$email,$password,$zone_livraison_livreur,$disponibilite,$transaction);
//       foreach($role as $role_user){
//           $i=0;
//         if(!in_array($role_user,$result->nom[i])){
//      $this->role_user->insertDatasRoleUser($last_id,$role_user,$transaction);
//         }     
//   }
//     $this->bd->commit($transaction);

//       }catch(EXCEPTION $e){
//    $this->bd->rollBack($transaction);
//    echo "ERROR:$e->getMesage()";
//       }
//     } 

   
}
?>

