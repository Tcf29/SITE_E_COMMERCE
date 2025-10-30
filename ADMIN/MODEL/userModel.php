<?php
require_once 'dataBase.php';
require_once 'roleUserModel.php';
class Usersdb{
    private $table_name;
    private $table_id;
    private $bd;
    private $role_user;
    
    public function __construct(){
        $this->table_name=array("user","role_user","role");
        $this->table_id=array("id_user","id_role");
        $this->bd=new Database();
         $this->role_user=new Roleuser($this->bd);
    } 

    public function insertDatasUser($name,$email,$password,$status,$zone_livraison_livreur,$disponibilite,$pdo=""){
        $sql="insert into $this->table_name[0] set nom=?,email=?,password=?,status=?,zone_livraison_livreur=?,disponibilite=?";
        $params=array($name,$email,$password,$status,$zone_livraison_livreur,$disponibilite);
        if($pdo==""){
          $saveBd=$this->bd->saveBd($sql,$params,false);   
        }else{
          $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
        return $saveBd;
    }
    public function disabledUser($user_id ,$status="INACTIF",$pdo=""){
        $sql="update from $this->table_name[0] set status=? where $this->table_id[0]=?";
        $params=array($status,$user_id);
         if($pdo==""){
          $saveBd=$this->bd->saveBd($sql,$params,false);   
        }else{
          $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
     return $saveBd;
    }

    public function activeUser($user_id,$status="ACTIF",$pdo){
       $sql="update from $this->table_name[0] set status=? where $this->table_id[0]=?";
        $params=array($status,$user_id);
         if($pdo==""){
          $saveBd=$this->bd->saveBd($sql,$params,false);  
        }else{
          $saveBd=$this->bd->saveBd($sql,$params,$pdo); 
        }
       return $saveBd;
    }
    // $pdo est un objet ou parametre qui permet de savoir si il y'a une transaction ou pas
    // si $pdo="" cela veut dire que il n'y a pas de transaction en cours
    public function readUser($id,$pdo){ 
        $sql= "select U.*,R.nom from $this->table_name[0] as U inner join $this->table_name[1] as RU on 
        U.id_user=RU.id_user inner join $this->table_name[2] as R on  RU.id_role=R.id_role where U.id_user=?";
        $params=array($id);
      if($pdo==""){
          $saveBd=$this->bd->saveBd($sql,$params,false);  
        }else{
          $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }  
         $datas=$this->bd->getDatas($saveBd,true);
       return $datas; 
    }

    public function readAllUsers($pdo){
        $sql= "select U.*,R.nom from $this->table_name[0] as U inner join $this->table_name[1] as RU on 
        U.id_user=RU.id_user inner join $this->table_name[2] as R on  RU.id_role=R.id_role  ORDER BY U.id_user ";
        $params="";
      if($pdo==""){
        $saveBd=$this->bd->saveBd($sql,$params,false); 
        }else{
         $saveBd=$this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;
    }
    public function UpdateUser($id_user,$name,$email,$password,$zone_livraison_livreur,$disponibilite,$pdo=""){
    $sql="update from $this->table_name[0] set nom=?,email=?,password=?,zone_livraison_livreur=?,disponibilite=?
        where $this->table_id[0]=?";
    $params=array($name,$email,$password,$zone_livraison_livreur,$disponibilite,$id_user);
    if($pdo==""){
        $saveBd=$this->bd->saveBd($sql,$params,false); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,true);
       return $datas;
    }
// debut inscription 
    public function ReadAllEmailUsers($pdo=""){
        $sql="select email from $this->table_name[0]";
        $params="";
       if($pdo==""){
        $saveBd=$this->bd->saveBd($sql,$params,false); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;  
    }
// fin inscription 
// debut connexion
public function RealAllEmail_password($pdo=""){
     $sql="select email,password from $this->table_name[0]";
        $params="";
       if($pdo==""){
        $saveBd=$this->bd->saveBd($sql,$params,false); 
        }else{
         $saveBd= $this->bd->saveBd($sql,$params,$pdo);
        }
        $datas=$this->bd->getDatas($saveBd,false);
       return $datas;  
}

//fin connexion



    public function createUser($name,$email,$password,$status,$zone_livraison_livreur,$disponibilite,$role){
        try{
         $transaction=$this->bd->beginTransaction();
        // etape1:insertion dans la table user
 $this->insertDatasUser($name,$email,$password,$status,$zone_livraison_livreur,$disponibilite,$transaction);
//  etape 2 recuperation de l'id de user 
$last_id=$this->bd->getLastId($transaction);

// etape3 insertion dans la table role_user
   foreach($role as $role_user){
    $this->role_user->insertDatasRoleUser($last_id,$role_user,$transaction);
    }
    $this->bd->commit($transaction);
        }catch(EXCEPTION $e){
         $this->bd->rollBack($transaction);
         echo "ERROR:$e->getMessage()";
        }
    }

    public function updateUserReal($id_user,$name,$email,$password,$zone_livraison_livreur,$disponibilite,$role){

        // je vais laisser le fait que on puisse desactiver un role;
    
      try{
        $transaction=$this->bd->beginTransaction();

      $result=$this->role_user->readRoleUser($id_user,$name,$email,$password,$zone_livraison_livreur,$disponibilite,$transaction);
      foreach($role as $role_user){
          $i=0;
        if(!in_array($role_user,$result->nom[i])){
     $this->role_user->insertDatasRoleUser($last_id,$role_user,$transaction);
        }     
  }
    $this->bd->commit($transaction);

      }catch(EXCEPTION $e){
   $this->bd->rollBack($transaction);
   echo "ERROR:$e->getMesage()";
      }
    } 

   
}

     // public function readAllUsers(){
    //     $sql="select * from $this->table_name ORDER BY first_name DESC";
    //     $params=null;
    //     $datas=$this->BD->executionRequest($sql,$params);
    //     $datas= $this->BD->takeDatas($datas,false);
    //     return $datas;
    // }
?>

