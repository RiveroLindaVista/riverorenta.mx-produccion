<?php

session_start();
$accesos=explode(",", $_SESSION["acceso"]);

// CONTROL
if ($_SERVER["SCRIPT_NAME"]==="/control/index.php") {
    if(!in_array("CONTROL",$accesos)){
        header("Location: /");
    }
}
// PROGRAMACION
if ($_SERVER["SCRIPT_NAME"]==="/rutas/index.php") {
    if(!in_array("RUTAS",$accesos)){
        header("Location: /");
    }
}
// AUSTES DE PROGRAMACION
if ($_SERVER["SCRIPT_NAME"]==="/supervisor/index.php") {
    if(!in_array("SUPERVISOR",$accesos)){
        header("Location: /");
    }
}
// PLANTAS
if ($_SERVER["SCRIPT_NAME"]==="/plantas/index.php") {
    if(!in_array("PLANTAS",$accesos)){
        header("Location: /");
    }
}
// CROQUIS
if ($_SERVER["SCRIPT_NAME"]==="/croquis/index.php") {
    if(!in_array("CROQUIS",$accesos)){
        header("Location: /");
    }
}
// PROGRAMACION
if ($_SERVER["SCRIPT_NAME"]==="/control-panorama/index.php") {
    if(!in_array("CONTROL FACTURAS",$accesos)){
        header("Location: /");
    }
}
// PROGRAMACION
if ($_SERVER["SCRIPT_NAME"]==="/visualizador-atencion-clientes/index.php") {
    if(!in_array("VISUALIZADOR ATENCIONCLIENTES",$accesos)){
        header("Location: /");
    }
}

// UNIDADES ASIGNADAS
if ($_SERVER["SCRIPT_NAME"]==="/unidades-asignadas/index.php") {
    if(!in_array("LOGISTICA",$accesos)){
        header("Location: /");
    }
}
// AUNIDADES EN PLANTA
if ($_SERVER["SCRIPT_NAME"]==="/unidades-en-planta/index.php") {
    if(!in_array("LOGISTICA",$accesos)){
        header("Location: /");
    }
}
// SERVICIO DE PLANTAS
if ($_SERVER["SCRIPT_NAME"]==="/servicio-plantas/index.php") {
    if(!in_array("LOGISTICA",$accesos)){
        header("Location: /");
    }
}
// DISPONIBILIDAD
if ($_SERVER["SCRIPT_NAME"]==="/disponibilidad-unidades/index.php") {
    if(!in_array("LOGISTICA",$accesos)){
        header("Location: /");
    }
}

// REPORTE RUTAS GPS
if ($_SERVER["SCRIPT_NAME"]==="/reporte-rutas-gps/index.php") {
    if(!in_array("CONTROL",$accesos)){
        header("Location: /");
    }
}
// PANORAMA
if ($_SERVER["SCRIPT_NAME"]==="/panorama/index.php") {
    if(!in_array("PANORAMA",$accesos)){
        header("Location: /");
    }
}
// SEMAFORO
if ($_SERVER["SCRIPT_NAME"]==="/semaforo/index.php") {
    if(!in_array("SEMAFORO",$accesos)){
        header("Location: /");
    }
}
// RESUMEN EJECUTADO
if ($_SERVER["SCRIPT_NAME"]==="/resumen-ejecutado/index.php") {
    if(!in_array("RESUMEN EJECUTADO",$accesos)){
        header("Location: /");
    }
}
// CRONOGRAMA
if ($_SERVER["SCRIPT_NAME"]==="/cronograma/index.php") {
    if(!in_array("CRONOGRAMA",$accesos)){
        header("Location: /");
    }
}
if ($_SERVER["SCRIPT_NAME"]==="/cronograma-unidades/index.php") {
    if(!in_array("CRONOGRAMA",$accesos)){
        header("Location: /");
    }
}
// NOMINA
if ($_SERVER["SCRIPT_NAME"]==="/nominas/index.php") {
    if(!in_array("NOMINA",$accesos)){
        header("Location: /");
    }
}
// SEGUIMIENTO INCIDENCIAS
if ($_SERVER["SCRIPT_NAME"]==="/seguimiento-incidencias/index.php") {
    if(!in_array("SEGUIMIENTO INCIDENCIAS",$accesos)){
        header("Location: /");
    }
}
// REPORTE DISEL
if ($_SERVER["SCRIPT_NAME"]==="/cargas-consumo/index.php") {
    if(!in_array("REPORTE DIESEL",$accesos)){
        header("Location: /");
    }
}
if ($_SERVER["SCRIPT_NAME"]==="/cronograma-unidades/index.php") {
    if(!in_array("REPORTE DIESEL",$accesos)){
        header("Location: /");
    }
}
// REPORTE APP OPERADOR
if ($_SERVER["SCRIPT_NAME"]==="/reporte-app-operador/index.php") {
    if(!in_array("APPOPERADOR",$accesos)){
        header("Location: /");
    }
}
// FACTURACION
if ($_SERVER["SCRIPT_NAME"]==="/facturacion/index.php") {
    if(!in_array("FACTURACION",$accesos)){
        header("Location: /");
    }
}


// ESCUELA
if ($_SERVER["SCRIPT_NAME"]==="/escuela/index.php") {
    if(!in_array("ESCUELA",$accesos)){
        header("Location: /");
    }
}
// SOLICITUD EMPLEO
if ($_SERVER["SCRIPT_NAME"]==="/solicitud/index.php") {
    if(!in_array("SOLICITUD EMPLEO",$accesos)){
        header("Location: /");
    }
}

// OPERADORES
if ($_SERVER["SCRIPT_NAME"]==="/operarios/index.php") {
    if(!in_array("OPERARIOS",$accesos)){
        header("Location: /");
    }
}
// ASIGNAR OPERADOR
if ($_SERVER["SCRIPT_NAME"]==="/asignar-operador/index.php") {
    if(!in_array("ASIGNAR OPERADOR",$accesos)){
        header("Location: /");
    }
}
// FACTURACON COSTOS
if ($_SERVER["SCRIPT_NAME"]==="/facturacion-costos/index.php") {
    if(!in_array("FACTURACION COSTOS",$accesos)){
        header("Location: /");
    }
}
// UNIDADES
if ($_SERVER["SCRIPT_NAME"]==="/unidades/index.php") {
    if(!in_array("UNIDADES",$accesos)){
        header("Location: /");
    }
}
// UNIDADES
if ($_SERVER["SCRIPT_NAME"]==="/unidadesVdiesel/index.php") {
    if(!in_array("UNIDADESvDIESEL",$accesos)){
        header("Location: /");
    }
}
// INCIDENCIAS
if ($_SERVER["SCRIPT_NAME"]==="/incidencias/index.php") {
    if(!in_array("INCIDENCIAS",$accesos)){
        header("Location: /");
    }
}
// USUARIOS
if ($_SERVER["SCRIPT_NAME"]==="/usuarios/index.php") {
    if(!in_array("USUARIOS",$accesos)){
        header("Location: /");
    }
}
