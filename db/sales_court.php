<?php 
	
	require_once('conexion.php');
	

	$option = $_POST['option'];
	$dateCourt = $_POST['date'];

	if($option == 1){

		products($dateCourt);
	}
	else if($option == 2){

		allCourts();
	}

	function products($date){
		$myDate = $date;
		$conn = dbConexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$allProducts = "SELECT detalle_venta.id_venta, detalle_venta.id_articulo, articulos.descripcion, detalle_venta.cantidad from articulos INNER JOIN detalle_venta on detalle_venta.id_articulo = articulos.bar_code INNER JOIN venta on detalle_venta.id_venta = venta.id WHERE venta.fecha_venta = '$myDate'";
		$resultProducts = $conn->query($allProducts);
		$products = $resultProducts->fetchAll();

		print '<table id="myTable" class="table table-hover">';
		print '<br>';
		print 	'<thead class="">
		            <tr>
		              <th class = "text-center" >Código Venta</th>
		              <th class = "text-center" >Descripción</th>
		              <th class = "text-center" >Vendidos</th>
		          	</tr>
          		</thead>';

       	print '<tbody id="lista">';
    	foreach ($products as $p) {
    		
    		print 	'<tr>
    					<td class="text-center">'.$p['id_venta'].'</td>
    					<td class="text-center">'.$p['descripcion'].'</td>
    					<td class="text-center">'.$p['cantidad'].'</td>
    				</tr>';
    	}
       print '</tbody>';
       print '</table>';

       print '<br>';

       modalDetail($myDate);

	}

	function allCourts(){

		$conn = dbConexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$allCourts = "SELECT * FROM corte";
		$resultCourts = $conn->query($allCourts);
		$courts = $resultCourts->fetchAll();

		print '<table id="myTable" class="table table-hover">';
		print '<br>';
		print 	'<thead class="">
		            <tr>
		              <th class = "text-center" >Fecha</th>
		              <th class = "text-center" >Ventas Realizadas</th>
		              <th class = "text-center" >Articulos Vendidos</th>
		              <th class = "text-center" >Total</th>
		              <th class = "text-center" >Fondo</th>
		              <th class = "text-center" >Gastos</th>
		              <th class = "text-center" >Ganancia</th>
		          	</tr>
          		</thead>';

       	print '<tbody id="lista">';

       	foreach ($courts as $c) {
       		
       		print 	'<tr>
       					<td class="text-center">'.$c['fecha_corte'].'</td>
    					<td class="text-center">'.$c['ventas_realizadas'].'</td>
    					<td class="text-center">'.$c['articulos_vendidos'].'</td>
    					<td class="text-center">'.$c['total'].'</td>
    					<td class="text-center">'.$c['fondo'].'</td>
    					<td class="text-center">'.$c['gastos'].'</td>
    					<td class="text-center">'.$c['ganancia'].'</td>    					
    				</tr>';	
       	}

       	print '</tbody>';
       	print '</table>';

       	print '<br>';
	}

	function modalDetail($date){
		$myDate = $date;
		$conn = dbConexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Detalle del corte se obtiene con las ventas de la fecha seleccionada
		//numero de ventas
		//numero productos vendidos
		//$$ total vendido

		$ventas = "SELECT COUNT(*) from venta where fecha_venta = '$myDate'";
		$resultCount = $conn->query($ventas);
		$totalVentas = $resultCount->fetch(PDO::FETCH_ASSOC);

		$artVendidos = "SELECT SUM(detalle_venta.cantidad) from detalle_venta INNER JOIN venta on venta.id = detalle_venta.id_venta where venta.fecha_venta = '$myDate'";
		$resultArt = $conn->query($artVendidos);
		$totalArt = $resultArt->fetch(PDO::FETCH_ASSOC);

		$total = "SELECT SUM(total_venta) from venta WHERE fecha_venta = '$myDate'";
		$resultTotal = $conn->query($total);
		$totalCourt = $resultTotal->fetch(PDO::FETCH_ASSOC);

		$totalGasto = "SELECT SUM(monto) FROM gastos WHERE fecha_gasto = '$myDate' AND add_corte = 'true'";
		$resultTotalGasto = $conn->query($totalGasto);
		$totalFORGasto = $resultTotalGasto->fetch(PDO::FETCH_ASSOC);


		print '	
       			<div class="col-md-2 col-md-offset-10">
       				<input type="button" value="Ver detalles" class="form-control btn-success" data-toggle="modal" data-target="#modDetail" data-ventas="'.$totalVentas['COUNT(*)'].'" data-art="'.$totalArt['SUM(detalle_venta.cantidad)'].'" data-total="'.$totalCourt['SUM(total_venta)'].'" data-gasto="'.$totalFORGasto['SUM(monto)'].'">
       			</div>';



	}
 ?>

