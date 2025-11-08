<?php
session_start();
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
                    if($emails->email==$email){
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
        $password_hash= password_hash($password,PASSWORD_DEFAULT);
       $status=$_POST["status"];
       $zone_livraison_livreur=$_POST["zone_livraison_livreur"];
       $disponibilite= $_POST["disponibilite"];
      //  var_dump($_POST["role"]);
      //  die();
      //  $role est un tableau qui va representer les cases tchéqués
       if(sizeof($_POST["role"])<1){
         $_SESSION["message"]="Creation d'utilisateur impossible car vous n'avez choisis aucun rôle";
         header("Location:../index.php?active=alert_danger");
         exit;
       };
       $role=$_POST["role"];
       $emailExist=false;
       $allEmails=$user->readAllEmailUsers();
        if(sizeof($allEmails)>0){
        foreach($allEmails as $emails){
            if($emails->email==$email){
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
          if(sizeof($role)==1){
            $roleUser->insertDatasRoleUser($last_id,(int)$role[0],$transaction);
          }else{
            foreach($role as $role_user){
               $roleUser->insertDatasRoleUser($last_id,(int)$role_user,$transaction);
              }
          }
             
           $bd->commit($transaction);
        //  ici c'est la route du formulaire de creation côte backend
        $_SESSION["message"]="Utilisateur crée avec succés";
        header("Location:../index.php?ch=UTILISATEURS&active=alert_success");
        }else{
            //  ici c'est la route du formulaire de creation côte backend
            $_SESSION["message"]="Email déja existant impossible de créer l'utilisateur";
         header("Location:../index.php?active=alert_danger");
        }
      }catch(EXCEPTION $e){
        $bd->rollBack($transaction);
        echo "ERROR:".$e->getMessage();
      }  
     }
    }
    if($action=="connexion"){
     try{
            $email=$_POST["email"];
            $password=$_POST["password"]; 
            $allUser=$user->readAllUser1();
            // je suppose que l'email et le password n'existe pas à travers $existe_email_password
            $existe_email_password=false;
            if(sizeof($allUser)>0){
                // debut foreach
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
                        "email"=>$email,
                        "role"=>$role
                    );
                    $existe_email_password=true;
                    if(sizeof($role)==1){
                        if($role[0]->nom=="CLIENT"){
                        header ('Location: ../../pagePrincipaleFronted.php?chf=ACCUEIL');   
                        exit;
                        }
                              if($role[0]->nom=="LIVREUR"){
                            // route a changer
                        header ('Location: ../index.php?ch=LIVREUR');
                        exit;
                        }
                    }else{   
            // route a changer
                    header("location:../index.php?ch=CHOIX");
                    exit;
                   }
                 }
               }
                //fin foreach 
            }
        if($existe_email_password==false){
          $_SESSION["message"]="Informations incorrectes.Veuiller entré les bonnes informations!";
          header('Location: ../../connexion.php?active=alert_danger');
          exit;
        }
     }catch(EXCEPTION $e){      
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
    if($action=="disconnect"){
      unset($_SESSION["profil"]);
      unset($_SESSION["panier"]);
      unset($_SESSION["object-produit"]);
      unset($_SESSION["nbre_click"]);
      unset( $_SESSION["message-special"]);
      unset($_SESSION["total_produit"]);
      unset($_SESSION["message"]);
      header("Location:../../connexion.php");
    }

    // le if ci dessus c'est pour mettre a jour un utilisateur iniquement coté client 
    if($action=="updateUser"){
      $nom=$_POST["nom"];
      $email=$_POST["email"];
      $ancien_password=$_POST["ancien_password"];
      $new_password=password_hash($_POST["new_password"],PASSWORD_DEFAULT);
      try{
        $id_user=$_SESSION["profil"]["id_user"];
       $client = $user->readUser($id_user);
        
        if($client->email==$email){
          if(password_verify($ancien_password,$client->password)==true){
             $user->updateUser($id_user,$nom,$email,$new_password);
             $_SESSION["profil"]["email"]=$email;
            $_SESSION['message']="MODIFICATIONS ENREGISTREES AVEC SUCCESS";
             header ('Location: ../../pagePrincipaleFronted.php?chf=FORMUPDATE&active=alert_success');
             exit;
          }else{
             $_SESSION['message'] ="ANCIEN PASSWORD INCORRECT ET MODIFICATIONS NON ENREGISTREES";
            header("Location:../../pagePrincipaleFronted.php?chf=FORMUPDATE&active=alert_danger");
            exit;
          }
        }else{
         $allEmails=$user->readAllEmailUsers();
        $emailExist=false;
        foreach($allEmails as $mail ){
          if($mail->email==$email){
            $emailExist=true;
          }
        }
        if($emailExist==true){
           $_SESSION['message']= "ADDRESSE E-MAIL DEJA EXISTANT ET MODIFICATIONS NON ENREGISTREES";
          header("Location:../../pagePrincipaleFronted.php?chf=FORMUPDATE&active=alert_danger");
          exit;
        }else{
          if(password_verify($ancien_password,$client->password)==true){
             $user->updateUser($id_user,$nom,$email,$new_password);
             $_SESSION["profil"]["email"]=$email;
              $_SESSION['message']="MODIFICATIONS ENREGISTREES AVEC SUCCESS";
             header("location:../../pagePrincipaleFronted.php?chf=FORMUPDATE&active=alert_success");
             exit;
          }else{
             $_SESSION['message']="ANCIEN PASSWORD INCORRECT ET MODIFICATIONS ENREGISTREES.";
            header("Location:../../pagePrincipaleFronted.php?chf=FORMUPDATE&active=alert_danger");
            exit;
          }
        }
        }    
      }catch(EXCEPTION $e){
        echo "ERROR: ".$e->getMessage();
      }
    }
    if($action=="readUser"){
     header ("content-Type:application/json");
      try {
        if(isset($_GET["profil"])==false){
          throw new EXCEPTION ("id_user_inconnue pour la mise a jour du profil");
        }
       $id_user=$_SESSION["profil"]["id_user"];
        $data = $user->readUser($id_user);
        http_response_code(200);
        echo  json_encode($data);
      } catch (EXCEPTION $e) {
        http_response_code(500);
        echo json_encode(array(
            'message' => "ERROR REQUEST:".$e->getMessage())
        );
      }
      
    }
}
?>    