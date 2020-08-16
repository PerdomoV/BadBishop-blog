<?php 
require_once './includes/conexion.php';
if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['submit'])){
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db,$_POST['password']) : false;

    //Array de errores
    $errores=[];

    /*  Validacion de nombre*/
    if(!preg_match('/[0-9]/', $nombre) && !is_numeric($nombre) && !empty($nombre)){
        echo 'Nombre valido';
        $nombre_validado=true;
    }else{
        $nombre_validado=false;
        $errores['nombre']='El nombre no es válido';
    }
    //Validar el apellido
    if(!preg_match('/[0-9]/', $apellidos) && !is_numeric($apellidos) && !empty($apellidos)){
        echo 'apellido valido';
        $apellidos_validado=true;
    }else{
        $apellidos_validado=false;
        $errores['apellidos']='El apellido no es válido';
    }
    //Validar el email
    if(preg_match('/@/', $email) && filter_var($email,FILTER_VALIDATE_EMAIL) && !empty($email)){
        echo 'email valido';
        $email_validado=true;
    }else{
        $errores['email']='El email no es válido';
        $email_validado=false;
    }

    if(!empty($password)){
        echo 'Password valido';
        $pass_validado=true;
    }else{
        $pass_validado=false;
        $errores['password']='El pass no es válido';
    }

    $guardar_usuario = false;
    if(count($errores)==0){
        $guardar_usuario=true;
        //Cifrar la contraseña
        $password_segura=password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
                
        //Insertar datos en la db
        //
        $sql="insert into usuarios values (null, '$nombre', '$apellidos', '$email', '$password_segura', curdate())";
        $guardar = mysqli_query($db, $sql);

        if($guardar){
            $_SESSION['completado']="El registro se ha completado con éxito";
        }else{
            $_SESSION['errores']['general']="Fallo al guardar el usuario";
        }

    }else{
        $_SESSION['errores']=$errores;  
    }
    header('Location: index.php');

}
