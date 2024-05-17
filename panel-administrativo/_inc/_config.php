<?php
session_start();

if($_SESSION["paginaOrigen"]==""){
	$_SESSION["paginaOrigen"]='https://www.riverorenta.mx/gruporivero/';
}

DEFINE("URL",'https://'.$_SERVER['HTTP_HOST']);
DEFINE("URLSeminuevos",'https://www.riverorenta.mx/seminuevos');

DEFINE("DB_HOST",'3.132.169.146');
//DEFINE("DB_HOST",'ftp.gruporivero.com.mx');
DEFINE("DB_USER",'riverore_gr');
DEFINE("DB_PASSWORD",'Paramore99!');
DEFINE("DB_DB",'riverorenta_grupormx_exp');

/*IVA*/
DEFINE("precio_iva","1.16");
/*PLACAS*/
DEFINE("placas","4000.00");
DEFINE("placas_gestoria","750.00");
DEFINE("placas_total",placas+placas_gestoria);

/*CORREOS*/
DEFINE("correoE","ecasas@gruporivero.com");
DEFINE("correoH","hsoto@gruporivero.com");
DEFINE("correoServicios","servicio@gruporivero.com, ventas@gruporivero.com, fgarcia@gruporivero.com, bshernandez@gruporivero.com, tmartinez@gruporivero.com, asalazar@gruporivero.com");
DEFINE("correoColision","ventas@gruporivero.com , informes@gruporivero.com");
DEFINE("correoTransportes","ventas@gruporivero.com,  transportes@gruporivero.com");

DEFINE("correoFlotillas","fleet@gruporivero.com");
DEFINE("correoVentas","ventas@gruporivero.com");


DEFINE("reservar",'5000');

/*NUEVOS*/
DEFINE("interes_60_meses","16.54");
DEFINE("interes_48_meses","15.54");
DEFINE("interes_36_meses","15.54");
DEFINE("interes_24_meses","15.54");
DEFINE("interes_12_meses","15.54");

//seminuevos mayor igual del 2017
//con 10%
DEFINE("seminuevos_11_12_meses","17.69");
DEFINE("seminuevos_11_24_meses","17.79");
DEFINE("seminuevos_11_36_meses","17.89");
DEFINE("seminuevos_11_48_meses","17.99");
DEFINE("seminuevos_11_60_meses","18.89");

//con 20%
DEFINE("seminuevos_12_12_meses","16.69");
DEFINE("seminuevos_12_24_meses","16.79");
DEFINE("seminuevos_12_36_meses","16.89");
DEFINE("seminuevos_12_48_meses","16.99");
DEFINE("seminuevos_12_60_meses","17.49");

//con +30%
DEFINE("seminuevos_13_12_meses","15.99");
DEFINE("seminuevos_13_24_meses","16.19");
DEFINE("seminuevos_13_36_meses","16.39");
DEFINE("seminuevos_13_48_meses","16.59");
DEFINE("seminuevos_13_60_meses","16.79");

//seminuevos mayor del 2013
//con 20%
DEFINE("seminuevos_22_12_meses","17.69");
DEFINE("seminuevos_22_24_meses","17.79");
DEFINE("seminuevos_22_36_meses","17.89");
DEFINE("seminuevos_22_48_meses","17.99");


//con 30%
DEFINE("seminuevos_23_12_meses","16.99");
DEFINE("seminuevos_23_24_meses","17.19");
DEFINE("seminuevos_23_36_meses","17.39");
DEFINE("seminuevos_23_48_meses","17.49");

//seminuevos menor o igual del 2013

//con 30%
DEFINE("seminuevos_33_12_meses","16.99");
DEFINE("seminuevos_33_24_meses","17.19");

//seminuevos menores o igual del 2011
//con 30%
DEFINE("seminuevos_43_12_meses","16.99");

/*if(!isset($_SESSION["cotizador"])){

	$_SESSION["cotizador"]["enganche"] = "10";
	$_SESSION["cotizador"]["meses"] = "60";
	$_SESSION["cotizador"]["condicion"] = "CRÉDITO";
	$_SESSION["cotizador"]["precioauto"] = "";
	echo '<script>console.log("Carga sesion inicial");</script>';
}*/
DEFINE("URLP",'https://'.$_SERVER['HTTP_HOST'].'/produccion/panel-administrativo/');
?>