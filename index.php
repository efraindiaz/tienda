<?php date_default_timezone_set('America/Mexico_City'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel='shortcut icon' type='image/x-icon' href='img/favicon.ico'/>
	<meta name="theme-color" content="#4285f4">
	<meta charset="UTF-8">
	<title>Tienda</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.min.js"></script>	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/scripts.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/addList.js"></script>
	<style>
	</style>
</head>
<body style="background-color:;">
	<?php require_once('header.php'); ?>
	<!-- USar bandages para cantidad de productos-->
	<div class="col-md-3" style="background-color:;">
		<h3 class="text-center">Agregar a la Compra</h3>
        <form action="" method="post" name="search_form" id="search_form" >
        	<input class="form-control" type="text" name="search" id="search" placeholder="Buscar Articulo" autocomplete="off">
        </form>
        <br>
     	<div class="text-center" id="resultados"></div>
     	<div class="text-center" id="searchCart">
 			<img src="img/search.png" alt="">
     		<br>
     		<br>
        	<p><strong>Buscar producto</strong></p>
     	</div>
	</div>
	<form action="db/new_sale.php" id="shopList"  method="post">
	<div class="col-md-6" style="background-color:white;">
		<h3 class="text-center">Detalle de Compra</h3>
		<table id="myTable" class="table table-striped">
          <thead class="">
            <tr>
              <th class = "text-center" data-field="id">Código</th>
              <th class = "text-center" data-field="Nombre">Descripción</th>
              <th class = "text-center" data-field="Precio">Precio</th>
              <th class = "text-center" data-field="Cantidad">Cantidad</th>
          </tr>
          </thead>
          <tbody id="lista" name="lista">
          </tbody>
        </table>
        <div id="cart" class="text-center">
        	<img src="img/shopping-cart.png" alt="">
        	<p><strong>¡Agrega un producto!</strong></p>
        </div>
	</div>

	<div class="col-md-3" style="background-color:;">

		<h3 class="text-center">A Pagar</h3>
			<div class="input-group">
				<div class="input-group-addon"><strong>Total:</strong>&nbsp&nbsp&nbsp&nbsp</div>
				<div class="input-group-addon">$</div>
				<input id="total" class="form-control input-lg text-center" style="color:green; font-size:40px;" name="total" type="number" step="any" value="0" readonly>
			</div>
			<br>
			<div class="input-group">
				<div class="input-group-addon"><strong>Pago:</strong>&nbsp&nbsp&nbsp&nbsp</div>
				<div class="input-group-addon">$</div>
				<input id="pago" onkeyup="checkCambio()" class="form-control input-lg text-center" style="color:blue; font-size:40px;" type="number" step="any" value="0" required>
			</div>
			<br>
			<div class="input-group">
				<div class="input-group-addon"><strong>Cambio:</strong></div>
				<div class="input-group-addon">$</div>
				<input id="cambio"  class="form-control input-lg text-center" style="color:red; font-size:40px;" type="number" step="any" value="0" min="0" readonly>
			</div>
			<br>
			<div class="form-group">
				<input type="submit" id="cobrar" class="form-control btn-success"  value="Terminar" hidden>
			</div>
	</div>
	</form>
	<!--MODAL MODIFICAR-->
	<div class="modal fade " id="modQuickItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title text-center" id="exampleModalLabel">Modificar Producto</h4>
			    </div>
		      	<div class="modal-body">
		      		<div class="alert alert-danger">
					  	<p class="text-center"><strong>No hay suficientes artículos.</strong></p>
					</div>
			        <form id="formQuickUpdateItem" action="" method="POST">
			        	<div class="form-group">	          	
			            	<input type="text" id="idQuick" hidden>
			          	</div>
			         	<div class="form-group">
				          	<label for="">Código</label>
				            <input class="form-control" type="text" id="barCode" readonly>
			          	</div>
				        <div class="form-group">
				          	<label for="">Descripción</label>
				            <input class="form-control" type="text" id="desc" readonly>
				        </div>
				        <div class="form-group">
				          	<label for="">Disponible</label>
				            <input style="border-color:red;" class="form-control" type="number" id="dispQuick" min="0">
				        </div>
				        <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					        <button id="quickUpdateItem" type="submit" class="btn btn-danger">Actualizar</button>
					    </div>
			        </form>
		      	</div>
		    </div>
		</div>
	</div>
	<!--FIN MODAL MODIFICAR -->
	<script>
		$('#modQuickItem').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var id = button.data('id')
		  var code = button.data('code')
		  var desc = button.data('desc')
		  var disp = button.data('disp')
		  var modal = $(this)

		  modal.find('.modal-body #idQuick').val(id)
		  modal.find('.modal-body #barCode').val(code)
		  modal.find('.modal-body #desc').val(desc)
		  modal.find('.modal-body #dispQuick').val(disp)		  

		})
	</script>
	
</body>
</html>