
<?php require_once 'helpers.php';?>


<aside id='sidebar'>
               <div id='login' class='bloque'>
                   <h3> Identificate </h3>
                   <form action="login.php" method="POST">
                       <label for='email'>E-mail</label>
                       <input type='email' name='email'/>
                       <label for='password'>Contraseña</label>
                       <input type='password' name='password'/>
                       
                       <input type='submit' value='Entrar'/>
                   </form>
               </div>
               
               <div id='register' class='bloque'>
                   <h3> Registrate </h3>
                   <?php if(isset($_SESSION['completado'])):?>
                    <div class='alerta alerta-exito'>
                        <?= $_SESSION['completado']?>                    
                    </div>
                   <?php    elseif(isset($_SESSION['errores']['general'])): ?>
                    <div class='alerta alerta-error'>     
                        <?=$_SESSION['errores']['general']?>
                    </div>
                   <?php endif; ?>

                   <form action="register.php" method="POST">
                       <label for='nombre'>Nombre</label>
                       <input type='text' name='nombre'/>
                       <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'nombre'): '' ; ?>
                        <label for='apellidos'>Apellidos</label>
                       <input type='text' name='apellidos'/>
                       <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'apellidos'): '' ; ?>
                       
                       <label for='email'>E-mail</label>
                       <input type='email' name='email'/>
                       <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'email'): '' ; ?>

                       <label for='password'>Contraseña</label>
                       <input type='password' name='password'/>
                       <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'password'): '' ; ?>
                       
                       <input type='submit' name='submit' value='Registrar'/>
                   </form>
                   <?php borrarErrores();?>
               </div>
           </aside>
        </div>