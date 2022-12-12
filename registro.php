<?php

    // VALIDAR FORMULARIO
    
    if(isset($_POST['submit'])){
        // CONEXIÓN A LA BASE DE DATOS
        require_once 'includes/conexion.php';
       
        
        // RECOGER LOS VALORES DEL FORMULARIO DE REGISTRO
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;    
    
    
    // ARRAY DE ERRORES
    $errores = array();
    // VALIDAR LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS
    
    // VALIDAR CAMPO NOMBRE
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
            $nombre_validado = true;
        }else{
            $nombre_validado = false;
            $errores['nombre'] = "El nombre no es válido";
        }
        
        // VALIDAR CAMPO APELLIDOS
        if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
            $apellidos_validado = true;
        }else {
            $apellidos_validado = false;
            $errores['apellidos'] = "El campo apellidos no es válido";
        }
        // VALIDAR CAMPO EMAIL
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_validado = true;
        }else {
            $email_validado = false;
            $errores['email'] = "El campo email no es válido";
        }
        // VALIDAR CAMPO PASSWORD
        if(!empty($password)){
            $password_validado = true;
        }else {
            $password_validado = false;
            $errores['password'] = "El campo password está vacío";
        }

        $guardar_usuario = false;
        if(count($errores) == 0){
            $guardar_usuario = true;
            
            // CIFRAR LA CONTRASEÑA
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
       
        
        // INSERTAMOS USUARIO EN LA BBDD
        $sql = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);
        
      
        
        
        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario...";
        }
            
        }else{
        $_SESSION['errores'] = $errores;
        
        }
       
    }    
    
    header('Location: index.php');
/*
        

        
       */

/*    
    if(isset($_POST)) {
    // CONEXIÓN A LA BASE DE DATOS
    require_once 'includes/conexion.php';
    
    // INICIAR SESIÓN
    if(!isset($_SESSION)){
        session_start();
    }
    
//  RECOGER  LOS VALORES DEL FORMULARIO
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    
    
//  ARRAY DE ERRORES
    $errores = array();
    
    
//  VALIDAR ANTES DE GUARDAR EN BASE DE DATOS  
//  VALIDAR CAMPO NOMBRE    
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    }else {
        $nombre_validado = false;
        $errores['nombre'] = "El campo nombre no es válido";
    }
    
//  VALIDAR CAMPO APELLIDOS    
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validado = true;
    }else {
        $apellidos_validado = false;
        $errores['apellidos'] = "El campo apellidos no es válido";
    }
//  VALIDAR CAMPO EMAIL        
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else {
        $email_validado = false;
        $errores['email'] = "El campo email no es válido";
    }
//  VALIDAR CAMPO PASSWORD        
    if(!empty($password)){
        $password_validado = true;
    }else {
        $password_validado = false;
        $errores['password'] = "El campo password está vacío";
    }
    
    $guardar_usuario = false;
    if(count($errores) == 0){
        $guardar_usuario = true;
                 
            // CIFRAR LA CONTRASEÑA
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
            // INSERTAMOS USUARIO EN LA BBDD
        $sql = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);
        
        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario...";
        }
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');

*/
