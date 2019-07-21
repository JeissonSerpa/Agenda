<?php
    include "includes/funciones/funciones.php";
    include "includes/layout/header.php";
?>

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
            <input type="hidden" id="accion" value="crear">
            <input type="submit" value="Añadir">
        </div>
    </form>
</div>

<div class="bgBlanco contenedor sombra contactos">
    <div class="contenedorContactos">
        <h2>Contactos</h2>
        <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Contacto...">
        <p class="totalContactos"><span></span> Contactos</p>

        <div class="contenedorTabla">
            <div id="listadoContacto">
                <div class="fila">
                    <div class="columna encabezado">Nombre</div>
                    <div class="columna encabezado">Empresa</div>
                    <div class="columna encabezado">Telefono</div>
                    <div class="columna encabezado">Acciones</div>
                </div>
                <?php
                    $contactos = retornarContactos();

                    if($contactos->num_rows){
                        foreach ($contactos as $contactos) {
                ?>
                <div class="fila registro">
                    <div class="columna"><?php echo $contactos['nombre']; ?></div>
                    <div class="columna"><?php echo $contactos['empresa']; ?></div>
                    <div class="columna"><?php echo $contactos['telefono']; ?></div>
                    <div class="columna iconos">
                        <a href="editar.php?id=<?php echo $contactos['id']; ?>" class="btn btnEditar"><i class="fas fa-pen-square"></i></a>
                        <button type="button" data-id="<?php echo $contactos['id']; ?>" class="btn btnBorrar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "includes/layout/footer.php" ?>