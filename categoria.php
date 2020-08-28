<?php 

    require_once './includes/header.php';
    require_once './includes/side.php';
    
?>
  
    <div id='principal'>

	<h1>Entradas de <?=mysqli_fetch_assoc(getCategorias($db,$_GET['id']))['nombre'];?></h1>

	<?php
	$entradas = getEntradas($db, $limit=null, $id=$_GET['id']);
	if(!empty($entradas)):
		while ($entrada = mysqli_fetch_assoc($entradas)) :
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