<?php require_once './includes/helpers.php'; ?>


<aside id='sidebar'>


    <div id="buscador" class="bloque">
    <h3>Buscar</h3>
        <form action='buscar.php' method="POST">
        <input type="text" name="busqueda">
        <input type="submit"value="Buscar">
    </form>
    </div> 
       
    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id='usuario-logueado' class='bloque'>
            <h3>Bienvenido,
                <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos']; ?>
            </h3>
            <a class='boton boton-verde' href='crear-entrada.php'>Crear entrada</a>
            <a class='boton' href='crear-categoria.php'>Crear categoría</a>
            <a class='boton boton-naranja' href='mis-datos.php'>Mis datos</a>
            <a class='boton boton-rojo' href='cerrar.php'>Cerrar sesión</a>

        </div>
    <?php endif; ?>


    <?php if (!isset($_SESSION['usuario'])) : ?>


        <div id='login' class='bloque'>
            <h3> Identificate </h3>

            <?php if (isset($_SESSION['error_login'])) : ?>
                <div class='alerta alerta-error'>
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for='email'>E-mail</label>
                <input type='email' name='email' />
                <label for='password'>Contraseña</label>
                <input type='password' name='password' />

                <input type='submit' value='Entrar' />
            </form>
        </div>

        <div id='register' class='bloque'>
            <h3> Registrate </h3>
            <?php if (isset($_SESSION['completado'])) : ?>
                <div class='alerta alerta-exito'>
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class='alerta alerta-error'>
                    <?= $_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <label for='nombre'>Nombre</label>
                <input type='text' name='nombre' />
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?>
                <label for='apellidos'>Apellidos</label>
                <input type='text' name='apellidos' />
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''; ?>

                <label for='email'>E-mail</label>
                <input type='email' name='email' />
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>

                <label for='password'>Contraseña</label>
                <input type='password' name='password' />
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : ''; ?>

                <input type='submit' name='submit' value='Registrar' />
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>
</div>