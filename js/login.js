// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.13.0/firebase-app.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

import {
    getDatabase,
    onValue,
    ref,
    set,
    child,
    get,
    update,
    remove
  }
  from "https://www.gstatic.com/firebasejs/9.13.0/firebase-database.js";


  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyCVvKQl0t0u6d5fuXthxNr2PGjj0SrwkOA",
    authDomain: "finalweb-69f91.firebaseapp.com",
    databaseURL: "https://finalweb-69f91-default-rtdb.firebaseio.com",
    projectId: "finalweb-69f91",
    storageBucket: "finalweb-69f91.appspot.com",
    messagingSenderId: "215674283336",
    appId: "1:215674283336:web:29be335446e759a8afff7d"
  };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const db = getDatabase();

    var btnIngresar = document.getElementById('btnIngresar');
    var btnCrear = document.getElementById('btnCrear');

    //Insertar variables inputs
    var email = "";
    var contra = "";


    function leerInputs() {
    email = document.getElementById('loginemail').value;
    contra = document.getElementById('loginpassword').value;
    }

    
    //IniciarSesion
    function Autenticar() {
      leerInputs();
      const dbref = ref(db);
      get(child(dbref, 'Usuarios/' + email)).then((snapshot) => {
          if (snapshot.exists()) {
  
              if(contra == snapshot.val().Contraseña){
                  alert("Bienvenido")
                  window.location="/html/administrador.html";
              }else{
                  alert("Contraseña Incorrecta")
              }
  
          } else {
              alert("Usuario no encontrado")
          }
      }).catch((error) => {
          alert("Surgio un error " + error);
      });
    }

  //Crear usuario
  function crearUsuario() {
    leerInputs();
    if(email == "" || contra == ""){
        alert("Por favor llene todo los campos")
    }else{
        const dbref = ref(db);
        get(child(dbref, 'Usuarios/' + email)).then((snapshot) => {
            if (snapshot.exists()) {
                alert("Ese Usuario Ya Existe");
            } else {
                set(ref(db, 'Usuarios/' + email), {
                    Contraseña: contra
                }).then((res) => {
                    alert("Se Creo Usuario Con Exito")
                }).catch((error) => {
                    alert("Surgio un error " + error)
                });
            }
        }).catch((error) => {
            alert("Surgio un error " + error);
        });
  }
  }

     btnIngresar.addEventListener('click', Autenticar);
    btnCrear.addEventListener('click', crearUsuario);