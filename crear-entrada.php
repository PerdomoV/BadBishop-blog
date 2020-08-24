<?php 
    require_once './includes/redir.php' ;
    require_once './includes/header.php'; 
    require_once './includes/side.php'; 
?>

<div id='principal'>
    <h1>Crear Entradas</h1>
    <p>Añade nuevas categorías al blog para que los usuarios puedan leerlas y disfrutar de nuevo contenido.</p>
    <br/>
    <hr/>
    <br/>
    <form action='guardar-entrada.php' method='POST'>
        
        <?php if (isset($_SESSION['errores_entrada']['titulo'])) : ?>
                <div class='alerta alerta-error'>
                    <?= $_SESSION['errores_entrada']['titulo']; ?>
                </div>
        <?php endif; ?>

        <label for='titulo'>Título:</label>
        <input type='text' name='titulo'/>

        <?php if (isset($_SESSION['errores_entrada']['descripcion'])) : ?>
                <div class='alerta alerta-error'>
                    <?= $_SESSION['errores_entrada']['descripcion']; ?>
                </div>
        <?php endif; ?>

        <label for='descripcion'>Descripción:</label>
        <textarea name='descripcion'></textarea>

        <label for='categoria'>Categoría</label>
        <select name='categoria'>
        
        <?php 
            $categorias=getCategorias($db);
            if(!empty($categorias)):
                while($categoria=mysqli_fetch_assoc($categorias)):
        ?>
            <option value='<?=$categoria['id']?>'><?=$categoria['nombre']?></option>

        <?php
            endwhile;
            endif;
        ?>
        <input type='submit' value='Guardar' />
    </form>
    <?php borrarErrores()?>

</div>

<?php require_once './includes/footer.php';  ?>