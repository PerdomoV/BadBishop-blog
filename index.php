<?php require_once './includes/header.php'; ?>

<!--sidebar-->
<?php require_once './includes/side.php'; ?>
<!--contenido principal-->
<div id='principal'>

	<h1>Ultimas entradas</h1>

	<?php
	$entradas = getEntradas($db, $limit=true, $id=null);
	while ($entrada = mysqli_fetch_assoc($entradas)) :
	?>

		<article class='entrada'>
		
			<a href='entrada.php?id=<?=$entrada['entrada_id'];?>'> 
			<?//var_dump($entrada['id']);  die();?>
				<h2><?= $entrada['titulo'] ?></h2>

				<span class='fecha'>
					<?= $entrada['categoria'] . ' | ' . $entrada['fecha']; ?>
				</span>
				<p>
					<?= substr($entrada['descripcion'], 0, 180) . "..." ?>
				</p>
			</a>
		</article>
	<?php endwhile; ?>


	<div id='ver-todas'>
		<a href='entradas.php'>Ver todas las entradas</a>
	</div>
</div>


<?php require_once './includes/footer.php'; ?>