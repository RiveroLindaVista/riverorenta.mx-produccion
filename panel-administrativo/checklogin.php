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
}else{
	echo 0;

}
?>