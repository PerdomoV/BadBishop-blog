<?php  include_once './includes/conexion.php';
if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST)){
    echo 'Carajo';
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;

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

    $guardar_usuario = false;
    if(count($errores)==0){




        $id=$_SESSION['usuario']['id'];
        $sql = "SELECT id ,email FROM usuarios where '$email'=email";
        $consulta=mysqli_query($db,$sql); $consulta=mysqli_fetch_assoc($consulta); 
        if($consulta['id']==$_SESSION['usuario']['id'] || empty($consulta['email'])){

            $guardar_usuario=true; 



            $sql="UPDATE usuarios set nombre='$nombre', apellidos='$apellidos', email='$email' WHERE id=$id";
                $guardar = mysqli_query($db, $sql);

            if($guardar){
                $_SESSION['completado']="La actualización se ha completado con éxito";
                $_SESSION['usuario']['nombre']=$nombre;
                $_SESSION['usuario']['apellidos']=$apellidos;
                $_SESSION['usuario']['email']=$email;
                
            }else{
                $_SESSION['errores']['general']="Fallo al actualizar datos de usuario";
            }
        }else{
            $errores['email']="El email ya está en uso";
            $_SESSION['errores']=$errores;
        }
    }else{
    $_SESSION['errores']=$errores;  
}
header("Location:mis-datos.php");

}



