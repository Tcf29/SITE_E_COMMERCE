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