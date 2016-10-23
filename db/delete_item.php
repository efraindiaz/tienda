<?php
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	$stmt = $conn->prepare("DELETE FROM articulos WHERE id = :id");

	$stmt->bindParam(':id', $id);

	$id = $_REQUEST["idItemDel"];


	$stmt->execute();

	$conn = null;
	header('Location: ../items.php');
?>