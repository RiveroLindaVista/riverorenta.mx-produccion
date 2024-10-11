
$(document).ready(function () {

    function_get_politicas();

});

async function function_get_politicas() {
    let data = {
        function: 'get_politicas'
    }
    let resp = await post_ajax(data);

    let html_tbody = '';
    resp.forEach(politica => {
        html_tbody += '<tr>' +
                      `<td>${politica.id}</td>`+
                      `<td>${politica.nombre} &nbsp&nbsp&nbsp&nbsp&nbsp <i onclick="edit_name_politica('${politica.nombre}')" class="bi bi-pen h4" style="color:blue"></i> </td>`+
                      `<td>${politica.fecha}</td>`+
                      `<td style="text-align: center"> <button onclick="edit_politica('${politica.nombre}')" class="btn btn-primary">Actualizar Politica &nbsp&nbsp&nbsp<i class="bi bi-pencil-square h2" style="color:white"></i></button></td>`+
                      `</tr>`;
    });

    $("#table-politicas tbody").html(html_tbody);

}

async function guardar_politica() {
    console.log('prepare updating');
    let nombre_politica = $('#nombre_politica').val();
    let input_file_length = $('#input-file-id')[0].files.length;
    
    let text = '';
    if (nombre_politica === '' || input_file_length === 0) {
        text = 'El nombre y el archivo son obligatorios';
    } else {
        let input_file_type = $('#input-file-id')[0].files[0].type;
        console.log(input_file_type);
        if (input_file_type !== 'application/pdf') {
            text = 'Solo se aceptan archivos PDF';
        }
    }
    if (text !== '') {
        Swal.fire({
            icon: "warning",
            title: "Warning.",
            text: text,
            footer: ''
          });
          return true;
    }

    let obj = 'input-file-id';
    let nameimg = nombre_politica+'.pdf'; 

    let resp_upload = await upload_image_function(obj, nameimg);
    console.log('respuesta de upload externo');
    console.log(resp_upload);
    
    let url_document = resp_upload;

    //Guardando informacion en BD
    let data = {
        nombre: nombre_politica,
        url_document: url_document,
        function : 'insert_politica'
    }
    let resp = await post_ajax(data);
    await function_get_politicas();
    reset_form_modal(); 
    console.log(resp);
    
}

let count_request_change_img = 0;
/**params: obj: nombre del input, nameimg: nombre de la imagen */
async function upload_image_function(obj, nameimg) {
    // var color = document.getElementById('color').value;
    var fd = new FormData();
    var files = $('#' + obj)[0].files[0];
    if (files) {
        let filepath = 'politicas_rivero/';
        
        console.log(filepath);
        

        fd.append('file', files);
        // fd.append('color',color);
        // fd.append('marca', '<?= $auto["marca"] ?>');
        // fd.append('modelo', '<?= $auto["modelo"] ?>');
        // fd.append('ano', '<?= $auto["ano"] ?>');
        fd.append('name', nameimg);
        fd.append('filepath', filepath);

        let = resp_upload_img = await $.ajax({
            url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/update_img_colores.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                //alert(response);
            },  error: function(XMLHttpRequest, textStatus, errorThrown) {
                $("#ul-modal-status").append('<li style="border: 2px solid gray;" class="list-group-item list-group-item-danger">Error al subir imagen: '+nameimg+'</li>');
                    // alert('El color ya existe o no se puedo subir,intenta de nuevo.');
            }
        });

        console.log('File uploaded: ' + obj + '| ' + nameimg);
        if (resp_upload_img != 0) {
            count_request_change_img++;
            // document.getElementById('return_file').innerHTML = resp_upload_img;
            $('.dropzone').css({
                'cssText': 'border: none !important;'
            });
            $('#contresp').css({
                'cssText': 'display: block !important;'
            });

            $("#ul-modal-status").append('<li style="border: 2px solid gray;" class="list-group-item list-group-item-success">'+nameimg+' cargado correctamente <b>('+count_request_change_img+'</b> de 1)</li>');
            return resp_upload_img;
        } else {
            $("#ul-modal-status").append('<li style="border: 2px solid gray;" class="list-group-item list-group-item-danger">Error al subir imagen: '+nameimg+'</li>');
            alert('El color ya existe o no se puedo subir,intenta de nuevo..');
            return 501;
        }

    } else {
        console.log('No file found in: ' + obj + '| ' + nameimg);
        return 502;
    }
}

function edit_name_politica(nombre_politica) {
    console.log(nombre_politica);
    /**open modal edit */
    $('#nombre_politica_modal_hide').val(nombre_politica);
    $('#EditNameModal').modal('show');
}

async function update_name_politica() {
    let data = {
        'nombre': $('#nombre_politica_modal').val(),
        'function': 'update_name_policy',
        'nombre_politica_modal_hide': $('#nombre_politica_modal_hide').val()
    }

    let resp = await post_ajax(data);
    await function_get_politicas();
    $('#EditNameModal').modal('hide');
    let text = 'Error al actualizar intentalo de nuevo';
    let icon_alert = 'error';
    if (resp == true) {
        text = 'Actualizado';
        icon_alert = 'success';
    }

    reset_form_modal();
    
    Swal.fire({
        icon: icon_alert,
        title: "Warning.",
        text: text,
        footer: ''
      });
    console.log(resp);
    
}

function reset_form_modal() {
    $('#nombre_politica_modal').val('');
    $('#nombre_politica_modal_pol').val('');
    $('#input-file-id-pol').val('');
    $('#ul-modal-status').html('');
    count_request_change_img = 0;
    $('#nombre_politica').val('');
    $('#input-file-id').val('');
}

function edit_politica(nombre_politica) {
    console.log('Editar politica');
    $('#nombre_politica_modal_hide_pol').val(nombre_politica);
    $('#EditPolitica').modal('show');
    
}

async function update_politica() {
    console.log('prepare updating');
    let nombre_politica = $('#nombre_politica_modal_pol').val();
    let input_file_length = $('#input-file-id-pol')[0].files.length;
    
    let text = '';
    if (nombre_politica === '' || input_file_length === 0) {
        text = 'El nombre y el archivo son obligatorios';
    } else {
        let input_file_type = $('#input-file-id-pol')[0].files[0].type;
        console.log(input_file_type);
        if (input_file_type !== 'application/pdf') {
            text = 'Solo se aceptan archivos PDF';
        }
    }
    if (text !== '') {
        Swal.fire({
            icon: "warning",
            title: "Warning.",
            text: text,
            footer: ''
          });
          return true;
    }

    let obj = 'input-file-id-pol';
    let nameimg = nombre_politica+'.pdf'; 

    let resp_upload = await upload_image_function(obj, nameimg);
    console.log('respuesta de upload externo');
    console.log(resp_upload);
    
    let url_document = resp_upload;

    //Guardando informacion en BD
    let nombre_politica_modal_hide_pol = $('#nombre_politica_modal_hide_pol').val();
    let data = {
        nombre_politica_modal_hide_pol: nombre_politica_modal_hide_pol,
        nombre: nombre_politica,
        url_document: url_document,
        function : 'update_policy'
    }
    let resp = await post_ajax(data);
    await function_get_politicas();
    console.log(resp);

    $('#EditPolitica').modal('hide');
    let text_modal = 'Error al actualizar intentalo de nuevo';
    let icon_alert = 'error';
    if (resp == true) {
        text_modal = 'Actualizado';
        icon_alert = 'success';
    }

    reset_form_modal(); 
    
    Swal.fire({
        icon: icon_alert,
        title: icon_alert.charAt(0).toUpperCase() + icon_alert.slice(1),
        text: text_modal,
        footer: ''
      });

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