<?php

function retornarContactos(){
    include_once 'conexion.php';
    try {
        return $conn->query("SELECT * FROM contactos");
    } catch (Exception $e) {
        echo 'Error '.$e.getMesage().' Linea '.$e.getLine().'<br>';
        return false;
    }
}

//Eliminar Contacto

function retornarId($id){
    include_once 'conexion.php';
    try {
        return $conn->query("SELECT * FROM contactos WHERE id = $id");
    } catch (Exception $e) {
        echo 'Error '.$e.getMesage().' Linea '.$e.getLine().'<br>';
        return false;
    }
}