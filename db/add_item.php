<?php


	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$stmt1 = $conn->prepare("INSERT INTO articulos (bar_code, descripcion, cantidad_disponible, precio, precio_venta) VALUES (:cod, :des, :cant, :pr, :prV)");

	$stmt1->bindParam(':cod', $codigo);
	$stmt1->bindParam(':des', $descripcion);
	$stmt1->bindParam(':cant', $cantidad);
	$stmt1->bindParam(':pr', $precio_compra);
	$stmt1->bindParam(':prV', $precio_venta);

	$codigo = $_REQUEST["code"];
	$descripcion = $_REQUEST["desc"];
	$cantidad = $_REQUEST["cant"];
	$precio_compra = $_REQUEST["compra"];
	$precio_venta = $_REQUEST["venta"];

	$stmt1->execute();
	$conn = null;
	//header('Location: ../index.php');
	/*print '	<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	<p class="text-center"><strong>¡Nuevo artículo guardado satisfactoriamente!</strong></p>
			</div>';*/
	//Error
	print '	<div id="addItemAlert" class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	<p class="text-center"><strong>¡Nuevo artículo guardado satisfactoriamente!</strong></p>
			</div>';
?>