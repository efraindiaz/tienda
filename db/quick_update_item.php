<?php  
	require_once('conexion.php');

	$conn = dbConexion(); 

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

	$stmt = $conn->prepare("UPDATE articulos SET cantidad_disponible = :cantidad_disponible WHERE id = :id");

	//$stmt->bindParam(':bar_code', $code);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':cantidad_disponible', $disp);
	

	//$code = $_REQUEST["codeItem"];
	$id = $_POST["id"];
	$disp = $_POST["disp"];
	
	$stmt->execute();

	$conn = null;
	print '	<div id="quickUpdateAlert" class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	<p class="text-center"><strong>¡Artículo modificado satisfactoriamente!</strong></p>
			</div>';

?>