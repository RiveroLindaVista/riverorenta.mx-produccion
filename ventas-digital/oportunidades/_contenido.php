<div class="container text-white" id="tablaOpp">
<h1 class="titulo-uno text-white">Oportunidades activas</h1>
<p class="text-white">Inicia tu búsqueda por nombre, modelo o año.</p>  
<table id="example" class="table table-striped" style="width:100%;">
    <thead>
      <tr class="bg-light text-center text-primary">
      	<th >Etapa</th>
        <th >Nombre</th>
        <th >Modelo</th>
        <th >Año</th>
        <th hidden>C</th><th hidden>Ce</th>
      </tr>
    </thead>
    <tbody id="myTable"></tbody>
  </table>

</div>


<script>
	getOpp();
	
	function getOpp(){
		var param={
			correo:'<?=$_SESSION["owner"]?>'
		}
		$.ajax({
			url:'../_classes/get_oportunidades_sf.php',
			data:param,
			type:'POST',
			success:function($resp){
				var returnedData = JSON.parse($resp);
				$cadena="";
				for(i=0;i<returnedData.length;i++){
					$cadena+='<tr onclick="abrirOp(\''+returnedData[i]["Id"]+'\')"><td>'+returnedData[i]["StageName"]+'</td><td>'+returnedData[i]["Name"].toUpperCase()+'</td><td>'+returnedData[i]["Modelo_Auto_de_Interes__c"]+'</td><td>'+returnedData[i]["Anio__c"]+'</td><td hidden>'+returnedData[i]["Email__c"]+'</td><td hidden>'+returnedData[i]["WhatsApp_n__c"]+'</td></tr>';
				}
				$("#myTable").html($cadena);
				$('#example').DataTable({
					 responsive: true,
					  language: {
			        "decimal": "",
			        "emptyTable": "No hay información",
			        "info": "Mostrando _START_ a _END_ de _TOTAL_ resultados",
			        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
			        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
			        "infoPostFix": "",
			        "thousands": ",",
			        "lengthMenu": "Mostrar _MENU_ Entradas",
			        "loadingRecords": "Cargando...",
			        "processing": "Procesando...",
			        "search": "Buscar:",
			        "zeroRecords": "Sin resultados encontrados",
			        "paginate": {
			            "first": "Primero",
			            "last": "Ultimo",
			            "next": "Siguiente",
			            "previous": "Anterior"
			        }
			    }
				});
			}
		});
	}
	function abrirOp(Id){
		var param={
			id:Id
		}
		$.ajax({
			url:'../_classes/get_oportunidad_id.php',
			data:param,
			type:'POST',
			success:function($resp){
				//console.log($resp);
				window.location.href="<?=URL?>/v_login_session.php";
			}
		});
	}


</script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

