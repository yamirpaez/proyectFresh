import { initializeApp } from "https://www.gstatic.com/firebasejs/9.18.0/firebase-app.js";

import{ getDatabase,onValue,ref,set,child,get,update,remove } from "https://www.gstatic.com/firebasejs/9.18.0/firebase-database.js";

import { getStorage,ref as refS, uploadBytes, getDownloadURL }  from "https://www.gstatic.com/firebasejs/9.18.0/firebase-storage.js";

import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.18.0/firebase-auth.js";

const firebaseConfig = {
  apiKey: "AIzaSyBfHlNzYvvfcxrN8RdW46SDhEo7jAvYR-Q",
  authDomain: "thompson-c1fd7.firebaseapp.com",
  projectId: "thompson-c1fd7",
  storageBucket: "thompson-c1fd7.appspot.com",
  messagingSenderId: "77970390708",
  appId: "1:77970390708:web:e0dc93e0be6fff8675e1e1",
  databaseURL: "https://thompson-c1fd7-default-rtdb.firebaseio.com/"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase();
const storage = getStorage();

var btnInsertar = document.getElementById('btnAgregar');
var btnBuscar = document.getElementById('btnBuscar');
var btnActualizar = document.getElementById('btnActualizar');
var btnBorrar = document.getElementById('btnBorrar');
var btnTodos = document.getElementById('btnTodos');
var btnLimpiar = document.getElementById('btnLimpiar');
var archivos = document.getElementById('foto');
var lista = document.getElementById('lista');

// Variables inputs
var codigo = 0;
var precio = 0;
var nombre = "";
var descripcion = "";
var url="";
var archivo="";

function leerInputs() {
    codigo = document.getElementById('txtCodigo').value;
    precio = document.getElementById('txtPrecio').value;
    nombre = document.getElementById('txtNombre').value;
    descripcion = document.getElementById('txtDescripcion').value;

    // imagen
    archivo = document.getElementById('txtImagen').value;
    url = document.getElementById('txtURL').value;
    //alert("Matricula " + matricula + " Nombre " + nombre + " Carrera " + carrera + " Genero " + genero);
}

function insertarDatos() {
    leerInputs();

    set(ref(db, 'productos/' + codigo), {
        precio:precio,
        nombre:nombre,
        descripcion:descripcion,
        archivo:archivo,
        url:url,
        estado:1
    }).then((res)=> {
        alert("Se insertó con éxito")
        mostrarProductos();
    }).catch((error)=> {
        alert("Surgió un error " + error)
    });
}

function mostrarProductos() {
    const db = getDatabase();
    const dbref = ref(db, 'productos');

    onValue(dbref, (snapshot)=>{
        lista.innerHTML = "";

        snapshot.forEach((childSnapshot)=> {
            const childKey = childSnapshot.key;
            const chilData = childSnapshot.val();

            //archivo = chilData.archivo;
         
            imagenRegistro(childKey, chilData.nombre, chilData.descripcion, chilData.precio, chilData.archivo, chilData.estado);
        });
    }, {
        onlyOnce: true
    });

}

function cargarImagen(){
    const file = event.target.files[0];
    const name = event.target.files[0].name;
  
    document.getElementById('txtImagen').value = name;

    const storage = getStorage();
    const storageRef = refS(storage, 'imagenes/' + name);

    uploadBytes(storageRef, file).then((snapshot) => {
      //document.getElementById('imgNombre').value=name;
      console.log('Se cargó la imagen');
    });
}

function imagenRegistro(cCodigo, cNombre, cDescripcion, cPrecio, cArchivo, cEstado) {
    const storage = getStorage();
    const starsRef = refS(storage, 'imagenes/'+ cArchivo);
    lista.innerHTML = "";

    // Get the download URL
    getDownloadURL(starsRef)
    .then((url) => {
            lista.innerHTML = lista.innerHTML + "<tr><td>" + cCodigo + "</td><td>"+ cNombre +"</td><td>"+ cDescripcion + "</td><td>"+cPrecio+"</td><td><img src="+url+" width=150px>"+"</td><td>"+cEstado+"</td></tr>";
    })
    .catch((error) => {
        // A full list of error codes is available at
        // https://firebase.google.com/docs/storage/web/handle-errors
        switch (error.code) {
        case 'storage/object-not-found':
            alert("No existe el archivo");
            break;
        case 'storage/unauthorized':
            alert("No tiene permisos");
            break;
        case 'storage/canceled':
            alert("Se canceló la subida")
            break;
        // ...
        case 'storage/unknown':
            alert("Error desconocido");
            break;
        }
    });
}

function descargarImagen(){
    archivo = document.getElementById('txtImagen').value;

    const storage = getStorage();
    const starsRef = refS(storage, 'imagenes/'+ archivo);

    // Get the download URL
    getDownloadURL(starsRef)
    .then((url) => {
        document.getElementById('imagen').src=url;
        document.getElementById('txtURL').value=url;    
    })
    .catch((error) => {
        // A full list of error codes is available at
        // https://firebase.google.com/docs/storage/web/handle-errors
        switch (error.code) {
        case 'storage/object-not-found':
            alert("No existe el archivo");
            break;
        case 'storage/unauthorized':
            alert("No tiene permisos");
            break;
        case 'storage/canceled':
            alert("Se canceló la subida")
            break;
    
        // ...
    
        case 'storage/unknown':
            alert("Error desconocido");
            break;
        }
    });
}

function actualizar() {
    leerInputs();
    update(ref(db,'productos/' + codigo), {
        precio:precio,
        nombre:nombre,
        descripcion:descripcion,
    }).then(()=> {
        alert("Se realizó una actualización");
        mostrarProductos();
    }).catch((error)=> {
        alert("Causa de error: " + error);
    });
}

function escribirInputs() {
    document.getElementById('txtCodigo').value = codigo;
    document.getElementById('txtNombre').value = nombre;
    document.getElementById('txtPrecio').value = precio;
    document.getElementById('txtDescripcion').value = descripcion;
    document.getElementById('txtImagen').value = archivo;
    document.getElementById('txtURL').value = url;
    document.getElementById('imagen').src = "";
}

function borrar() {
    leerInputs();
    update(ref(db,'productos/' + codigo), {
        precio:precio,
        nombre:nombre,
        descripcion:descripcion,
        estado:0
    }).then(()=> {
        alert("Se ha eliminado");
        mostrarProductos();
    }).catch((error)=> {
        alert("Causa de error: " + error);
    });
    /*leerInputs();

    remove(ref(db,'productos/' + codigo)).then(()=> {
        alert("Se ha eliminado");
        mostrarProductos();
    }).catch(()=> {
        alert("Causa de error: " + error);
    })*/
}

function mostrarDatos() {
    leerInputs();

    const dbref = ref(db);

    get(child(dbref,'productos/' + codigo)).then((snapshot)=> {
        if(snapshot.exists()) {
            nombre = snapshot.val().nombre;
            precio = snapshot.val().precio;
            descripcion = snapshot.val().descripcion;
            archivo = snapshot.val().archivo;
            url = snapshot.val().url;
            escribirInputs();
            descargarImagen();
        }
        else {
            alert("No se encontró el registro");
        }
    }).catch((error)=> {
        alert("Surgió un error: " + error);
    });
}

function limpiar() {
    codigo = "";
    nombre = "";
    precio = "";
    descripcion = "";
    archivo = "";
    escribirInputs();
}


btnInsertar.addEventListener('click', insertarDatos);
btnBuscar.addEventListener('click', mostrarDatos);
btnActualizar.addEventListener('click', actualizar);
btnBorrar.addEventListener('click', borrar);
btnTodos.addEventListener('click', mostrarProductos);
btnLimpiar.addEventListener('click', limpiar);
archivos.addEventListener('change', cargarImagen);
