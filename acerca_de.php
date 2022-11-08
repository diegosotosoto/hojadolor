<?php

	if(!isset($_COOKIE['hkjh41lu4l1k23jhlkj13'])){
		header('Location: login.php');
	}
?>
<?php
	//Conexión
	require("conectar.php");
	$conexion=new mysqli($db_host,$db_usuario,$db_contra,$db_nombre);
	$conexion->set_charset("utf8");
?>
<!-  HEAD  ->	
	<?php
		//Conexión
		require("head.php");

	?>

</head>
<body>
	<?php


		$boton_toggler="<a class='btn btn-lg shadow-sm' href='index.php'><div class='text-white'><i class='fa fa-chevron-left'></i>Atrás</div></a>";
		$titulo_navbar="Acerca De";
		$boton_navbar="<a class='navbar-brand mr-auto ms-5' href='#'' role='button'></a>";


		require("navbar.php");
	?>
	
<br>
<br>
<br>
<div class="container text-center mt-2">
	<div class="row">
		<div class="col">
			<img style="width: 80px; height: 80px;" src='/images/logo192.png'/>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<h1 class="pt-3">Hoja de Dolor HBV</h1>
		</div>
	</div>
	<ul class="list-group pt-3">
		<li class='list-group-item'><div class='d-flex justify-content-between'><div>Autor</div><div>Diego Soto Soto</div></div></li>
	</ul>
	<ul class="list-group pt-3">
		<li class='list-group-item'><div class='d-flex justify-content-between'><div>Compartir</div>
			
    <p><button class="btn">Compartir!</button></p>

    <script>
      let shareData = {
        title: 'Hoja Dolor HBV',
        text: 'Registro de pacientes con manejo de dolor agudo.',
        url: '********',
      }

      const btn = document.querySelector('button');
      const resultPara = document.querySelector('.result');

      btn.addEventListener('click', () => {
        navigator.share(shareData)
          .then(() =>
            resultPara.textContent = 'MDN shared successfully'
          )
          .catch((e) =>
            resultPara.textContent = 'Error: ' + e
          )
      });
    </script>

		</li>
	</ul>
</div>


<!-  FOOTER  ->

	<?php
		//Conexión
		require("footer.php");

	?>

</body>
</html>