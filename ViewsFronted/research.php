

<div class="container py-5" style="min-height:53vh !important">
   <div >
    <input type="search" class="form-control d-block  me-1 research-special" placeholder="Recherche par nom et prix" required>
   </div>

    <div class="d-flex mt-5 cards mb-3" id="results">
        
    </div>
</div>


<script>
let input=document.querySelector(".research-special");
let result=document.querySelector("#results")
input.addEventListener("keyup",async()=>{
let query=(input.value).trim();

if(query==""){
    
}else{
let request = await fetch("http://localhost/E_COMMERCE/ADMIN/CONTROLLER/produitController.php?action=research&q=" + encodeURIComponent(query));
 if(request.status==200){
            response= await request.json();
            result.innerHTML="";
            if(response.length>0){
 for(let element of response){
let verify = await fetch(`http://localhost/E_COMMERCE/ADMIN/CONTROLLER/produitController.php?action=verifySession&id_produit=${element.id_produit}`,{
        method: "POST",
        headers:{
            "content-type":"application/json"
        },
        body:JSON.stringify(element)
    }
     );
       if(verify.status==200){
              result.innerHTML+=`
                    <form class="card" method="POST" action="ADMIN/CONTROLLER/produitController.php?action=ajoutpanier&recherche=true">
                        <img src="ADMIN/FILES/${element.photo}" class="promo-img" alt="Promo 1">
                        <h5>${element.nom}</h5>
                    <input type="hidden" name="id_produit" value=`+element.id_produit+`>
                        <p class="new-price">`+element.prix_produit+`</p>
                        <label for="quantite"  class="form-label">Quantite</label>
                        <input type="number" name="quantite" min="1" max="100" class="form-control border border-1 border-primary" required placeholder="Entrer une quantite">
                        <button class="btn btn-primary">Ajouter au panier</button>
                    </form> `
       }
    }
}else{
     result.innerHTML=`<div class="text-center fs-5 py-3 w-75 mx-auto mb-3  border border-1 border-info rounded-4 my-auto">
                       <div class="text-dark text-center fw-2 mx-auto">Aucun produit ne correspond à votre recherche</div>
                      </div>
                     `
}
 }else{
    alert ("Désolé une errur s'est produite");
 }

}
});
</script>