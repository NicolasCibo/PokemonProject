<header>
	<div class="menu_superior">
		<nav class="nav-header" id="navi">
			<a href="index.php"><img src="../img/pokeball_logo.png" alt="pokemon_logo"></a>
				
			<ul class="menu">
					<?php if($_SESSION['logueado'] === true)
					{ ?>
						<?php if($_SESSION['categoria'] == "Administrador") { ?>
						<li id="partida"><a href="admin_menu_principal.php">Administrar</a></li>
						<?php } ?>
						<li id="partida"><a href="#">Partida</a>
							<ul>
								<li><a href="partida.php">Actual</a></li>
								<li><a href="seleccion_partida.php">Cambiar</a></li>
								<li><a href="menu_crear_partida.php">Crear</a></li>
								<li><a href="../code/eliminar_partida.php">Eliminar</a></li>
							</ul>
						</li>
						<li><a href="../code/cerrar_sesion.php">Cerrar sesión</a></li>
					<?php }
					else{ ?>
				<li><a href="menu_login.php">Ingresar</a></li>
				<li><a href="menu_register.php">Registrarse</a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>
</header>