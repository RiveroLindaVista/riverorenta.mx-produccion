<?php
session_start();
$username=$_POST['username'];
$password=$_POST['password'];


if ($username=="DESARROLLO" && $password=='todopoderoso') {
	$_SESSION["usuario"]  = 'DESARROLLO';
	 echo 1;
}else if ($username=="MARKETING" && $password=='riveromkt') {
	$_SESSION['usuario'] = 'MARKETING';
	echo 1;
}else if ($username=="TALLER" && $password=='riveroaccesorios') {
	$_SESSION['usuario'] = 'TALLER';
	echo 1;
}else{
	echo 0;

}
?>