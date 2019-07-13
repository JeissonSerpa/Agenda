<?php include "includes/layout/header.php" ?>

<div class="contenedorBarra">
    <div class="contenedor barra">
        <a href="index.php" class="btn volver">Volver</a>
        <h1>Editar Contacto</h1>
    </div>
</div>

<div class="bgamarillo contenedor sombra">
    <form action="#" id="contacto">
        <legend>Añada un Contacto</legend>

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
            <input type="submit" value="Editar">
        </div>
    </form>
</div>


<?php include "includes/layout/footer.php" ?>