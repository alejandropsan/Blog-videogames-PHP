<?php
if(isset($_POST)){
    // CONEXIÓN A LA BASE DE DATOS
    require_once 'includes/conexion.php';
    
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    
    // ARRAY DE ERRORES
    $errores = array();
    // VALIDAR LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS
    
    // VALIDAR CAMPO NOMBRE   
    
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        }else{
            $errores['nombre'] = "El nombre introducido no es válido";
        }
        

        $guardar_categoria = false;
        if(count($errores) == 0){
        $guardar_categoria = true;

            $sql = "INSERT INTO categorias VALUES(null, '$nombre');";
            $guardar = mysqli_query($db, $sql);

            header("Location:index.php");
        }else{
            
            $_SESSION['errores'] = $errores;
            
            header("Location:crear-categoria.php");
        }
        
}



