<?php
class Database{
    // this permet d'acceder a une propriete ou attribut d'une classe.sans this tu ne peux avoir acces à la valeur d'un 
    // attribut d'une classe et par consequent si tu fais private $dsn=valeur; c'est faux parce que seul this va permettre 
    // d'acceder a une propriete d'une classe et par consequent permettre sa modification ce qui est : $this->dsn=valeur;
    private $dsn;
    private $user_name;
    private $password;
    private $dbname;
    private $pdo;
    public function __construct(){
       $this->dsn="localhost";
       $this->user_name="root";
       $this->password="";
       $this->dbname="ecommerce";
    }
    public function connexionBd(){
       try{
        if(is_null($this->pdo)){
            $this->pdo=new PDO("mysql:host=$this->dsn;dbname=$this->dbname;charset=utf8",$this->user_name,$this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        }
       }catch(EXCEPTION $e){
         echo "ERROR:$e->getMessage()";
       }
       return $this->pdo; 
    }

    public function deconnexionBd($pdo){
            $pdo=null;
    }
    public function saveBd($sql,$params,$transaction=null){

        if($transaction==null){
        $request=$this->connexionBd();
        $result=$request->prepare($sql);
          
        if($params==null){
            $result->execute();
        }else{
            $result->execute($params);
        }
        $this->deconnexionBd($request);
      return $result;
        }else{
            $request=$transaction;
            $result=$request->prepare($sql);
        if($params==null){
            $result->execute();
        }else{
            $result->execute($params);
        }
          return $result;
        }      
    }

    public function getDatas($save,$one=true){
        $datas=null;
        if($one==true){
            $datas=$save->fetch();
        }else{
            $datas=$save->fetchAll();
        } 
        return $datas;
    }
    public function beginTransaction(){
        $transaction=$this->connexionBd();
        $transaction->beginTransaction();
        return $transaction;
    }
    public function commit($transaction){
    $transaction->commit();
    $this->deconnexionBd($transaction);
    }

    public function rollBack($transaction){
        $transaction->rollBack();
        $this->deconnexionBd($transaction);
    }
    public function getLastId($pdo){
   $last_id=$pdo->lastInsertId();
   return $last_id;
    }
}
?>