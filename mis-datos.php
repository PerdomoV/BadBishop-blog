<?php

require_once './includes/redir.php';
require_once './includes/header.php';
require_once './includes/side.php';


?>

<div id='principal'>
    <h1>Mis datos</h1>
    <p>Actualiza tus datos.</p>
    <br />
    <hr />
    <br />
    <?php if (isset($_SESSION['completado'])) : ?>
        <div class='alerta alerta-exito'>
            <?= $_SESSION['completado'] ?>
        </div>
    <?php elseif (isset($_SESSION['errores']['general'])) : ?>
        <div class='alerta alerta-error'>
            <?= $_SESSION['errores']['general'] ?>
        </div>
    <?php endif; ?>

    <form action="actualizar-datos.php" method="POST">
        <label for='nombre'>Nombre</label>
        <input type='text' name='nombre' value="<?=$_SESSION['usuario']['nombre'];?>" />

        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?>

        <label for='apellidos'>Apellidos</label>
        <input type='text' name='apellidos'    value="<?=$_SESSION['usuario']['apellidos'];?>"/>

        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''; ?>


        <label for='email'>E-mail</label>
        <input type='email' name='email' value="<?=$_SESSION['usuario']['email'];?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>

        <input type='submit' name='submit' value='Actualizar' />
    </form>
    <?php borrarErrores(); ?>
</div>




<?php require_once './includes/footer.php';  ?>