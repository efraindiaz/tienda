<?php
	date_default_timezone_set('America/Mexico_City');
	require_once('conexion.php');
	$conn = dbConexion();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $conn->prepare("INSERT INTO venta (fecha_venta, total_venta) VALUES (:fecha,:total)");

	$stmt->bindParam(':fecha',$fecha);
	$stmt->bindParam('total',$total);

	$fecha = date("Y-m-d");
	$total = $_POST['total'];

	$stmt->execute();

	$sql = "SELECT MAX(id) AS id from venta";
	$result = $conn->query($sql);
	$maxID = $result->fetch(PDO::FETCH_ASSOC); 

	//Insert en detalle_venta
	for($j = 0; $j < count($_POST['barCode']); $j++){
	$venDetalle = $conn->prepare("INSERT INTO detalle_venta (id_venta, id_articulo, cantidad) VALUES (:id_venta, :id_articulo, :cantidad)");

	$venDetalle->bindParam(':id_venta', $idMax);
	$venDetalle->bindParam(':id_articulo', $id_articulo);
	$venDetalle->bindParam(':cantidad', $cantidad);

	$idMax = $maxID['id'];
	$id_articulo = $_POST['barCode'][$j];
	$cantidad = $_POST['cantidad'][$j];

	$venDetalle->execute();
	}
	//Update articulos 
	for($k = 0; $k < count($_POST['barCode']); $k++){
	$upArt = $conn->prepare("UPDATE articulos SET cantidad_disponible = (cantidad_disponible - :cantidad_update) WHERE bar_code = :id_articulo_update");

	$upArt->bindParam(':id_articulo_update', $id_articulo_update);
	$upArt->bindParam(':cantidad_update', $cantidad_update);

	$id_articulo_update = $_POST['barCode'][$k];
	$cantidad_update = $_POST['cantidad'][$k];

	$upArt->execute();
	}
	header('Location: ../');
	$conn = null;

?>