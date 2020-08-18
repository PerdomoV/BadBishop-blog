<?php 
//Iniciar sesión y la conexión a la db
require_once './includes/conexion.php';
if(isset($_POST)){
	//obtener los datos del formulario
	$email=trim($_POST['email']);
	$password=$_POST['password'];
		

	//consulta para comprobar las credenciales de usuario
	
	$sql="SELECT * FROM usuarios WHERE email='$email'";
	$login = mysqli_query($db,$sql); //validar datos del formulario (comprobar password)
	
	if($login && mysqli_num_rows($login)==1){
			
		$usuario=mysqli_fetch_assoc($login);
		$verify=password_verify($password,$usuario['password']);
		if($verify){
			//Utilizar una sesion para guardar los datos del usuario logueado	
			$_SESSION['usuario']=$usuario;
			if(isset($_SESSION['error_login'])){
				$_SESSION['error_login']=null;
			}

		}else{ 
			echo 'hola';
			//Si algo fall enviar una sesion con el fallo
			$_SESSION['error_login']="correo o contraseña incorrectos";
			var_dump($_SESSION['error_login']);	
			
		}}else{		
		//error

		$_SESION['error_login']="Login incorrecto";
			
	}
}

//Redirigir al indexi.php 

header('Location:index.php');


