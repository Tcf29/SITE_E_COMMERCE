// BARRE DE NAVIGATION 
const liens=document.querySelectorAll("nav div ul li");
liens.forEach(lien=>
{
 lien.addEventListener("click",()=>
{
    liens.forEach(lien1=>{
      lien1.classList.remove("lien");
    })
    lien.classList.add("lien")
})
}
);
// FIN BARRE DE NA VIGATION

// MENU BURGER
const burger=document.querySelector(".fa-bars");
const menu=document.querySelector("nav .div2");
burger.addEventListener("click",()=>
{
   setTimeout(() => {
    burger.classList.toggle("transform");
     menu.classList.toggle("visible");
   }, 50);
})
// FIN MENU BURGER

// SESSION PROFIL
let profil=document.querySelector(".profil1");
let user=document.querySelector(".fa-user");
user.addEventListener("click",()=>
{
   profil.classList.toggle("d-none");
   user.classList.toggle("fa-user-color");
});

// let shopping=document.querySelector(".fa-shopping-cart");
// let research=document.querySelector(".fa-search");
// let table=[shopping,research];
// table.forEach(element=>{
//   element.addEventListener('over',()=>{
//     element.classList.toggle("fa-user-color-special");
//   })
// })
// FIN SESSION PROFIL
