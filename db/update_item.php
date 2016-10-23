<?php 

	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	$stmt = $conn->prepare("UPDATE articulos SET bar_code = :bar_code, descripcion = :descripcion, cantidad_disponible = :cantidad_disponible, precio = :precio, precio_venta = :precio_venta WHERE id = :id");

	$stmt->bindParam(':bar_code', $code);
	$stmt->bindParam(':descripcion', $desc);
	$stmt->bindParam(':cantidad_disponible', $disp);
	$stmt->bindParam(':precio', $precioCompra);
	$stmt->bindParam(':precio_venta', $precioVenta);
	$stmt->bindParam(':id', $id);

	$code = $_REQUEST["codeItem"];
	$desc = $_REQUEST["descItem"];
	$disp = $_REQUEST["dispItem"];
	$precioCompra = $_REQUEST["compItem"];
	$precioVenta = $_REQUEST["ventaItem"];
	$id = $_REQUEST["idItem"];

	$stmt->execute();

	$conn = null;
	header('Location: ../items.php');

 ?>