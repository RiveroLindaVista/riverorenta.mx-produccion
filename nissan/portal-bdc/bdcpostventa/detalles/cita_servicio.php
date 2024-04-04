<form>

  <div class="row mb-2">
    <div class="col-12 col-md-6">
       <div class="form-group">
        <label for="MedioContacto">Medio de Contacto</label>
        <select class="form-select" id="medioContacto">
          <option>Correo</option>
          <option>Llamada</option>
          <option selected>WhatsApp</option>
        </select>
      </div>
    </div>

     <div class="col-12 col-md-6">
       <div class="form-group">
        <label for="tipoCita">Tipo de Cita</label>
        <select class="form-select" id="tipoCita">
          <option value="Entrante">Entrante</option>
          <option value="Ret2Anos">Ret 2 Años</option>
          <option value="Proxima Visita">Próxima Visita</option>
          <option value="Campana">Campaña</option>
        </select>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-12 col-md-6">
       <div class="form-group">
        <label for="Promocion">Promoción</label>
        <select class="form-select" id="promocion">
          <option>Mantenimiento</option>
          <option>Mtto y Falla</option>
          <option>Reparación</option>
          <option>Retorno</option>
        </select>
      </div>
    </div>

     <div class="col-12 col-md-6">
       <div class="form-group">
        <label for="tipoServicio">Tipo de Servicio</label>
        <select class="form-select" id="tipoServicio">
          <option>Sucursal</option>
          <option>Domicilio</option>
        </select>
      </div>
    </div>
  </div>


  <div class="row mb-2">
    <div class="col-12 col-md-6">
       <div class="form-group">
        <label for="Sucursal">Sucursal</label>
        <select class="form-select" id="sucursal">
          <option value="1043194" selected>Contry</option>
          <option value="279130042">Las Torres</option>
          <option value="599457775">Valles</option>
        </select>
      </div>
    </div>

     <div class="col-12 col-md-6">
       <div class="form-group">
        <label for="fechaCita">Fecha de Cita</label>
        <input id="fechaCita" class="form-control" type="date" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>"/>
      </div>
    </div>
  </div>


  <div class="row mb-2">
    <div class="col-12">
       <div class="form-group">
        <label for="Horarios">Horarios</label>
        <select class="form-select" id="horarios">
          <option value="07:00" selected>7:00</option>
          <option value="07:30">7:30</option>
          <option value="08:00">8:00</option>
        </select>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-12">
       <div class="form-group">
        <label for="Comentarios">Comentarios</label>
        <textarea id="comentarios" class="form-control"></textarea>
      </div>
    </div>
  </div>

<br/>
  <button type="submit" class="btn btn-primary float-right">Enviar</button>
</form>