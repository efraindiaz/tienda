<?php 
	
	$id = $_POST['idSpendingDel'];

	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	$delSpending = $conn->prepare("DELETE FROM gastos WHERE id = :id");

	$delSpending->bindParam(':id', $id);

	
	$delSpending->execute();

	$conn = null;
	header('Location: ../spendings.php');


 ?>