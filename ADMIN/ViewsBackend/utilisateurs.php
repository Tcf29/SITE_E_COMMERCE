<?php
// phpinfo();
$request=curl_init("http://localhost/E_COMMERCE/ADMIN/CONTROLLER/userController.php?action=readAllusers");
curl_setopt($request,CURLOPT_RETURNTRANSFER,true);
$datas=curl_exec($request);
// var_dump($datas);
// die("merci");
$datas=json_decode($datas);
curl_close($request);
$all_users=$datas;
// var_dump($all_users);
// die("merci");
?>
    <div class="py-3 d-flex justify-content-between px-2 align-items-center">
        <h6 class="d-inline-block text-success">LISTES DES UTILISATEURS</h6>
        <button class="btn btn-outline-success  d-inline-block w-50"><a href="index.php?ch=FORMULAIRE_CREATION_USER" class="nav-link">Ajouter un utilisateur</a></button>
    </div>
<div class="table-responsive fs-sm-2">
     <table class="table table-striped fs-6">
        <thead>
            <tr>
            <th>NOM</th>
            <th>EMAIL</th>
            <th>ZONE</th>
            <th>DISPONIBILITE</th>
            <th>ROLE</th>
            <th>STATUS</th>
            <th>ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <?php if(sizeof($all_users)>0):
            foreach($all_users as $user):
          ?>
          <tr>
       <td><?=$user->nom?></td>
       <td><?=$user->email?></td>
       <td><?=$user->zone_livraison_livreur?></td>
       <td><?=$user->disponibilite?></td>
       <td><?=$user->nom_role?></td>
       <td><?=$user->status?></td>
       <td>
        <button class="btn btn-sm btn-outline-warning"><i class="fas fa-user-check text-dark"></i></button>
        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-user-slash text-dark"></i></button>
        <button class="btn btn-sm btn-outline-success"> <i class="fas fa-user-edit text-dark"></i></button>
       </td>
      </tr>
      <?php endforeach;?>
      <?php endif;?>      
        </tbody>
     </table>
</div>