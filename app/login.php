<?php

  //si existe la cookie se salta el area de login y va al index
	if(!isset($_COOKIE['hkjh41lu4l1k23jhlkj13'])){

	}else{
				header('Location: index.php');
	}
	//Conexión
	require("conectar.php");
	$conexion=new mysqli($db_host,$db_usuario,$db_contra,$db_nombre);

	$conexion->set_charset("utf8");



	if(empty($_POST['email_usuario_v'])){
		//no hace nada si no hay post
	}
	else{ //cuando existe post
		$email_usuario_v=htmlentities(addslashes($_POST['email_usuario_v']));
		$pass_usuario_v=htmlentities(addslashes($_POST['pass_usuario_v']));

		$sql="SELECT `password`,`nombre_usuario` FROM `usuarios_dolor` WHERE `email_usuario`= '$email_usuario_v' AND `verified`= '1'";
		$result_sql=$conexion->query($sql);

		if(mysqli_num_rows($result_sql)==0){


					$alerta_login = "
							<div class='alert alert-danger alert-dismissible fade show'>
						    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
						    <strong>Info!</strong> Usuario o Contraseña no válidos.
						  	</div>
		      ";

				}else{
				$usuario=$result_sql->fetch_assoc();
				$confirma_pass=password_verify($pass_usuario_v,$usuario['password']);
				if($confirma_pass){

					$galletita_mail=$email_usuario_v;
					$galletita_user=$usuario['nombre_usuario'];
					setcookie("hkjh41lu4l1k23jhlkj13",$galletita_mail, time()+60*60*24*30*6);
					setcookie("hkjh41lu4l1k23jhlkj14",$galletita_user, time()+60*60*24*30*6);

					header('Location: index.php');
					
				}else{

					$alerta_login =  "

							<div class='alert alert-danger alert-dismissible fade show'>
						    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
						    <strong>Info!</strong> Usuario o Contraseña no válidos.
						  	</div>

		      ";

			}
	}

}





	//Carga Head de la página
	require("head.php");

?>



</head>
<body>
	<style type="text/css">body {
  background-color: #CCEAFF;
}</style>

	<?php


	if(empty($_POST['email_usuario'])){

	}else{
		$email_usuario=htmlentities(addslashes($_POST['email_usuario']));
		$nombre_usuario=htmlentities(addslashes($_POST['nombre_usuario']));
		$pass_usuario=htmlentities(addslashes($_POST['pass_usuario']));		
		$pass_cifrado=password_hash($pass_usuario, PASSWORD_DEFAULT);


		$chequea_email="SELECT `email_usuario` FROM `usuarios_dolor` WHERE `email_usuario`= '$email_usuario' AND `verified`= '1'";
		$result=$conexion->query($chequea_email);
		$conteo=mysqli_num_rows($result);

		if($conteo==0){
			
			$nuevo_usuario="INSERT INTO `usuarios_dolor` (`nombre_usuario`, `email_usuario`, `password`) VALUES ('$nombre_usuario','$email_usuario','$pass_cifrado')";

			$registro_usuario=$conexion->query($nuevo_usuario);

			$alerta_login = "
								<div class='alert alert-success alert-dismissible fade show'>
						    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
						    <strong>Info!</strong> Nuevo Usuario Registrado. Comunícate con el administrador para validar tu cuenta!
						  	</div>

			";


		}else{

			$alerta_login = "
							<div class='alert alert-danger alert-dismissible fade show'>
						    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
						    <strong>Info!</strong> Error en el registro, contacte al administrador.
						  	</div>

      ";
		}
	}

	?>


<?php



 if($alerta_login){

 	echo $alerta_login;

 }




?>




<form class="needs-validation" action="login.php" method="post" novalidate autocomplete="nope">
<div class="container text-center mt-4 pt-4">
  <a href="#" class="btn shadow bg-primary me-2 rounded-3 text-white border-0 pt-2" style="height: 150px;width: 320px; background-color: #0050ff;background-image: linear-gradient(45deg, #0050ff 0%, #B721FF 100%);">
  <div class="row pt-4">
  	<h1>¡Hola!<i class="fa-solid fa-face-smile-wink ps-3"></i></h1>
  </div>
  <div class="row pt-3">
    <div class="col">
      Por favor, ingresa tus datos!
    </div>
  </div>
</a>
  <div class="row pt-4">
    <div class="col">
			<div class='text-muted pt-3'>E-Mail</div>
			<div class="input-group mb-2">
    	<input type="email" name="email_usuario_v" class="form-control" required/>
    	<span class="input-group-text bg-primary text-white" id="basic-addon2"><i class="fa fa-envelope"></i></span>
    </div>
  </div>
</div>

  <div class="row pt-3">
    <div class="col">
			<div class='text-muted pt-3'>Contraseña</div>
			<div class="input-group mb-2">
    	<input type="password" name="pass_usuario_v" class="form-control" required/>
    	<span class="input-group-text bg-primary text-white" id="basic-addon2"><i class="fa fa-key"></i></span>
    	</div>
    	<div class="pt-2">	<small><a href="nueva_cuenta.php" class="text-primary"/>Crear nueva cuenta</a></small></div>
    </div>
  </div> 

  <div class="row pt-5 pb-5">
  	<div class="col">
  		<button type="submit" name="registro" class="btn btn-primary btn-lg shadow"><i class="fa-solid fa-right-to-bracket pe-2"></i>Ingresar</button>
  	</div>
  </div>
</div>
<div class="pt-5 mb-2 text-center">
	  <p class="text-muted pb-2">Anestesia<small class='fw-bold'>  UACH &nbsp;<img src='images/austral.png' style='height: 36px; width: 36px; filter: invert(60%);'/></small></p>
</div>


<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

</script>
</form>
	<?php
		//Conexión
		require("footer.php");

	?>

</body>
</html>