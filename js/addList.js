
function otraFuncion(contador,disp){
	
	var cantDisp = disp;
	var inputSearch = document.getElementById("search");
	var lista = document.getElementById("lista");
 	var idArticulo = document.getElementsByName('idArt')[contador];
 	var precioArticulo = document.getElementsByName('precioArt')[contador];
	var nombreArticulo = document.getElementsByName('texto')[contador];
	var nom_art = nombreArticulo.value;
	var id_art = idArticulo.value;
	var prec_art = precioArticulo.value;
	var cont=0;
	
	var nuevaTarea = document.createElement("tr"),

				nuevoTdId = document.createElement("td"),

				nuevoTdNombre = document.createElement("td"),

				nuevoTdPrecio = document.createElement("td"),

				nuevoTdCantidad = document.createElement("td"),

				nuevoInputId = document.createElement("input"),

				nuevoInputNombre = document.createElement("input"),

				nuevoInputPrecio = document.createElement("input"),

				nuevoInputCantidad = document.createElement("input"),

				contenido = document.createTextNode(nom_art);

	//Input para Codigo
	nuevoInputId.type = "text";
	nuevoInputId.value = id_art;
	nuevoInputId.name = "barCode[]";
	nuevoInputId.className = "form-control text-center code";
	nuevoInputId.id = "myinput";
	nuevoInputId.readOnly = true;
	nuevoInputId.addEventListener("click", eliminarProducto);
	//Input para Nombre
	nuevoInputNombre.type = "text";
	nuevoInputNombre.value = nom_art;
	nuevoInputNombre.name = "descProducto[]";
	nuevoInputNombre.className = 'form-control text-center desc';
	nuevoInputNombre.readOnly = true;
	nuevoInputNombre.addEventListener("click", eliminarProducto);
	//Input para Precio
	nuevoInputPrecio.type = "text";
	nuevoInputPrecio.value = prec_art;
	nuevoInputPrecio.name = "precio[]"
	nuevoInputPrecio.className = 'form-control text-center pr';
	nuevoInputPrecio.readOnly = true;
	nuevoInputPrecio.addEventListener("click", eliminarProducto);
	//Input numerico
	nuevoInputCantidad.className = 'form-control text-center';
	nuevoInputCantidad.type = "number";
	nuevoInputCantidad.name = "cantidad[]";
	nuevoInputCantidad.min = "1";
	nuevoInputCantidad.max = cantDisp;
	nuevoInputCantidad.value = "1";
	nuevoInputCantidad.addEventListener('change', checkTotal);



	nuevoTdId.appendChild(nuevoInputId);
	nuevoTdNombre.appendChild(nuevoInputNombre);
	nuevoTdPrecio.appendChild(nuevoInputPrecio);
	nuevoTdCantidad.appendChild(nuevoInputCantidad);
	nuevaTarea.appendChild(nuevoTdId);
	nuevaTarea.appendChild(nuevoTdNombre);
	nuevaTarea.appendChild(nuevoTdPrecio);
	nuevaTarea.appendChild(nuevoTdCantidad);
	lista.appendChild(nuevaTarea);

	//$("#search").val("");
	//$("#resultados").empty();
	$("#resultados").html('<p class="text-center colorBluetext" style="color:#1565C0;"><strong>Ingrese el nombre del artículo</strong></p>');
	$("#search").focus();
	$('#cobrar').show();
	$('#cart').hide();
	showAndEmtyInfo();
	
	

}

function showAndEmtyInfo(){
	$("#search").val("");
	$("#resultados").empty();
	$('#searchCart').show();
	$('#pago').val(0);
	$('#cambio').val(0);
}

function forTotal(precio){

	var ini = parseFloat(document.getElementById("total").value);
	var acomulado = ini + precio;

	document.getElementById("total").value = acomulado;

}

function eliminarProducto(){

	$(this).closest('tr').remove();
	 
	 checkTotal();
	 
}

function checkTotal(){
	showAndEmtyInfo()
	var precio = 0;
	var cantidad = 0;
	var acomulado = 0;
	var arrayPrecio = []
	var arrayCantidad = []
	var n = (document.getElementById("myTable").rows.length)-1;

	$('input[name^="precio"]').each(function() {

	 	precio = parseFloat($(this).val());
	 	arrayPrecio.push(precio)
	});

	$('input[name^="cantidad"]').each(function() {

		cantidad = parseInt($(this).val());
		arrayCantidad.push(cantidad);			
	});

	for(var i = 0; i < n; i++) {
		acomulado += (arrayPrecio[i] * arrayCantidad[i]);	
	}

	$('#total').val(acomulado);
	//$('#pago').val(0);
	//$('#cambio').val(0);

	if(parseInt($('#total').val()) === 0){
		$('#cobrar').hide();
		$('#cart').show();
		$('#searchCart').show();

	}
}

function checkCambio(){

		var total = parseFloat($('#total').val());
		var pago = parseFloat($('#pago').val());
		var cambio = pago - total;

		if(isNaN(cambio)){

			$('#cambio').val(0);
		}
		else{

			$('#cambio').val(cambio);
			if(parseInt($('#total').val()) === 0){
				$('#cobrar').hide();
			}
			else{
				$('#cobrar').show();
			}
		}

}

