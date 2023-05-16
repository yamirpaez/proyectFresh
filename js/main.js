


// sidebar toggle

function setSameSiteCookie(name, value, days) {
  let cookieString = name + "=" + value + "; SameSite=Lax; ";
  let expirationDate = new Date(Date.now() + (days * 24 * 60 * 60 * 1000));
  cookieString += "expires=" + expirationDate.toUTCString() + ";";
  document.cookie = cookieString;
}
setSameSiteCookie("miCookie", "miValor", 30);
const btnToggle = document.querySelector('.toggle-btn');

btnToggle.addEventListener('click', function () {
  console.log('click')
  document.getElementById('sidebar').classList.toggle('active');
  console.log(document.getElementById('sidebar'))
});

function addProducto(id, token) {
  let url='../clases/carrito.php';
let formData = new FormData()
  formData.append('id',id) 
   formData.append('token',token) 
 
   fetch(url, {
     method:'POST',
     body: formData,
     mode: 'cors'
   }).then(response=>response.json())
   .then(data=>{
     if(data.ok){
       let elemento=document.getElementById("num_cart")
       elemento.innerHTML=data.numero
 
     }
   })
  }

let eliminarModal=document.getElementById('eliminarModal');
if(eliminarModal !==null){

  eliminarModal.addEventListener('show.bs.modal', function(event){
    let button =event.relatedTarget
    let id=button.getAttribute('data-bs-id')
    let buttonElimina =eliminarModal.querySelector('.modal-footer #btn-elimina')
    buttonElimina.value=id
    })
}



 function actualizarCantidad(cantidad, id) {
  let url='clases/actualizar_Carrito.php';
  let formData = new FormData()
  formData.append('action','agregar') 
  formData.append('id',id) 
  formData.append('cantidad',cantidad) 

  fetch(url, {
    method:'POST',
    body: formData,
    mode: 'cors'
  }).then(response=>response.json())
  .then(data => {
    if(data.ok){

      let divsubtotal = document.getElementById('subtotal_'+ id)
      divsubtotal.innerHTML = data.sub

         let total=0.00;
         let list =document.getElementsByName('subtotal[]')

         for(let i=0;i<list.length;i++){
            total+= parseFloat(list[i].innerHTML.replace(/[$,]/g,''))
           

         }
         total=new Intl.NumberFormat('en-US',{
          minimumFractionDigits:2

         }).format(total)
         document.getElementById('total').innerHTML= '<?php echo MONEDA; ?>' +total
  
    }
  })
 }


 function eliminar() {

  let botonElimina=document.getElementById('btn-elimina')
  let id= botonElimina.value

  let url='clases/actualizar_Carrito.php';
  let formData = new FormData()
  formData.append('action','eliminar') 
  formData.append('id',id) 

  fetch(url, {
    method:'POST',
    body: formData,
    mode: 'cors'
  }).then(response=>response.json())
  .then(data => {
    if(data.ok){
         location.reload() 
    
    }
  })
 }


 