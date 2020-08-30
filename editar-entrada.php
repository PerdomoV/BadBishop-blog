<?php 
    require_once './includes/conexion.php';
    require_once './includes/header.php';
    require_once 'includes/helpers.php';
    require_once './includes/side.php';
    //var_dump($_GET); die();
    $entrada_actual=getEntrada($db, (int)$_GET['id']);
    //var_dump($entrada_actual);
    //die();
    if(!isset($entrada_actual['id'])){
        header("Location: index.php");
    }
    //var_dump($entrada_actual); 
    //die();
?>
  <div id='principal'>
    <h1>Crear Entradas</h1>
    <p>AñEdita tu entrada <?=$entrada_actual['titulo']?></p>
    <br/>
    <hr/>
    <br/>
    <form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method='POST'>
        
        <?php if (isset($_SESSION['errores_entrada']['titulo'])) : ?>
                <div class='alerta alerta-error'>
                    <?= $_SESSION['errores_entrada']['titulo']; ?>
                </div>
        <?php endif; ?>

        <label for='titulo'>Título:</label>
        <input type='text' value='<?=$entrada_actual['titulo']?>' name='titulo'/>

        <?php if (isset($_SESSION['errores_entrada']['descripcion'])) : ?>
                <div class='alerta alerta-error'>
                    <?= $_SESSION['errores_entrada']['descripcion']; ?>
                </div>
        <?php endif; ?>

        <label for='descripcion'>Descripción:</label>
        <textarea value='' name='descripcion'><?=$entrada_actual['descripcion']?></textarea>

        <label for='categoria'>Categoría</label>
        <select name='categoria'>
        
        <?php 
            $categorias=getCategorias($db);
            if(!empty($categorias)):
                while($categoria=mysqli_fetch_assoc($categorias)):
        ?>
            <option value='<?=$categoria['id']?>'
            <?=($categoria['id']==$entrada_actual['categoria_id'])?'selected="selected"': ''?>
            ><?=$categoria['nombre']?></option>

        <?php
            endwhile;
            endif;
        ?>
        <input type='submit' value='Guardar' />
    </form>
    <?php borrarErrores()?>

</div>




        
	
<?php require_once './includes/footer.php'; ?>