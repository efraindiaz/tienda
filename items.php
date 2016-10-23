<?php date_default_timezone_set('America/Mexico_City'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel='shortcut icon' type='image/x-icon' href='img/favicon.ico'/>
	<meta name="theme-color" content="#4285f4">
	<link rel='shortcut icon' type='image/x-icon' href='img/favicon.ico'/>
	<meta name="theme-color" content="#4285f4">
	<meta charset="UTF-8">
	<title>Artículos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.min.js"></script>	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.min.js"></script>	
	<script>
		$(document).ready(function(){
		    $('#myTable').DataTable({
		    	"language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
	    		"lengthChange": false
		    });
			});
	</script>
</head>
<body style="background-color:#E9EBEE; padding-bottom:50px;">
	<?php require_once('header.php');?>
	<?php require_once('db/conexion.php'); 
	$conn = dbConexion();
	$sql = "SELECT * FROM articulos";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	?>

	<div class="col-md-10 col-md-offset-1 table-responsive" style="background-color:white;">
		<h3 class="text-center">Artículos</h3>
		<br>
		<div class="table-responsive">
			<br>
			<table id="myTable" class="table table-hover">
		        <thead class="">
		            <tr>
		            	<th class = "text-center" >Código</th>
		            	<th class = "text-center" >Descripción</th>
		            	<th class = "text-center" >Disponible</th>
		            	<th class = "text-center" >Precio Compra</th>
		            	<th class = "text-center" >Precio Venta</th>
		            	<th></th>
		            	<th></th>
		          	</tr>
		        </thead>
		        <tbody id="lista">
		          	<?php foreach ($rows as $row) {	?>
		          	<tr>
		          		<td class="text-center"><?php print $row['bar_code'];?></td>
		          		<td class="text-center"><?php print $row['descripcion'];?></td>
		          		<td class="text-center"><?php print $row['cantidad_disponible'];?></td>
		          		<td class="text-center"><?php print $row['precio'];?></td>
		          		<td class="text-center"><?php print $row['precio_venta'];?></td>
		          		<?php print '<td><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modItem" data-id="'.$row['id'].'" data-code="'.$row['bar_code'].'" data-desc="'.$row['descripcion'].'" data-disp="'.$row['cantidad_disponible'].'" data-comp="'.$row['precio'].'" data-venta="'.$row['precio_venta'].'">Modificar</button></td>' ?>												
						<?php print '<td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modDelItem" data-id="'.$row['id'].'">Eliminar</button></td>' ?>
		          	</tr>
		          	<?php } ?>          	
		        </tbody>
        	</table>
		</div>
	</div>
	<!--MODAL MODIFICAR-->
	<div class="modal fade " id="modItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title text-center" id="exampleModalLabel">Modificar Producto</h4>
	      </div>
	      <div class="modal-body">
	        <form action="db/update_item.php">
	          <div class="form-group">	          	
	            <input type="text" id="id" name="idItem" hidden>
	          </div>
	          <div class="form-group">
	          	<label for="">Código</label>
	            <input class="form-control" type="text" id="barCode" name="codeItem" readonly>
	          </div>
	          <div class="form-group">
	          	<label for="">Descripción</label>
	            <input class="form-control" type="text" id="desc" name="descItem">
	          </div>
	           <div class="form-group">
	          	<label for="">Disponible</label>
	            <input class="form-control" type="number" id="disp" name="dispItem" min="0">
	          </div>
	           <div class="form-group">
	          	<label for="">Precio Compra</label>
	            <input class="form-control" type="number" step="any" id="comp" name="compItem" min="0">
	          </div>
	          <div class="form-group">
	          	<label for="">Precio Venta</label>
	            <input class="form-control" type="number" step="any" id="venta" name="ventaItem" min="0">
	          </div>
	          <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-warning">Actualizar</button>
		      </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	<!--FIN MODAL MODIFICAR -->
	<!--MODAL ELIMINAR-->
	<div class="modal fade " id="modDelItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Atención</h4>
	      </div>
	      <div class="modal-body">
	        <form action="db/delete_item.php">
	          <div class="form-group">
	            <input type="text" id="idItemDel" name="idItemDel" hidden>
	          </div>
	          <div class="form-group">
	            <h5 class="text-center">¿Esta seguro de eliminar este producto?</h5>
	          </div>	          
	          <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-danger">Eliminar</button>
		      </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	<!--FIN MODAL ELIMINAR-->
	<script>

		$('#modDelItem').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 
		  var idItem = button.data('id')
		  var modal = $(this)
		  modal.find('.modal-body #idItemDel').val(idItem)

		})
		$('#modItem').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id')
		  var code = button.data('code')
		  var desc = button.data('desc')
		  var disp = button.data('disp')
		  var comp = button.data('comp')
		  var venta = button.data('venta')
		  var modal = $(this)

		  modal.find('.modal-body #id').val(id)
		  modal.find('.modal-body #barCode').val(code)
		  modal.find('.modal-body #desc').val(desc)
		  modal.find('.modal-body #disp').val(disp)
		  modal.find('.modal-body #comp').val(comp)
		  modal.find('.modal-body #venta').val(venta)		  

		})
	</script>
	
</body>
</html>