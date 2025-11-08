<?php
class Package{
    public function __construct(){

    }
    public function renameFile($extension){
        //renommage de la photo venant du formulaire
        $new_img = "KJLS"."_".date("ymd_his").".".$extension;
        $new_img =htmlspecialchars($new_img);  
        return $new_img;  
    }
   
    public function uploadedFile( $new_img,$tmp_name){
    $path="../FILES/".$new_img;
        $reponse=move_uploaded_file($tmp_name,$path);
        return $reponse;
    }   
    
    public function deleteFile($chemin){
        $boolean=unlink($chemin);
        return $boolean;
    }
}

?>