<?php  

	require_once('conexion.php');
	$conn = dbConexion();

	$search = '';
	if(isset($_POST['search'])){
		$search = $_POST['search'];
	}
	$consulta = "SELECT * FROM articulos WHERE descripcion LIKE '%".$search."%'";
	$result = $conn->query($consulta);
	$rows = $result->fetchAll();
	$total = count($rows);
	//$resultado = $connect->query($consulta);
	//$fila = mysqli_fetch_assoc($resultado);
	//$total = mysqli_num_rows($resultado);

	if($total > 0 && $search!=''){
		$cont = 0;
		print '<ul class="list-group">';
		foreach ($rows as $producto) {

			
			if($producto['cantidad_disponible'] == 0){
				print '<a data-toggle="modal" data-target="#modQuickItem" data-id="'.$producto['id'].'" data-code="'.$producto['bar_code'].'" data-desc="'.$producto['descripcion'].'" data-disp="'.$producto['cantidad_disponible'].'" class="list-group-item panel-primary btn" style="background-color:#EF5350; color:white; border-color:red;"><span class="badge">'.$producto['cantidad_disponible'].'</span><strong>'.$producto['descripcion'].'</strong></a>';				
			}
			else{
				print '<input hidden name="idArt" type="text" value="'.$producto['bar_code'].'">';
				print '<input hidden class="center-align" readonly="true"  name="texto" type="nombreArt" value="'.$producto['descripcion'].'">';
				print '<input hidden readonly="true" name="precioArt" type="text" value="'.$producto['precio_venta'].'">';
				print '<a onclick="otraFuncion('.$cont.','.$producto['cantidad_disponible'].'), forTotal('.$producto['precio_venta'].')" class="list-group-item panel-primary btn myHoverColor" style=""><span class="badge">'.$producto['cantidad_disponible'].'</span><strong>'.$producto['descripcion'].'</strong></a>';
				++$cont;
			}
			
		}
		print '</ul>';

	}
	else if ($total > 0 || $search == ''){
		print '<p class="text-center colorBluetext" style="color:#1565C0;"><strong>Ingrese el nombre del artículo</strong></p>';
	}
	else{

		print '	<div class="progress">
    				<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
    				</div>
  				</div>
  				<p class="text-center colorBluetext" style="color:#1565C0;"><strong>No se han encontrado resultados</strong></p>';
	}
	//print $rows['descripcion'];

	/*echo $fila['articulo'];
	<?php echo '<a value="stemen" onclick="otraFuncion('.$cont.')" name="text" href="#!" class="collection-item">'.$fila['nombre'].'</a>'?>
	onclick="otraFuncion('.$cont.')"
	*/

?>


