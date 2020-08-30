<?php
function mostrarErrores($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . "</div>";
    }
    return $alerta;
}

function borrarErrores()
{
    $borrado = false;
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        //$borrado=session_unset();

    }

    if (isset($_SESSION['errores_entrada'])) {
        $_SESSION['errores_entrada'] = null;
    }

    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        //$borrado=session_unset(); 
    }
    return $borrado;
    //$borrado = session_unset();
    //return $borrado;
}

function getCategorias($db, $id = null)
{

    $sql = "SELECT * FROM categorias ORDER BY id ASC";

    if ($id) {
        $sql = "SELECT * FROM categorias WHERE id='$id' ORDER BY id ASC";
    }

    $categorias = mysqli_query($db, $sql);
    $result = [];

    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $result = $categorias;
    }
    return $result;
}


function getEntradas($db, $limit = null, $id = null, $busqueda=null)
{

    $sql = "SELECT entradas.id as 'entrada_id',categorias.nombre as 'categoria', entradas.titulo as 'titulo',
    entradas.descripcion AS 'descripcion',entradas.fecha AS 'fecha' FROM entradas, categorias
     WHERE categorias.id=entradas.categoria_id  ORDER BY fecha DESC";

    if(isset($busqueda)){
    
        $sql="SELECT entradas.id as 'entrada_id',categorias.nombre as 'categoria', entradas.titulo as 'titulo',
         entradas.descripcion AS 'descripcion',entradas.fecha AS 'fecha', categorias.nombre AS 'categoria' FROM entradas INNER JOIN categorias ON
         entradas.categoria_id=categorias.id WHERE entradas.titulo LIKE  '%$busqueda%' ";

    }

    if ($limit) {
        $sql .= "  LIMIT 4";
    }

    if ($id) {
        $id=(int)$id;
    
        $sql = "SELECT entradas.id as 'entrada_id', categorias.nombre as 'categoria', entradas.titulo as 'titulo',
    entradas.descripcion AS 'descripcion', entradas.fecha AS 'fecha' FROM entradas INNER JOIN categorias
     ON categorias.id=entradas.categoria_id WHERE entradas.categoria_id=$id  ORDER BY fecha DESC";
    }

    $entradas = mysqli_query($db, $sql);
    $result = [];
    //var_dump($entradas);
    //die();
    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $result = $entradas;
    }
    return $result;
}

function getEntrada($db, $id){
    
    $sql="SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS 'usuario' FROM entradas e ".
    "INNER JOIN categorias c ON e.categoria_id = c.id ".
    "INNER JOIN usuarios u ON e.usuario_id = u.id ".
    "WHERE e.id=$id;";
    $entrada=mysqli_query($db,$sql);
    $resultado=[];
   
    if($entrada && mysqli_num_rows($entrada)>=1){
        $resultado=mysqli_fetch_assoc($entrada);    
    }
    return $resultado;
}
