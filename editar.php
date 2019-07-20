<?php 
    include "includes/layout/header.php";
    include "includes/funciones/funciones.php";

    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if(!$id){
        die("No es valido");
    }

    $resultado = retornarId($id);
    $contacto = $resultado->fetch_assoc();
?>

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
                <input type="text"
                     placeholder = "Ingrese su Nombre" 
                     id="Nombre"
                     value = 
                        "<?php
                            if($contacto['nombre']){
                                echo $contacto['nombre'];
                            }else{
                                echo '';
                            }
                        ?>"
                >
            </div>
            <div class="campo">
                <label for="Empresa">Empresa:</label>
                <input type="text"
                     placeholder = "Nombre de Empresa" 
                     id="Empresa"
                     value = 
                     "<?php
                            if($contacto['empresa']){
                                echo $contacto['empresa'];
                            }else{
                                echo '';
                            }
                        ?>"
                >
            </div>
            <div class="campo">
                <label for="Telefono">Telefono:</label>
                <input type="tel" 
                    placeholder = "Ingrese su Telefono" 
                    id="Telefono"
                    value=
                    "<?php
                            if($contacto['telefono']){
                                echo $contacto['telefono'];
                            }else{
                                echo '';
                            }
                        ?>"
                    
                >
            </div>
        </div>
        <?php
            $btnEditar = ($contacto['nombre'])  ? 'Editar' : 'Guardar';
        ?>
        <div class="campo enviar">
            <input type="hidden" id="accion" value="editar">
            <?php
                if(isset($contacto['id'])){ ?>
                    <input type="hidden" id="id" value="<?php echo $contacto['id']; ?>">
            <?php } ?>
            
            <input type="submit" value="<?php echo $btnEditar ?>">
        </div>
    </form>
</div>


<?php include "includes/layout/footer.php" ?>