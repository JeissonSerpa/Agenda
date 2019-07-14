<?php
    
    //acciones a realizar
    if(isset($_POST['accion'])){
        if($_POST['accion'] == 'crear'){
            //creando registro

            require_once('../funciones/conexion.php');

            $nombre = $_POST['nombre'];
            $empresa = $_POST['empresa'];
            $telefono = $_POST['telefono'];

            try{
                $stmt = $conn->prepare("INSERT INTO contactos(nombre, empresa, telefono) VALUES(?,?,?)");
                $stmt->bind_param("sss", $nombre, $empresa, $telefono);
                $stmt->execute();
                if($stmt->affected_rows == 1){
                    $respuesta = array(
                        'respuesta' => 'Correcto',
                        'datos' => array(
                            'nombre' => $nombre,
                            'empresa' => $empresa,
                            'telefono' => $telefono,
                            'idInsertado' => $stmt->insert_id
                        )
                    );
                }
                $conn->close();

            }catch(Exception $e){
                $respuesta = array(
                                'error' => $e->getMessage(),
                                'linea' => $e->getLine()
                            );
            }
            echo json_encode($respuesta);
        }
    }

    if(isset($_GET['accion'])){
        if($_GET['accion'] == 'borrar'){
            require_once('../funciones/conexion.php');
            $id = $_GET['id'];

            try {
                $stmt = $conn->prepare("DELETE FROM contactos WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute(); 
                if($stmt->affected_rows == 1){
                    $mensaje = array(
                        'resultado' => 'eliminado'
                    );
                $stmt->close();
                $conn->close(); 
                }
            } catch (Exception $e) {
                $mensaje = array(
                    'mensaje' => $e->getMesage()
                );
            }
            echo json_encode($mensaje);
        }
    }