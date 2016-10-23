<?php date_default_timezone_set('America/Mexico_City'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gastos</title>
	<link rel='shortcut icon' type='image/x-icon' href='img/favicon.ico'/>
	<meta name="theme-color" content="#4285f4">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.min.js"></script>	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/scripts.js"></script>
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
<body style="background-color:#E9EBEE;">
	<?php require_once('header.php'); ?>
	<?php require_once('db/conexion.php') ?>
	<?php
	$conn = dbConexion();
	$sql = "SELECT * FROM gastos";
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	?>
	<div class="col-md-10 col-md-offset-1" style="background-color:white;">
		<h3 class="text-center">Gastos</h3>
		<div class="table-responsive">

			<table id="myTable" class="table table-hover">
				<br>
				<thead>
					<tr>
						<th class="text-center">Fecha</th>
						<th class="text-center">Descripción</th>
						<th class="text-center">Monto</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody id="lista">
					<?php foreach ($rows as $spending) {?>
					<tr>
						<td class="text-center"><?php print $spending['fecha_gasto']; ?></td>
						<td class="text-center"><?php print $spending['descripcion']; ?></td>
						<td class="text-center"><?php print $spending['monto']; ?></td>
						<?php print '<td><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modUpdateSpending" data-id="'.$spending['id'].'" data-date="'.$spending['fecha_gasto'].'" data-desc="'.$spending['descripcion'].'" data-monto="'.$spending['monto'].'" data-tocorte="'.$spending['add_corte'].'">Modificar</button></td>' ?>												
						<?php print '<td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modDelSpending" data-id="'.$spending['id'].'">Eliminar</button></td>' ?>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
		
	</div>
	<!--MODAL UPDATE SPENDING -->
	<div class="modal fade " id="modUpdateSpending" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-sm" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      <h4 class="modal-title text-center" id="exampleModalLabel">Agregar Gasto</h4>
	    </div>
	    <div class="modal-body">
	      
	      <form action="db/update_spending.php" method="POST" id="formSpending">

	      	<input type="text" id="idForUpdateSpending" name="idForUpdateSpending" hidden>
	        <div class="form-group">
	          <label for="">Fecha</label>
	          <div class="input-group">
	            <div class="input-group-addon">#</div>
	            <input class="form-control" type="date" id="dateForUpdateSpending" name="dateForUpdateSpending" required>
	          </div>              
	        </div>
	         <div class="form-group">
	          <label for="">Descripción</label>
	          <input class="form-control" type="text" id="descForUpdateSpending" name="descForUpdateSpending" required>
	        </div>
	         <div class="form-group">
	          <label for="">Monto</label>
	          <div class="input-group">
	            <div class="input-group-addon">$</div>
	            <input class="form-control" type="number" step="any" id="spendingForUpdate" name="spendingForUpdate" min="0" required>
	          </div>
	          </div>
	          <div class="checkbox">
	            <label>
	                <input type="checkbox" id="checkboxForUpdateSpending" name="checkForUpdateSpending"> Agregar al corte
	            </label>
	          </div>
	        <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        <button id="buttonSendSpending" type="submit" class="btn btn-danger">Guardar</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
	</div>
	<!-- FIN MODAL UPDATE SPENDING -->

	<!--MODAL ELIMINAR-->
	<div class="modal fade " id="modDelSpending" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Atención</h4>
	      </div>
	      <div class="modal-body">
	        <form action="db/delete_spending.php" method="POST">
	          <div class="form-group">
	            <input type="text" id="idSpendingDel" name="idSpendingDel">
	          </div>
	          <div class="form-group">
	            <h5 class="text-center">¿Esta seguro de eliminar este elemento?</h5>
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

		$('#modUpdateSpending').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id')
			var date = button.data('date')
			var desc = button.data('desc')
			var monto = button.data('monto')
			var addCorte = button.data('tocorte')
			var modal = $(this)

			modal.find('.modal-body #idForUpdateSpending').val(id)
			modal.find('.modal-body #dateForUpdateSpending').val(date)
			modal.find('.modal-body #descForUpdateSpending').val(desc)
			modal.find('.modal-body #spendingForUpdate').val(monto)
			if(addCorte === true){
				document.getElementById("checkboxForUpdateSpending").checked = true;
			}
			else{
				document.getElementById("checkboxForUpdateSpending").checked = false;
			}
			//modal.find('.modal-body #checkboxForUpdateSpending').val(addCorte)	  
		})

		$('#modDelSpending').on('show.bs.modal', function (event){
			var button = $(event.relatedTarget) // Button that triggered the modal
			var idDelSpending = button.data('id')
			var modal = $(this)

			modal.find('.modal-body #idSpendingDel').val(idDelSpending);
		})

	</script>
	
</body>
</html>