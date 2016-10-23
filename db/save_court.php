<?php  

	date_default_timezone_set('America/Mexico_City');
	require_once('conexion.php');
	$fechaCorte = date("Y-m-d" );
	$ventasRealizadas = $_POST['vent'];
	$articulosVendidos = $_POST['art'];
	$total = $_POST['totalCourt'];
	$fondo = $_POST['fondo'];
	$gastos = $_POST['gasto'];
	$ganancia = $_POST['ganancia'];

	print $fechaCorte;
	$conn = dbConexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	print "SELECT COUNT(*) FROM corte WHERE fecha_corte = '$fechaCorte'";

	$checkCourt = "SELECT COUNT(*) FROM corte WHERE fecha_corte = '$fechaCorte'";
	$resultCheck = $conn->query($checkCourt);
	$check = $resultCheck->fetch(PDO::FETCH_ASSOC);


	if($check['COUNT(*)'] == '0'){

		print "No existe";
		$saveCourt = $conn->prepare("INSERT INTO corte (fecha_corte, ventas_realizadas, articulos_vendidos, total, fondo, gastos, ganancia) 
		VALUES(:fecha_corte, :ventas_realizadas, :articulos_vendidos, :total, :fondo, :gastos, :ganancia)");

		$saveCourt->bindParam(':fecha_corte', $fechaCorte);
		$saveCourt->bindParam(':ventas_realizadas',  $ventasRealizadas);
		$saveCourt->bindParam(':articulos_vendidos', $articulosVendidos);
		$saveCourt->bindParam(':total', $total);
		$saveCourt->bindParam(':fondo',$fondo);
		$saveCourt->bindParam(':gastos',$gastos);
		$saveCourt->bindParam(':ganancia', $ganancia);
		
		print $ventasRealizadas;

		$saveCourt->execute();

	}
	else if($check['COUNT(*)'] == '1'){
		print "Ya existe";
		$updateCourt = $conn->prepare("UPDATE corte SET ventas_realizadas = :ventas_realizadas, 
			articulos_vendidos = :articulos_vendidos, total = :total , fondo = :fondo , gastos = :gastos, 
			ganancia = :ganancia WHERE fecha_corte = :fecha_corte");

		$updateCourt->bindParam(':fecha_corte', $fechaCorte);
		$updateCourt->bindParam(':ventas_realizadas',  $ventasRealizadas);
		$updateCourt->bindParam(':articulos_vendidos', $articulosVendidos);
		$updateCourt->bindParam(':total', $total);
		$updateCourt->bindParam(':fondo',$fondo);
		$updateCourt->bindParam(':gastos',$gastos);
		$updateCourt->bindParam(':ganancia', $ganancia);

		$updateCourt->execute();
		
	}
/*
	$saveCourt = $conn->prepare("INSERT INTO corte (fecha_corte, ventas_realizadas, articulos_vendidos, total, fondo, gastos, ganancia) 
		VALUES(:fecha_corte, :ventas_realizadas, :articulos_vendidos, :total, :fondo, :gastos, :ganancia)");

	$saveCourt->bindParam(':fecha_corte', $fechaCorte);
	$saveCourt->bindParam(':ventas_realizadas',  $ventasRealizadas);
	$saveCourt->bindParam(':articulos_vendidos', $articulosVendidos);
	$saveCourt->bindParam(':total', $total);
	$saveCourt->bindParam(':fondo',$fondo);
	$saveCourt->bindParam(':gastos',$gastos);
	$saveCourt->bindParam(':ganancia', $ganancia);

	
	print $ventasRealizadas;

	$saveCourt->execute();*/

	header('Location: ../court.php');

	$conn = null;





?>