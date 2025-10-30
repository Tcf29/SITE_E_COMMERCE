<?php
require_once "../SERVICES/service.php";
if(isset($_GET["action"])){
    $action=$_GET["action"];
    $cote=$_GET["cote"];
    if($action=="inscription"){
    if($cote=="client"){
        $nom=htmlspecialchars($_POST["nom"]);
        $email=htmlspecialchars($_POST["email"]);
        $password=htmlspecialchars($_POST["password"]);
        $status="ACTIF";
        $zone_livraison_livreur="PAS CONCERNE";
        $disponibilite="PAS CONCERNE";
        $role=array(1);
        $password_hash=password_hash($password,PASSWORD_DEFAULT);
        $user->createUser($name,$email,$password_hash,$status,$zone_livraison_livreur,$disponibilite,$role);

        header("Location:.././inscription.php?active=alert_success");
    }


    
    }
}
?>