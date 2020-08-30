<?php 

    require_once './includes/header.php';
    require_once './includes/side.php';
    if(!isset($_POST['busqueda'])){
        header('Location:index.php');
    }

    $busqueda=getEntradas($db, null, null, $_POST['busqueda']);

?>
  
    <div id='principal'>

	<h1>Busqueda: <?=$_POST['busqueda']?></h1>

	<?php

    $busqueda=getEntradas($db, null, null, $_POST['busqueda']);
    //var_dump($busqueda);
    //die();
    if(!empty($busqueda)):
		while ($entrada = mysqli_fetch_assoc($busqueda)) :
	?>

		<article class='entrada'>
			<a href='entrada.php?id=<?=$entrada['entrada_id'];?>'>

				<h2><?= $entrada['titulo'] ?></h2>

				<span class='fecha'>
					<?= $entrada['categoria'] . ' | ' . $entrada['fecha']; ?>
				</span>
				<p>
					<?= substr($entrada['descripcion'], 0, 180) . "..." ?>
				</p>
			</a>
		</article>
	<?php 
		endwhile; 
	else: 
	?>
		<br>
		<div class="alerta">No existen entradas en esta categoría</div>
	<?php endif;?>
</div>


<?php require_once './includes/footer.php'; ?>