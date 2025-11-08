<div class="container mb-3 py-5" style="min-height:52.8vh !important">
    <form action="ADMIN/CONTROLLER/commandeController.php?action=finaliserCommande" method="POST" class="w-100 mx-auto ps-4 py-3 text-dark bg-light rounded-2">
    <div class="row w-100">
         <div class="col-md-6 py-4">
             <label for="nom" class="form-label" >NOM</label>
             <input type="text" id="nom" name="nom" placeholder="Votre nom" class="form-control" required>
        </div>
        <div class="col-md-6 py-4">
               <label for="email" class="form-label">EMAIL</label>
             <input type="email" id="email" name="email" placeholder="votre adresse email" class="form-control" required> 
         </div>
    </div>
    <div class="row w-100">
        <div class="col-md-6 py-4">
             <label for="telephone" class="form-label">NUMERO DE TELEPHONE</label>
             <input type="tel" id="telephone" name="telephone" placeholder="Votre numéro de télephone" class="form-control" required>
        </div>
      <div class="col-md-6 py-4">
             <label for="zone_livraison" class="form-label">ZONE DE LIVRAISON</label>
            <select name="zone_livraison" id="zone_livraison" class="form-select" required >
                <option selected value="">Choisir une zone</option> 
                <option value="DOUALA">DOUALA</option>
                <option value="YAOUNDE">YAOUNDE</option>
                <option value="DSCHANG">DSCHANG</option>
                <option value="BAMENDA">BAMENDA</option>
                <option value="AUTRES VILLES">AUTRES VILLES</option>
           </select>    
      </div>
 </div>
  <div class="row w-100">
        <div class="col-md-6 py-4">
            <label for="adresse_livraison_commande" class="form-label">ADRESSE DE LIVRAISON</label>
            <input type="text" id="adresse_livraison_commande" name="adresse_livraison_commande" placeholder="EX:Logpom entree face bille" class="form-control" required> 
        </div>
        <div class="col-md-6 py-4">
        <label for="frais_livraison" class="form-label">FRAIS LIVRAISON</label>
        <input type="text" id="frais_livraison" name="frais_livraison" class="form-control" value="2500FCFA" readonly> 
        </div>     
    </div>
    <div class="row w-100 pb-0">
         <label for="total_commande" class="form-label">PRIX TOTAL DE LA COMMANDE</label>
        <input type="text" id="total_commande" name="total_commande" class="form-control fs-4 text-danger" value="<?php echo ($_SESSION["total_commande"] + 2500); ?>FCFA" readonly> 
    </div>     
    <div class="row text-center mx-auto pt-5" style="opacity:1 !important;">
        <button class="btn btn-success w-50 mx-auto fw-1 text-white fs-5">Finaliser la commande</button>
    </div>
 </form>

</div>