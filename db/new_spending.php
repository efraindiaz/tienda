<?php

	$date = $_POST['date'];
	$desc = $_POST['desc'];
	$spend = $_POST['spend'];
	$check = $_POST['check'];

	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$newSpending = $conn->prepare("INSERT INTO gastos (fecha_gasto,descripcion,monto, add_corte) 
		VALUES(:fecha, :descripcion, :monto, :add_corte)");

	$newSpending->bindParam(':fecha',$date);
	$newSpending->bindParam(':descripcion',$desc);
	$newSpending->bindParam(':monto',$spend);
	$newSpending->bindParam(':add_corte',$check);

	$newSpending->execute();
	$conn=null;

	print '	<div id="addSpendingAlert" class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	<p class="text-center"><strong>¡Gasto guardado satisfactoriamente!</strong></p>
			</div>';
?>