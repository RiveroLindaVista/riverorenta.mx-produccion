
$(document).ready(function () {

    function_get_politicas();
    setTimeout(() => {
        $('#table-politicas').dataTable();
        
    }, 500);

    // let table = new DataTable('#table-politicas');

});

async function function_get_politicas() {
    let data = {
        function: 'get_politicas'
    }
    let resp = await post_ajax(data);

    let html_tbody = '';
    resp.forEach(politica => {
        let date = new Date(politica.fecha);
        html_tbody += `<tr> 
                      <td>${politica.id}</td>
                      <td>${politica.nomina}</td>
                      <td>${politica.nombre_empleado}</td>
                      <td>${politica.politica}</td>
                      <td> ${politica.status==1 ? 'Aceptado' : 'Desactivado'}</td>
                      <td>${date.toLocaleDateString()}</td>
                      </tr>`;
    });

    $("#table-politicas tbody").html(html_tbody);

}


async function post_ajax(data) {
    let res = await $.ajax({
        type: "POST",
        url: "funcForAjax.php",
        data: data,
        dataType: "json",
        success: function (resp) {
        }
    });

    return res;

}