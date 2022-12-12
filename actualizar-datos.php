<?php

// VALIDAR FORMULARIO
    
    if(isset($_POST)){
        echo 'Todo bien';
        // CONEXIÓN A LA BASE DE DATOS
        require_once 'includes/conexion.php';
        
        
        // RECOGER LOS VALORES DEL FORMULARIO DE REGISTRO
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
           
      
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
        
        $guardar_usuario = false;
        if(count($errores) == 0){
            $guardar_usuario = true;
        }
        
        //COMPROBAR SI EL EMAIL YA EXISTE
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
            
        
        
        // INSERTAMOS USUARIO EN LA BBDD
        
        $sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', email='$email' WHERE id=".$_SESSION['usuario']['id'];
        $guardar = mysqli_query($db, $sql);
  
        
        if($guardar){
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellidos'] = $apellidos;
            $_SESSION['usuario']['email'] = $email;
            $_SESSION['completado'] = "Tus datos se han actualizado con exito";
 
        }else{
            $_SESSION['errores']['general'] = "Fallo al actualizar datos"; 
        }
        }else{
            $_SESSION['errores']['general'] = "El usuario ya existe!!";
        }
    }    

    header('Location: mis-datos.php');
        
        
        
    