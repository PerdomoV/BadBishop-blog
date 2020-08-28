<?php 
    require_once './includes/conexion.php';
    require_once './includes/header.php';
    require_once 'includes/helpers.php';
    require_once './includes/side.php';
    //var_dump($_GET); die();
    $entrada_actual=getEntrada($db, (int)$_GET['id']);
    if(!isset($entrada_actual['id'])){
        header("Location: index.php");
    }
    //var_dump($entrada_actual); 
    //die();
?>
  
    <div id='principal'>

        <h1><?=$entrada_actual['titulo']?></h1>
        <a href='categoria.php?id=<?=$entrada_actual['categoria_id']?>'><h2><?=$entrada_actual['categoria']?></h2></a>
        <h4><?=$entrada_actual['fecha']?></h4>

        <p><?=$entrada_actual['descripcion']?> </p>
    </div>

	
<?php require_once './includes/footer.php'; ?>