<?php 
	
	$idSpending = $_POST['idForUpdateSpending'];
	$fecha = $_POST['dateForUpdateSpending'];
	$desc = $_POST['descForUpdateSpending'];
	$monto = $_POST['spendingForUpdate'];
	$toCorte = '';
	if(isset($_POST['checkForUpdateSpending'])){
		$toCorte = 'true';
	}
	else{
		$toCorte = 'false';
	}

	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	$updateSpending = $conn->prepare("UPDATE gastos SET fecha_gasto = :fecha_gasto, descripcion = :descripcion, monto = :monto, add_corte = :add_corte WHERE id = :id");

	$updateSpending->bindParam(':id',$idSpending);
	$updateSpending->bindParam(':fecha_gasto',$fecha);
	$updateSpending->bindParam(':descripcion',$desc);
	$updateSpending->bindParam(':monto',$monto);
	$updateSpending->bindParam(':add_corte',$toCorte);

	$updateSpending->execute();
	$conn = null;

	header('Location: ../spendings.php')
 ?>