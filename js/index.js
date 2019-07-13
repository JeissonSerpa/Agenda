const formularioContactos = document.querySelector("#contacto");

eventoEscucha();

function eventoEscucha(){
    formularioContactos.addEventListener('submit', leerFormulario);
}

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
            //Crear nuevo contacto en Base de Datos
            insertaDB(infoContacto);
        }else{

        }
    }
}

function insertaDB(datos){
    //llamado a AJAX
    
    //Crear el objeto
    const xhr = new XMLHttpRequest();
    //Abrir la conexion
    xhr.open('POST', 'includes/modelos/modelosContacto.php', true);
    //Pasar los datos
    xhr.onload = function(){
        if(this.status === 200){
            console.log(JSON.parse(xhr.responseText));
        }
    }
    //Enviar los datos
    xhr.send(datos);

}

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