<?php
require_once "../SERVICES/service.php";
if(isset($_GET["action"])){
    $action=$_GET["action"];
    if($action=="inscription"){
      $cote=$_GET["cote"];
    if($cote=="client"){
      try{
            $nom=$_POST["nom"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            $status="ACTIF";
            $zone_livraison_livreur="PAS CONCERNE";
            $disponibilite="PAS CONCERNE";
            $role=[1];
            $password_hash=password_hash($password,PASSWORD_DEFAULT);
            $allEmails=$user->readAllEmailUsers();
            $emailExist=false;
            if(sizeof($allEmails)>0){
                foreach($allEmails as $emails){
                    if($emails==$email){
                        $emailExist=true;
                    }
                }
            }
        
           if($emailExist==false){
           $transaction=$bd->beginTransaction();
           // etape1:insertion dans la table user        
            $user->insertDatasUser($nom,$email,$password_hash,$status,$zone_livraison_livreur,$disponibilite,$transaction);
          //  etape 2 recuperation de l'id de user
             $last_id=$bd->getLastId($transaction);
          // etape3 insertion dans la table role_user
              foreach($role as $role_user){
               $roleUser->insertDatasRoleUser($last_id,$role_user,$transaction);
              }
           $bd->commit($transaction);
        header("Location:../../inscription.php?active=alert_success");
        }else{
         header("Location:../../inscription.php?active=alert_danger");
        }
      }catch(EXCEPTION $e){
        $bd->rollBack($transaction);
        echo "ERROR:$e->getMessage()";
      }
       
    }
    if($cote=="admin"){
      try{
       $nom=$_POST["nom"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $password_hash=password_hash($password,PASSWORD_DEFAULT);
       $status=$_POST["status"];
       $zone_livraison_livreur=$_POST["zone_livraison_livreur"];
       $disponibilite= $_POST["disponibilite"];
      //  $role est un tableau qui va representer les cases tchéqués
       $role=$_POST["role"];
       $emailExist=false;
       $allEmails=$user->readAllEmailUsers();
        if(sizeof($allEmails)>0){
        foreach($allEmails as $emails){
            if($emails==$email){
                $emailExist=true;
            }
        }
        }
         if($emailExist==false){
           $transaction=$bd->beginTransaction();
           // etape1:insertion dans la table user        
            $user->insertDatasUser($nom,$email,$password_hash,$status,$zone_livraison_livreur,$disponibilite,$transaction);
          //  etape 2 recuperation de l'id de user
             $last_id=$bd->getLastId($transaction);
          // etape3 insertion dans la table role_user
              foreach($role as $role_user){
               $roleUser->insertDatasRoleUser($last_id,$role_user,$transaction);
              }
           $bd->commit($transaction);
        //  ici c'est la route du formulaire de creation côte backend
        header("Location:../index.php?active=alert_success");
        }else{
            //  ici c'est la route du formulaire de creation côte backend
         header("Location:../index.php?active=alert_danger");
        }
      }catch(EXCEPTION $e){
        $bd->rollBack($transaction);
        echo "ERROR:$e->getMessage()";
      }  
     }
    }
    if($action=="connexion"){
     try{
            $email=$_POST["email"];
            $password=$_POST["password"]; 
            $allUser=$user->readAllUser1();
            $existe_email_password=false;
            if(sizeof($allUser)>0){
                // debut froeach
            foreach($allUser as $use){
           if(($email==$use->email) && (password_verify($password,$use->password)==true)){
                    $nom=$use->nom;
                    $id=$use->id_user;
                    $email=$use->email;
                    // il ne faut pas oublier que $user est un objet de type Usersdb
                    $role=$roleUser->readRoleUser($id);  
                    // var_dump($role[0]->nom);
                    // die("merci");                 
                    $_SESSION["profil"]=array(
                        "nom"=>$nom,
                        "id_user"=>$id,
                        "role"=>$role
                    );
                    $existe_email_password=true;
                    if(sizeof($role)==1){
                        if($role[0]->nom=="CLIENT"){
                        header ('Location: ../../pagePrincipaleFronted.php');   
                        }
                                if($role->nom=="LIVREUR"){
                            // route a changer
                        header ('Location: ../index.php?ch=LIVREUR');
                        }
                    }else{   
            // route a changer
                    header("location:../index.php?ch=CHOIX");
                   }
                 }
               }
                //fin foreach 
            }
        if($existe_email_password==false){
           throw new EXCEPTION(); 
        }
     }catch(EXCEPTION $e){
         header('Location: ../../connexion.php?active=alert_danger');  
        echo "ERROR: $e->getMessage()";
       }
    }
    if($action=="readAllusers"){
        header ("content-Type:application/json");
      try {
        $data = $user->readAllUsers();
        http_response_code(200);
        echo  json_encode($data);
      } catch (EXCEPTION $e) {
        http_response_code(500);
        echo json_encode(array(
            'message' => "ERROR REQUEST:".$e->getCode())
        );
      }
    } 
}
//  $user->createUser($nom,$email,$password_hash,$status,$zone_livraison_livreur,$disponibilite,$role);
?>    