<?php 
//Iniciar sesión y la conexión a la db
require_once './includes/conexion.php';

//obtener los datos del formulario
if(isset($_POST){
	$email=trim($_POST['email']);
	$password=$_POST['password'];
	
	//consulta para comprobar las credenciales de usuario

	//validar datos del formulario (comprobar password)




	//Guardar los datos del usuario en una sesion


	//Si hay fallos enviarlos en una sesion



	//Redirigir al indexi.php 
	$sql="select password from usuarios where email='$email' limit 1";

	$password=mysqli_query($db,$sql);

	var_dump($password);
	mysqli_free_result($password);
}
