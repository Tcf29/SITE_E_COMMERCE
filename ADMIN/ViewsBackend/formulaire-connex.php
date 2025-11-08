<div class="form-container form-container-user">
    <h4 class="form-title">Formulaire creation  Utilisateur</h4>
    <form action="CONTROLLER/userController.php?action=inscription&cote=admin" method="POST">
      <!-- Ligne 1 -->
      <div class="row g-3">
        <div class="col-md-6">
          <label for="nomUser" class="form-label">Nom utilisateur</label>
          <input type="text" name="nom" class="form-control" id="nomUser" placeholder="Entrez le nom d'utilisateur" required>
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="exemple@mail.com" required>
        </div>
      </div>

      <!-- Ligne 2 -->
      <div class="row g-3 mt-2">
        <div class="col-md-6">
          <label for="password" class="form-label">Mot de passe</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="" required>
        </div>
        <div class="col-md-6">
          <label for="zoneLivraison" class="form-label">Zone de livraison</label>
          <input type="text" name="zone_livraison_livreur" class="form-control" id="zoneLivraison" placeholder="Entrez la zone" required>
        </div>
      </div>

      <!-- Rôle (Checkboxes) -->
      <div class="mt-3">
        <label class="form-label d-block">Rôle utilisateur :</label>
           <div class="form-check form-check-inline">
          <input class="form-check-input"  type="checkbox" id="client" name="role[]" value="1">
          <label class="form-check-label" for="client">Client</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox"  id="livreur" name="role[]" value="2">
          <label class="form-check-label" for="livreur">Livreur</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox"  id="admin" name="role[]" value="3">
          <label class="form-check-label" for="admin">Administrateur</label>
        </div>
      </div>

      <!-- Sélecteurs -->
      <div class="row g-3 mt-3">
        <div class="col-md-6">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" required name="status">
            <option value="ACTIF">ACTIF</option>
            <option value="INACTIF">INACTIF</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="disponibilite" class="form-label">Disponibilité</label>
          <select class="form-select" id="disponibilite" name="disponibilite" required>
            <option value="PAS CONCERNE">Pas concerné</option>
            <option value="DISPONIBLE">Disponible</option>
            <option value="EN ATTENTE">En attente</option>
            <option value="INDISPONIBLE">Indisponible</option>
          </select>
        </div>
      </div>

      <!-- Boutons -->
      <div class="d-flex justify-content-between mt-4">
        <button type="reset" class="btn btn-secondary"><a href="index.php?ch=UTILISATEURS" class="nav-link">Annuler</a></button>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
    </form>
  </div>

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>