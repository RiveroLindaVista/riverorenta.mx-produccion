<?php
session_start();
$username=$_POST['username'];
$password=$_POST['password'];


if ($username=="DESARROLLO" && $password==='todopoderoso') {
	$_SESSION["usuario"]  = 'DESARROLLO';
	 echo 'DESARROLLO';
}else if ($username=="MARKETING" && $password==='riveromkt') {
	$_SESSION['usuario'] = 'MARKETING';
	echo 'MARKETING';
}else if ($username=="TALLER" && $password==='riveroaccesorios') {
	$_SESSION['usuario'] = 'TALLER';
	echo 'TALLER';
}else if ($username=="POLITICAS" && $password==='politicas') {
	$_SESSION['usuario'] = 'POLITICAS';
	echo 'POLITICAS';
}else if ($username=="MKT.DASHBOARD" && $password==='mkt.dashboard') {
	$_SESSION['usuario'] = 'MKT.DASHBOARD';
	echo 'MKT.DASHBOARD';
}else if ($username=="VALUACION" && $password==='rivero.valuacion') {
	$_SESSION['usuario'] = 'VALUACION';
	echo 'VALUACION';
}else{
	echo 0;

}
?>