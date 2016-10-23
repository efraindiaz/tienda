<!DOCTYPE html>
<?php date_default_timezone_set('America/Mexico_City'); ?>
<html lang="en">
<head>
	<link rel='shortcut icon' type='image/x-icon' href='img/favicon.ico'/>
	<meta name="theme-color" content="#4285f4">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.min.js"></script>	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.min.js"></script>
	<title>Corte</title>
	
</head>
<body style="background-color:#E9EBEE;">
	<?php require_once('header.php'); ?>
	<div class="col-md-10 col-md-offset-1" style="background-color:white; min-height:400px; padding-bottom: 20px;">
		<h2 class="text-center">Corte</h2>
		<form action="" class="form-inline" id="formCourt">
			<div class="form-group" id="divFormCourt">
				<select onchange="displayDate()" class="form-control" name="" id="option" required>
					<option value="1">Corte</option>
					<option value="2">Cortes Anteriores</option>
				</select>
				<input id="date"  class="form-control" type="date" value="<?php print date("Y-m-d"); ?>" required>
				<input id="searchCourt" type="submit" class="form-control btn-primary" value="OK!">
			</div>			
		</form>	
		<!-- Lista de Productos/Cortes -->
		<br>
		<div id="myDivTable" class="table-responsive">
			<br>
			<br>
			<div class="col-md-8 col-md-offset-2 text-center">
				<br>
				<br>
				<img src="img/abacus.png" alt="">
				<br>
				<br>
				<p><strong>¡Selecciona una fecha!</strong></p>
			</div>
		</div>	
	</div>
	<!--MODAL DETALLE CORTE-->
	<div class="modal fade " id="modDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
				<div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title text-center" id="exampleModalLabel">Detalle</h4>
			    </div>
		      	<div class="modal-body">
			        <form action="db/save_court.php"  method="POST">
			         	<div class="form-group">
				          	<label for="">Ventas Realizadas</label>
				            <div class="input-group">
				                <div class="input-group-addon">#</div>
				                <input class="form-control" type="number" id="vent" name="vent" required readonly>
			              	</div>
			         	</div>
			        	<div class="form-group">
				          	<label for="">Articulos Vendidos</label>
				            <div class="input-group">
				                <div class="input-group-addon">#</div>
				                <input class="form-control" type="number" id="art" name="art" required readonly>
			              	</div>
			          	</div>
			          	<div class="form-group">
				          	<label for="">Total</label>
				            <div class="input-group">
				                <div class="input-group-addon">$</div>
				                <input class="form-control" type="number" step="any" id="total" name="totalCourt" required readonly>
			              	</div>
			          	</div>
			          	<div class="form-group">
				          	<label for="">Fondo</label>
				            <div class="input-group">
				                <div class="input-group-addon">$</div>
				                <input class="form-control" type="number" onkeyup="checkGanancia()" step="any" id="fondo" name="fondo" min="0" value="0" required>
			              	</div>
			          	</div>
			          	<div class="form-group">
				          	<label for="">Gastos</label>
				            <div class="input-group">
				                <div class="input-group-addon">$</div>
				                <input class="form-control" type="number" step="any" id="gasto" name="gasto" required readonly>
			              	</div>
			          	</div>
			          	<div class="form-group">
				          	<label for="">Ganancia</label>
				            <div class="input-group">
				                <div class="input-group-addon">$</div>
				                <input class="form-control" type="number" step="any" id="ganancia" name="ganancia" required readonly>
			              	</div>
			          	</div>
			          	<div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					        <button type="submit" class="btn btn-warning">Guardar</button>
				     	</div>
			        </form>
		      	</div>
		    </div>
	  	</div>
	</div>
	<!--FIN MODAL DETALLE CORTE -->
	
	<script>
		$('#modDetail').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var totalVentas = button.data('ventas');
			var totalArt = button.data('art');
			var totalCourt = button.data('total');
			var totalGasto = button.data('gasto');
			var modal = $(this);
			if(totalGasto === ''){
				totalGasto = 0;
			}
			
			modal.find('.modal-body #vent').val(totalVentas);
			modal.find('.modal-body #art').val(totalArt);
			modal.find('.modal-body #total').val(totalCourt);
			modal.find('.modal-body #gasto').val(totalGasto);
			modal.find('.modal-body #ganancia').val(totalCourt-totalGasto);
		})
	</script>
</body>
</html>