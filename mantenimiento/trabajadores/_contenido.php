<?php
  session_start();
  require_once("../commun/_config.php");
  require_once("../_classes/_conne.php");
  require_once("../_classes/classes.php");
  require_once("../commun/_config.php");
  $consultas=new Consultas();

  $trabajadores=$consultas->get_trabajadores();
  $solicitudes=$consultas->get_trabajadores_join();

  foreach ($solicitudes as $key => $value) {
    $Array[$value["nombre"]]=[$value["solicitudes"]];
  }

  foreach ($trabajadores as $key => $value) {
    $params=base64_encode(json_encode($value));
    $tablaTrabajadores.= '<tr>
    <td>'.$value["nombre"].'</td>
    <td>'.$value["usuario"].'</td>';

    if ($Array[$value["nombre"]][0] == ""){
      $tablaTrabajadores.= '<td>0</td>';
    } else {
      $tablaTrabajadores.= '<td>'.$Array[$value["nombre"]][0].'</td>';
    }

    $tablaTrabajadores.= 
    '<td>
    <button class="btn bg-success text-white mr-2" onclick="verAccesos(\''.$params.'\')">Ver Accesos</button>
    <button class="btn bg-danger text-white mr-2" onclick="deleteUser(\''.$value["id"].'\')">Eliminar</button>
    </td>
    </tr>';
  }
?>

<div class=" container-fluid">
  <h1><i class="fa fa-user" aria-hidden="true"></i> Personal</h1>
  <!-- DataTables Examplee -->
  <div class="card shadow mb-4  d-md-block d-sm-none d-none">
      <div class="card-body">
          <table class="table-sm table-bordered table-hover" id="tablaSuper" width="100%" data-toggle="table" cellspacing="0">
              <thead class="bg-secondary text-white text-center ">
                <tr><th colspan="4" style="background-color:#BAF3C3;"><button class="btn bg-success text-white mr-2" onclick="addUser()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar </button></th></tr>
                <tr>
                  <th class="p-2">Nombre</th>
                  <th class="p-2">Usuario</th>
                  <th class="p-2">Solicitudes</th>
                  <th class="p-2">Opciones</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?=$tablaTrabajadores;?>
              </tbody>
          </table>
      </div>
  </div>

</div>

<!-- Modal Accesos -->
<div class="modal fade" id="accessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatTitulo">Accesos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <div>
        <div class="form-group">
          <label> Usuario: </label>
          <p class="usuario" id="usuario"></p>
          <input type="text" id="idUser" name="idUser" hidden/>
        </div>
        <div class="form-group">
          <label> Contraseña: </label><br/>
          <input type="text" class="password mr-2" id="password" onchange="hiddeBtn()" onkeydown="hiddeBtn()"/><button id="savePass" style="visibility:hidden;height: 20px;font-size:9px;width:20px;" type="button" class="btn btn-success p-0" onclick="savePass()"><i class="fa fa-check" aria-hidden="true"></i></button>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Nuevo Usuario -->
<div class="modal fade" id="nuevoUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatTitulo">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <div>
        <div class="mb-1">
          <label> Nombre Usuario: </label><br/>
          <input class="form-control" type="text" id="Nnombre"/>
        </div>
        <div class="mb-1">
          <label> Usuario (Correo electrónico): </label>
          <input class="form-control" type="text" id="Nusuario"/>
        </div>
        <div class="mb-1">
          <label> Rol: </label>
          <select id="rol" class="form-control mb-2" name="rol" onchange="checkRol()" required>
            <option value="TRABAJADOR">Trabajador</option>
            <option value="GERENTE">Gerente</option>
          </select>

          <select id="sucursal" class="form-control" name="sucursal" style="visibility:hidden">
            <option value="0">Elige una sucursal...</option>
            <option value="LINDA VISTA">LINDA VISTA</option>
            <option value="GUADALUPE">GUADALUPE</option>
            <option value="HUMBERTO LOBO">HUMBERTO LOBO</option>
            <option value="SANTA CATARINA">SANTA CATARINA</option>
            <option value="HUMBERTO LOBO">HUMBERTO LOBO ALIANZA</option>
            <option value="GOMEZ MORIN">GOMEZ MORIN</option>
          </select>

          <select id="departamento" class="form-control" name="departamento" style="visibility:hidden">
            <option value="0">Elige una departamento...</option>
            <option value="LINDA VISTA">LINDA VISTA</option>
            <option value="GUADALUPE">GUADALUPE</option>
            <option value="HUMBERTO LOBO">HUMBERTO LOBO</option>
            <option value="SANTA CATARINA">SANTA CATARINA</option>
            <option value="HUMBERTO LOBO">HUMBERTO LOBO ALIANZA</option>
            <option value="GOMEZ MORIN">GOMEZ MORIN</option>
          </select>

        </div>
        <div class="mb-1">
          <label> Contraseña: </label><br/>
          <input class="form-control" type="text" class="password mr-2" id="Npassword" onchange="showBtn()" onkeydown="showBtn()"/>
        </div>
        <div class="mt-1 d-flex justify-content-center">
          <button id="saveUser" style="visibility:hidden;" type="button" class="btn btn-success" onclick="saveUser()">CREAR</button>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function verAccesos($param){
    document.getElementById('savePass').style.visibility = "hidden";
    $parametros=window.atob($param);
    $parametros=JSON.parse($parametros);

    $("#usuario").html($parametros["usuario"]);
    $("#idUser").val($parametros["id"]);
    $("#password").val($parametros["password"]);

    $("#accessModal").modal('show');
  }

  function addUser(){
    $("#nuevoUserModal").modal('show');
  }

  function hiddeBtn(){
    document.getElementById('savePass').style.visibility = "visible";
  }

  function showBtn(){
    document.getElementById('saveUser').style.visibility = "visible";
  }

  function savePass(){
    var pass = document.getElementById('password').value;
    var id = document.getElementById('idUser').value;

    let params = {
      id: id,
      password: pass,
      func: "change_password"
    };

    $.ajax({
        url: "../home/funciones.php",
        method: "POST",
        data: params,
        dataType: "json",
        success: function (resp) {
          location.reload();
        }
    });
    
  }

  function checkRol(){
    var rol = document.getElementById('rol').value;
    console.log(rol, "ROL");

    if (rol =="GERENTE"){
      document.getElementById('sucursal').style.visibility = "visible";
      document.getElementById('departamento').style.visibility = "visible";
    } else {
      $("#sucursal").val(0);
      document.getElementById('sucursal').style.visibility = "hidden";
      $("#departamento").val(0);
      document.getElementById('departamento').style.visibility = "hidden";
    }

  }

  function saveUser(){
    var pass = document.getElementById('Npassword').value;
    var nombre = document.getElementById('Nnombre').value;
    var usuario = document.getElementById('Nusuario').value;
    var rol = document.getElementById('rol').value;
    var sucursal = document.getElementById('sucursal').value;
    var departamento = document.getElementById('departamento').value;

    if (pass != "" || nombre != "" || usuario != "" || rol != "" ) {
      
      let params = {
        nombre: nombre,
        usuario: usuario,
        rol: rol,
        password: pass,
        sucursal:sucursal,
        departamento:departamento,
        func: "crear_usuario"
      };

      console.log(params);

      $.ajax({
          url: "../home/funciones.php",
          method: "POST",
          data: params,
          dataType: "json",
          success: function (resp) {
            console.log(resp);
            if (resp == 1){
              location.reload();
            } else {
              alert(resp);
            }
          }
      });
    } else {
      alert ('Debe llenar todos los campos para completar el alta de usuario.')
    }
}

  function deleteUser(id){

    let params = {
      id: id,
      func: "eliminar_usuario"
    };

    $.ajax({
        url: "../home/funciones.php",
        method: "POST",
        data: params,
        dataType: "json",
        success: function (resp) {
          location.reload();
        }
    });
    
  }
</script>
