<?php
if(isset($_POST['nombre'])){
    require_once './includes/conexion.php';

    $nombre=isset($_POST['nombre']) ? mysqli_real_escape_string($db , $_POST['nombre']): false;
 
    $errores=[];
    
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_validado=true;
    }else{
        $nombre_validado=false;
        $errores['nombre']="El nombre no se válido";
    }   
    if(count($errores)==0){
var_dump($_POST);

        $sql="INSERT INTO categorias VALUES(null, '$nombre')";
        mysqli_query($db, $sql);
    }
}
header("Location: index.php");