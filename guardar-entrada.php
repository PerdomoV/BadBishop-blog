<?php
if(isset($_POST)){
    require_once './includes/conexion.php';


    $titulo=isset($_POST['titulo']) ? mysqli_real_escape_string($db , $_POST['titulo']): false;
 
    $errores=[];
    
    //titulo
    if(!empty($titulo) && !is_numeric($titulo) && !preg_match("/[0-9]/",$titulo)){
        $nombre_validado=true;
    }else{
        $nombre_validado=false;
        $errores['titulo']="El título no es válido";
    }   

    //descripcion

    $descripcion=isset($_POST['descripcion']) ? mysqli_real_escape_string($db , $_POST['descripcion']): false;

    if(!empty($descripcion) && !is_numeric($descripcion)){
        $descripcion_validado=true;
    }else{
        $descripcion_validado=false;
        $errores['descripcion']="La descripcion no es válida";
    }   



    //usuario 
    $usuarioId=$_SESSION['usuario']['id'];

    //categoria
    $categoria=isset($_POST['categoria']) ? intval($_POST['categoria']): false;



    if(count($errores)==0){
        
        $sql="INSERT INTO entradas (id,usuario_id, categoria_id, titulo, descripcion,fecha) VALUES
        (null, '$usuarioId', '$categoria','$titulo', '$descripcion', curdate())";

        mysqli_query($db, $sql);
        echo(mysqli_error($db));
        header("Location: index.php");

    }else{
        $_SESSION['errores_entrada']=$errores;
        header("Location: crear-entrada.php");
    }
}