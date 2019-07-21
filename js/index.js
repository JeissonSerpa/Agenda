//Constantes glovales
const   formularioContactos = document.querySelector("#contacto"),
            contenedorTabla = document.querySelector('#listadoContacto'),
            buscador = document.querySelector('#buscar');

eventoEscucha();
contarRegistros();

//Eventos de escucha
function eventoEscucha(){
    formularioContactos.addEventListener('submit', leerFormulario);

    //Evento para eliminar contacto
    if(contenedorTabla){
        contenedorTabla.addEventListener('click', eliminarContacto);
    }
    buscador.addEventListener('input', buscarcontactos);
}

//leer las acciones del formulario y capturar info
function leerFormulario(e){
    e.preventDefault();

    //Variables con la informacion del formalario
    const   Nombre = document.querySelector('#Nombre').value,
            Empresa = document.querySelector('#Empresa').value,
            Telefono = document.querySelector('#Telefono').value,
            Accion = document.querySelector('#accion').value;

    if(Nombre === '' || Empresa === '' || Telefono === ''){
        mostrarNotificacion('Todos los Campos son Obligatorios', 'error');
    }else{
        const infoContacto = new FormData();
        infoContacto.append('nombre', Nombre);
        infoContacto.append('empresa', Empresa);
        infoContacto.append('telefono', Telefono);
        infoContacto.append('accion', Accion);
        if(Accion === 'crear'){
            console.log(...infoContacto);
            //Crear nuevo contacto en Base de Datos
            insertaDB(infoContacto);
        }else{
            //Editar contacto
            const idEditar = document.querySelector('#id').value;
            infoContacto.append('id', idEditar);
            actualizarRegistro(infoContacto);
        }
    }
}

//insertar nuevo contacto y actualizarlo en la pagina
function insertaDB(datos){
    //Crear el objeto
    const xhr = new XMLHttpRequest();
    //Abrir la conexion
    xhr.open('POST', 'includes/modelos/modelosContacto.php', true);
    //Pasar los datos
    xhr.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(xhr.responseText);
            //Emulando tabla de resultados
            const nuevoContacto = document.createElement('div');
            nuevoContacto.classList.add('fila');
            nuevoContacto.innerHTML = `
                <div class="columna">${respuesta.datos.nombre}</div>
                <div class="columna">${respuesta.datos.empresa}</div>
                <div class="columna">${respuesta.datos.telefono}</div>
            `;
            contenedorTabla.appendChild(nuevoContacto);

            //Crear contenedor para los botones
            const contenedorIconos = document.createElement('div');
            contenedorIconos.classList.add('columna', 'iconos');

            //crear icono para editar
            const iconoEditar = document.createElement('i');
            iconoEditar.classList.add('fas', 'fa-pen-square');

            //Crear enlace para editar
            const btnEditar = document.createElement('a');
            btnEditar.appendChild(iconoEditar);
            btnEditar.href = `editar.php?id=${respuesta.datos.idInsertado}`;
            btnEditar.classList.add('btn', 'btnEditar');
            contenedorIconos.appendChild(btnEditar);

            //Crear icono borrar
            const iconoBorrar = document.createElement('i');
            iconoBorrar.classList.add('fas', 'fa-trash-alt');

            //crear boton para borrar
            const btnBorrar = document.createElement('button');
            btnBorrar.appendChild(iconoBorrar);
            btnBorrar.href = `editar.php?id=${respuesta.datos.idInsertado}`;
            btnBorrar.classList.add('btn', 'btnBorrar');
            btnBorrar.setAttribute('data-id', respuesta.datos.idInsertado);
            btnBorrar.setAttribute('type', 'button');
            contenedorIconos.appendChild(btnBorrar);
            nuevoContacto.appendChild(contenedorIconos);

            //Resetear Formulario
            document.querySelector('form').reset();
            //Mostrar Notificacion
            mostrarNotificacion('Contacto Creado Correctamente', 'exito');
            //Actualizar numero de contactos
            contarRegistros();
        }
    }
    //Enviar los datos
    xhr.send(datos);
}

//actualizar registro
function actualizarRegistro(datos){
    //Crear el objeto
    const xhr = new XMLHttpRequest();
    //Abrir la conexion
    xhr.open('POST', 'includes/modelos/modelosContacto.php', true);
    //Pasar los datos
    xhr.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(xhr.responseText);
            if(respuesta.resultado === 'editado'){
                mostrarNotificacion('Contacto Editado Correctamente', 'exito');
            }else{
                mostrarNotificacion('No se Realizaron Cambios', 'error');
            }
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 3500);
        }
    }
    //console.log(...infoContacto);
    //Enviar la peticion
    xhr.send(datos);
}

//funcion para eliminar contacto
function eliminarContacto(e){
    const eventoEliminar = e.target.parentElement.classList.contains('btnBorrar');
    if(eventoEliminar){
        const id = e.target.parentElement.getAttribute('data-id');
        console.log(id);

        //pregunar si esta seguro de eliminar
        const alerta = confirm('Estas segur@ de eliminar el contacto? ');
        if(alerta){
            //se crea el objeto
            const xhr = new XMLHttpRequest();

            //se abre la conexion
            xhr.open('GET', `includes/modelos/modelosContacto.php?id=${id}&accion=borrar`, true);

            //Leer la respuesta
            xhr.onload = function(){
                if(this.status === 200){
                    const resultado = JSON.parse(xhr.responseText);
                    if(resultado.resultado == 'eliminado'){
                        const fila = e.target.parentElement.parentElement.parentElement;
                        fila.remove();
                        mostrarNotificacion('Registro Eliminado', 'exito');
                        //Actualizar conteo contactos
                        contarRegistros();
                    }else{
                        mostrarNotificacion('Hubo un error...', 'error');
                    }
                }
            }
            //Enviar los datos
            xhr.send();
        }else{
            console.log('No estoy seguro');
        }
    }    
}

//Buscador de contactos
function buscarcontactos(e){
    const   exprecion = new RegExp(e.target.value, "i"),
                registro = document.querySelectorAll('.registro');
    registro.forEach(registro => {
        registro.style.display = 'none';
        if(registro.childNodes[1].textContent.replace(/\s/g, " ").search(exprecion) != -1){
            registro.style.display = 'flex';
        }
    })
    contarRegistros();
}

//contador de contactos
function contarRegistros(){
    const    totalContactos = document.querySelectorAll('.registro'),
                contenedorTotal = document.querySelector('.totalContactos span');
    console.log(totalContactos.length);
    let contador = 0;
    totalContactos.forEach(totalContactos =>{
        if(totalContactos.style.display === '' || totalContactos.style.display === 'flex'){
            contador++;
        }
    })
    console.log(contador);
    contenedorTotal.textContent = contador;
}

//Notificacion de estatus
function mostrarNotificacion(mensaje, clase){
    const notificacion = document.createElement('div');
    notificacion.classList.add('notificacion', clase, 'sombra');
    notificacion.textContent = mensaje;

    //insertar notificacion
    formularioContactos.insertBefore(notificacion, document.querySelector('form legend'));

    //ocultar notificacion
    setTimeout(() => {
        notificacion.classList.add('visible');
        setTimeout(() => {
            notificacion.classList.remove('visible');
            setTimeout(() => {
                notificacion.remove();                
            }, 800);
        }, 3000);
    }, 100);
}