$(function(){
	$('#cobrar').hide();
	$('#search').focus();
	$('#search_form').submit(function(e){
		e.preventDefault();
	});
	$('#search').keyup(function(){
		var envio = $('#search').val();

		$('#resultados').html('');
		$.ajax({
			type: 'POST',
			url: 'db/buscador.php',
			data: ('search='+envio),
			success: function(resp){
				if(resp!=""){
					$('#searchCart').hide();
					$('#resultados').html(resp);
				}
			}
		});
	});
});

//AJAX for SPENDING

$(function(){
	$('#formSpending').submit(function(e){

		var check = document.getElementById("checkboxSpending").checked;
		console.log(check);
		e.preventDefault();
		var dateS = $('#dateSpending').val();
		var descS = $('#descSpending').val();
		var spending = $('#spending').val();
		
		$.ajax({
			type: 'POST',
			url: 'db/new_spending.php',
			data: {date:dateS,desc:descS,spend:spending, check:check},
			success: function(resp){
				$('#formSpending')[0].reset();
				$('#addSpending').modal('hide');
				$('#myAlert').html(resp);
				closeAlert($('#addSpendingAlert'));



			}
		});
	});
});

//END AJAX FOR SPENDING

//AJAX FOR ADD ITEM
$(function(){

	$('#formAddItem').submit(function(e){
		e.preventDefault();
		var cod = $('#code').val();
		var desc = $('#desc').val();
		var cant = $('#cant').val();
		var comp = $('#compra').val();
		var vent = $('#venta').val();

		$.ajax({
			type: 'POST',
			url: 'db/add_item.php',
			data:{code:cod, desc:desc, cant:cant, compra:comp, venta:vent},
			success: function(resp){
				$('#formAddItem')[0].reset();
				$('#addItem').modal('hide');
				$('#myAlert').html(resp);
				closeAlert($('#addItemAlert'));
			}
		});
	});

});
//END AJAX FOR ADD ITEM

//AJAX FOR SEARCH COURT
$(function(){

	$('#formCourt').submit(function(e){
		e.preventDefault();

		var option = $('#option').val();
		var date = $('#date').val();

		$.ajax({
			type: 'POST',
			url: 'db/sales_court.php',
			data: {option:option, date:date},
			success: function(resp){
				if(resp!=""){

					$('#myDivTable').html(resp);
					//$('#date').css("border-color","");
					//$('#alertDate').remove();						
					$('#myTable').DataTable({
						"language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
    					"lengthChange": false
	    			});
				}
			}
		});

	});
});
//END AJAX FOR SEARCH COURT

//ocultar date input en court.php form
function displayDate(){

	var op = $('#option').val(); 
	if(op === '2'){

		$('#date').css("display","none");
	}
	else{
		$('#date').css("display","initial");
	}
	
}

$(function(){
	$('#newItemClick').click(function(){
		$('.navbar-collapse').collapse('toggle');
	});
	$('#newSpendClick').click(function(){
		$('.navbar-collapse').collapse('toggle');
	});
	
})


//AJAX FOR QUICK UPDATE ITEM FROM INDEX
$(function(){
	$('#formQuickUpdateItem').submit(function(e){

		e.preventDefault();

		var idQuickupdateItem = $('#idQuick').val();
		var dispQuickUpdateItem = $('#dispQuick').val();

		$.ajax({
			type: 'POST',
			url: 'db/quick_update_item.php',
			data: {id:idQuickupdateItem,disp:dispQuickUpdateItem},
			success: function(resp){
				$('#formQuickUpdateItem')[0].reset();
				$('#modQuickItem').modal('hide');
				$('#myAlert').html(resp);
				$("#search").val("");
				$("#resultados").empty();
				$("#resultados").html('<p class="text-center colorBluetext" style="color:#1565C0;"><strong>Ingrese el nombre del artículo</strong></p>');
				$("#search").focus();
				closeAlert($('#quickUpdateAlert'));
			}
		});

	});
});

function checkGanancia(){


	var total = parseFloat($('#total').val());
	var gasto = parseFloat($('#gasto').val());
	var fondo = parseFloat($('#fondo').val());


	var ganancia = total - (fondo + gasto);

	$('#ganancia').val(ganancia);

	if($('#ganancia').val() === ''){
		$('#ganancia').val(0);
	}
}

function closeAlert(elemento){
	elemento.delay(4000).slideUp(200, function() {
         $(this).alert('close');
    });
}
