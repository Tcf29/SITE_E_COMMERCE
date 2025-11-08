    <div class="container py-5">
        <form action="CONTROLLER/produitController.php?action=create_produit" method="POST" class="form-control p-3" enctype="multipart/form-data">
         <div class="row">
            <div class="col-md-6 py-4">
             <label for="nom" class="form-label">NOM</label>
             <input type="text" id="nom" name="nom" placeholder="Entrer le nom du produit" class="form-control" required>
            </div>
            <div class="col-md-6 py-3">
               <label for="prix_produit" class="form-label">PRIX_PRODUIT</label>
             <input type="number"  min="500" id="prix_produit" name="prix_produit" placeholder="Entrer le prix du produit" class="form-control" required> 
            </div>
            <div class="col-md-6 py-3">
                <label for="quantite" class="form-label">QUANTITE</label>
             <input type="number" min="1" id="quantite" name="quantite" placeholder="Entrer la quantite du produit" class="form-control" required>
            </div>

            <div class="col-md-6 py-3">
             <label for="type_mouvement" class="form-label">TYPE_MOUVEMENT</label>
              <!-- <select name="type_mouvement" id="type_mouvement" class="form-select">
                <option value="ENTREE">ENTREE</option>
               </select> -->
             <input type="text" id="type_mouvement" value="ENTREE" name="type_mouvement" readonly  class="form-control">
            </div>
            <div class="col-md-6 py-3">
                <label for="categorie" class="form-label">CATEGORIE</label>
             <select name="categorie" id="categorie" class="form-select" required onchange="getSelect()">
                <option value="1">INFORMATIQUE</option> 
                <option value="2">TELEPHONES ET ACCESSOIRES</option>
                <option value="3">TELEVISIONS ET AUDIO</option>
                <option value="4">ELECTROMENAGERS</option>
             </select>
            </div>
            
                <div class="col-md-6 py-1 my-2">
                  <label for="sous_categorie" class="form-label">SOUS CATEGORIE</label>
                  <div class="allselect">
                    <select name="sous_categorie1" id="sous_categorie" class="form-select sous_categorie1" required>
                <option value="1">LAPTOPS</option> 
                <option value="2">PERIPHERIQUES</option>
             </select>

                <select name="sous_categorie2" id="sous_categorie" class="form-select d-none sous_categorie2" required>
                <option value="3">SMARTPHONES</option> 
                <option value="4">ACCESSOIRES</option>
             </select>

             <select name="sous_categorie3" id="sous_categorie" class="form-select d-none sous_categorie3" required>
                <option value="5">TV LED</option> 
                <option value="6">AUDIO</option>
            </select>

            <select name="sous_categorie4" id="sous_categorie" class="form-select d-none sous_categorie4" required>
                <option value="7">REFRIGERATEURS</option> 
                <option value="8">VENTILLATEURS</option>
            </select>
                  </div>
            </div>
            <div class="col-md-6 py-3">
                <label for="status" class="form-label">STATUS</label>
             <select name="status" id="status" class="form-select" required>
                <option value="ACTIF">ACTIF</option>
                <option value="INACTIF">INACTIF</option>
             </select>  
            </div>
            <div class="col-md-6 pb-5 my-3">
                <label for="photo" class="form-label">Entrer l'image du produit</label>
                <input type="file" name="photo" id="photo" class="form-control imagep" onchange="getImage()" required>
            </div>
            <div class="col-md-12 imageb text-center pb-5"></div>
            <div class="col-sm-12  py-3 d-flex justify-content-evenly" >
                <button type="reset" class="btn btn-danger btn-lg text-center w-25 fs-6"><a href="index.php?ch=PRODUITS" class="nav-link">ANULLER</a></button>
               <button type="submit" class="btn  btn-success btn-lg text-center w-25 fs-6">ENVOYER</button>
            </div>
         </div>
        </form>

    </div>
    <script type="text/javascript">
function getImage(){
let image=document.querySelector(".imageb")
let img=document.querySelector(".imagep").files[0];
let url = URL.createObjectURL(img);
// image.setAttribute("src")=`<img src="${url}" alt=voiture class="w-50"`;
let img1=document.createElement("img");
    img1.src=url;
    img1.setAttribute('class',"w-50 img-fluid rounded-pill img-thumbnail pb-3");
    img1.setAttribute('style',"witdh=80px;height=80px;");
    image.appendChild(img1);
   URL.revokeObjectURL();
} 

function getSelect(){
let categorie=document.querySelector("#categorie");
let value=categorie.value;
let allselect=document.querySelector(".allselect").children;
let cat1=document.querySelector(".sous_categorie1");
let cat2=document.querySelector(".sous_categorie2");
let cat3=document.querySelector(".sous_categorie3");
let cat4=document.querySelector(".sous_categorie4");
    for(let element of allselect){
        element.classList.add("d-none");
    }
    if(value==1){
     cat1.classList.remove("d-none");
    }
    if(value==2){
    cat2.classList.remove("d-none"); 
    }
   if(value==3){
    cat3.classList.remove("d-none"); 
    } 
    if(value==4){
    cat4.classList.remove("d-none"); 
    }
}
</script>