<?php

	//Ve si está activa la cookie o redirige al login
	if(!isset($_COOKIE['hkjh41lu4l1k23jhlkj13'])){
		header('Location: login.php');
	}
	//Conexión
	require("conectar.php");
	$conexion=new mysqli($db_host,$db_usuario,$db_contra,$db_nombre);
	$conexion->set_charset("utf8");
	
	//Carga Head de la página
	require("head.php");

?>

</head>
<body>

<!-  NAVBAR  ->	

	<?php
		//Botones del Toggle NAVBAR


		$boton_toggler="<button class='navbar-toggler shadow-sm' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasNavbar' aria-controls='offcanvasNavbar' style='width:70px; height:40px'><i class='fa-solid fa-bars' style='color:white'></i></button>";
		$titulo_navbar="";
		$boton_navbar="<a class='btn btn-lg shadow-sm' href='nuevo_paciente.php' role='button'><i class='fa fa-plus fa-lg' style='color:white' aria-hidden='true'></i></a>";
		//Conexión
		require("navbar.php");
	?>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">


            <div class="" id="offcanvasExampleLabel"><h5><?php echo $_COOKIE['hkjh41lu4l1k23jhlkj14']; ?></h5></div>

          <div class="text-muted"><?php echo $_COOKIE['hkjh41lu4l1k23jhlkj13']; ?></div>
          <hr>
              <div class="text-primary pt-4 fs-5">
              <i style="margin-left:12px" class="fa-solid fa-clipboard"></i>
              <a class="text-decoration-none" style="padding-left:8px" href='apuntes.php'> Apuntes</a></div>

              <div class="text-primary pt-4 fs-5">
              <i style="margin-left:10px" class="fa-solid fa-door-open"></i>
              <a class="text-decoration-none" style="padding-left:5px" href='cierra_sesion.php'> Cerrar sesión</a></div>

              <div class="text-primary pt-4 fs-5">
              <i style="margin-left:12px" class="fa-solid fa-file-arrow-up"></i>
              <a class="text-decoration-none" style="padding-left:8px" href='acerca_de.php'> Acerca de</a></div>


				<?php 

							//BUSCA SI EL USUARIO ES ADMIN Y AGREGA MENÚ DE ADMIN
							$email_user=$_COOKIE['hkjh41lu4l1k23jhlkj13'];
							$consulta_user="SELECT * FROM `usuarios_dolor` WHERE `email_usuario` = '$email_user' AND `admin` = '1'";

							$confirma_user=$conexion->query($consulta_user); 

							if(mysqli_num_rows($confirma_user)==0){//AL NO ENCONRAR REGISTROS DE ADMIN NO AGREGA NADA

							}else{ 
					
				              echo "<form id='gest_users' action='gestion_usuarios.php' method='post'><input type='hidden' name='email_user_ad' value='$email_user'/>
				              <div class='text-primary pt-4 fs-5'>
				              <i style='margin-left:10px' class='fa-solid fa-users'></i>
				              <a class='text-decoration-none' style='padding-left:5px' href='#' onclick='envioForm1()'> Gestión Usuarios</a></div></form>
				              <script>function envioForm1() {document.getElementById('gest_users').submit(); }</script>
				              ";

				              echo "<form id='gest_pacientes' action='gestion_pacientes.php' method='post'><input type='hidden' name='email_user_ad' value='$email_user'/>
				              <div class='text-primary pt-4 fs-5'>
				              <i style='margin-left:10px' class='fa-solid fa-users'></i>
				              <a class='text-decoration-none' style='padding-left:5px' href='#' onclick='envioForm2()'> Gestión Pacientes</a></div></form>
				              <script>function envioForm2() {document.getElementById('gest_pacientes').submit(); }</script>
				              ";

							}

				?>
              <div class="fixed-bottom mb-6"><hr>
                <div class="container">
                <div class="row">
                  <div class="col text-muted pb-4">
                    <i class="fa-solid fa-user-gear" style="margin-left:40px"></i><small style="padding-left:15px">Diego Soto Soto - 2022</small></div>
                </div>
              </div></div>

        </div>
      </div>


</br>
</br>

<div class="container text-center">
  <div class="row pt-5">
    <div class="col text-center">
      <a href="#" class="btn shadow-sm btn-success" style="height: 150px;width: 150px"><i class="fa-solid fa-user-plus fa-2xl pt-5"></i><div class="text-center pt-3 ps-2 pe-2">Nuevo Paciente</div></a>
    </div>

    <div class="col text-center">
      <a href="#" class="btn shadow-sm btn-primary" style="height: 150px;width: 150px"><i class="fa-solid fa-syringe fa-2xl pt-5"></i><div class="text-center pt-3 ps-2 pe-2">Ingreso Dolor</div></a>
    </div>

  </div>
   <div class="row pt-5">
    <div class="col text-center">
      <a href="#" class="btn shadow-sm btn-danger disabled" style="height: 150px;width: 150px"> <i class="fa-solid fa-clipboard fa-2xl pt-5"></i><div class="text-center pt-3 ps-2 pe-2">Visita Preanestésica</div></a>
    </div>
    
    <div class="col text-center">
      <a href="apuntes.php" class="btn shadow-sm btn-warning" style="height: 150px;width: 150px"><i class="fa-solid fa-book fa-2xl pt-5"></i><div class="text-center pt-3 ps-2 pe-2">Apuntes</div></a>
    </div>

  </div>
</div>




	<?php 
				//GUARDAR PACIENTE NUEVO

		if($_POST['nombre_paciente']){
			$nombre_paciente=htmlentities(addslashes($_POST['nombre_paciente']));
			$rut=htmlentities(addslashes(strtoupper($_POST['rut'])));
			$ficha=htmlentities(addslashes($_POST['ficha']));
			$unidad_cama=htmlentities(addslashes($_POST['unidad_cama']));
			$procedimiento=htmlentities(addslashes($_POST['procedimiento']));
			$analgesia=htmlentities(addslashes($_POST['analgesia']));
			$nivel=htmlentities(addslashes($_POST['nivel']));
			$espacio=htmlentities(addslashes($_POST['espacio']));
			$distancia=htmlentities(addslashes($_POST['distancia']));
			$solucion=htmlentities(addslashes($_POST['solucion']));
			$infusion=htmlentities(addslashes($_POST['infusion']));
			$bolo=htmlentities(addslashes($_POST['bolo']));
			$lockout=htmlentities(addslashes($_POST['lockout']));
			$peso=htmlentities(addslashes($_POST['peso']));
			$comentarios=htmlentities(addslashes($_POST['comentarios']));
			$de_alta=0;
			$fecha_creacion=date("Y-m-d H:i:s",strtotime('-4 hour'));
			$creador=ucwords(strtolower($_COOKIE['hkjh41lu4l1k23jhlkj14']));


			//PRIMERO BUSCA SI EL RUT EXISTE PREVIAMENTE Y ESTA ACTIVO
			$consulta_conf="SELECT `rut`, `nombre_paciente`,`ficha` FROM `pacientes` WHERE `rut`='$rut' AND `de_alta` = '0'";

			$confirmar=$conexion->query($consulta_conf); 

			if(mysqli_num_rows($confirmar)==0){

			//SEGUNDO BUSCA SI EL RUT EXISTE PREVIAMENTE Y ESTA DADO DE ALTA
					$consulta_conf_2="SELECT `rut`, `nombre_paciente`,`ficha` FROM `pacientes` WHERE `rut`='$rut' AND `de_alta` = '1'";

					$confirmar_2=$conexion->query($consulta_conf_2); 

					if(mysqli_num_rows($confirmar_2)==0){

								$consulta_n="INSERT INTO `pacientes` (`nombre_paciente`, `rut`, `ficha`, `unidad_cama`, `procedimiento`, `analgesia`, `nivel`, `espacio`, `distancia`, `solucion`, `infusion`, `bolo`, `lockout`, `peso`, `comentarios`, `de_alta`, `fecha_creacion`, `creador`) VALUES ('$nombre_paciente', '$rut', '$ficha', '$unidad_cama', '$procedimiento', '$analgesia', '$nivel', '$espacio', '$distancia', '$solucion', '$infusion', '$bolo', '$lockout', '$peso', '$comentarios', '$de_alta', '$fecha_creacion', '$creador') ";

									$escribir=$conexion->query($consulta_n);


									if($escribir==false){
										echo "Error en la consulta";

									}else{//NO EXISTE PREVIAMENTE NI FUE DADO DE ALTA

												echo "</br>
															<div class='alert alert-success alert-dismissible fade show'>
														    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
														    <strong>Info!</strong> Registro Guardado.
														  	</div>
												";
									}

					}else{ // EXISTE Y SE ENCUENTRA DADO DE ALTA

								$datos_alta=$confirmar_2->fetch_assoc();

								echo "
													<div class='alert alert-warning alert-dismissible fade show'>
												    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
												    <strong>Info!</strong> Este Rut ya se encuentra en la base de datos, EN ESTADO DADO DE ALTA.</br>
												    Nombre: ".$datos_alta['nombre_paciente']."</br> Rut: ".$datos_alta['rut']."</br> Ficha: ".$datos_alta['ficha']."
												  	</br>Desea Reactivar?
												  	</br>
												  	<form action='editar_paciente.php' method='post'>
												  	<input type='hidden' name='reactivar' value='yes'>
												  	<input type='hidden' name='reactivar' value='yes'>
												  	<input type='hidden' name='reactivar' value='yes'>

												  	<button class='btn shadow-sm' type='submit' name='editar' value='".$datos_alta['rut']."' />Reactivar!</button></form>
												  	</div>
										";   ////******   al enviar formulario debe editar al paciente sacarlo del alta y agregar los datos nuevos, excepto la ficha y nombre

					}


			}else{ // EXISTE Y SE ENCUENTRA ACTIVO
						echo "
									<div class='alert alert-danger alert-dismissible fade show'>
								    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
								    <strong>Info!</strong> Este Rut ya se encuentra ACTIVO en la base de datos.
								  	</div>
						";
			}



		}
	?>







	<?php 
		//Cierre Conexión
		$conexion->close();
	?>

<!-  FOOTER  ->

	<?php
		//Conexión
		require("footer.php");

	?>

</body>
</html>

