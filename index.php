<?php include "includes/layout/header.php" ?>

<div class="contenedorBarra">
    <h1>Agenda de Contactos</h1>
</div>

<div class="bgamarillo contenedor sombra">
    <form action="#" id="contacto">
        <legend>
            Añada un Contacto
            <span>Todos los campos son obligatorios</span>
        </legend>
        <div class="campos">
            <div class="campo">
                <label for="Nombre">Nombre:</label>
                <input type="text" placeholder = "Ingrese su Nombre" id="Nombre">
            </div>
            <div class="campo">
                <label for="Empresa">Empresa:</label>
                <input type="text" placeholder = "Nombre de Empresa" id="Empresa">
            </div>
            <div class="campo">
                <label for="Telefono">Telefono:</label>
                <input type="tel" placeholder = "Ingrese su Telefono" id="Telefono">
            </div>
        </div>
        <div class="campo enviar">
            <input type="hiden" id="accion" value="crear">
            <input type="submit" value="Añadir">
        </div>
    </form>
</div>

<div class="bgBlanco contenedor sombra contactos">
    <div class="contenedorContactos">
        <h2>Contactos</h2>
        <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Contacto...">
        <p class="totalContactos"><span>2</span> Contactos</p>

        <div class="contenedorTabla">
            <div id="listadoContacto">
                <div class="fila">
                    <div class="columna encabezado">Nombre</div>
                    <div class="columna encabezado">Empresa</div>
                    <div class="columna encabezado">Telefono</div>
                    <div class="columna encabezado">Acciones</div>
                </div>
                <div class="fila">
                    <div class="columna">Jeisson Serpa</div>
                    <div class="columna">SerPan</div>
                    <div class="columna">3138912135</div>
                    <div class="columna iconos">
                        <a href="editar.php?id=1" class="btn btnEditar"><i class="fas fa-pen-square"></i></a>
                        <button type="button" data-id="1" class="btn btnBorrar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna">Emmanuel Romero</div>
                    <div class="columna">SerPan</div>
                    <div class="columna">3138912135</div>
                    <div class="columna iconos">
                        <a href="editar.php?id=1" class="btn btnEditar"><i class="fas fa-pen-square"></i></a>
                        <button type="button" data-id="1" class="btn btnBorrar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna">Pepito Perez</div>
                    <div class="columna">SerPan</div>
                    <div class="columna">3138912135</div>
                    <div class="columna iconos">
                        <a href="editar.php?id=1" class="btn btnEditar"><i class="fas fa-pen-square"></i></a>
                        <button type="button" data-id="1" class="btn btnBorrar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/layout/footer.php" ?>