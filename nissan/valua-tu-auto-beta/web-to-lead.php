<?php
if($_POST["udid"]=="0"){
	$_POST["udid"]="gruporivero.com";
}
if($_POST["cid"]=="0"){
	$_POST["cid"]="7012S000000Gj6pQAC";
}
$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';


$myvars = 'oid=00DHp000005bwkK'.
'&debug=0'.
'&debugEmail=ecasas@gruporivero.com'.
'&lead_source=Web'.
'&00NVn000004l0bl=Valuacion'.
'&recordType=012Hp000001hzNKIAY'.
'&00NHp0000194HUD=1043194'.
'&url=https://nissanrivero.com/valua-tu-carro/'.
'&Website=https://nissanrivero.com/valua-tu-carro/'.
'&00NHp0000194HWT=WhatsApp'.
'&00NHp0000194HUw=nissanrivero.com'.
'&first_name='.$_POST["nombre"].
'&last_name=-'.
'&email='.$_POST["correo"].
'&00NVn000002wSM9='.$_POST["telefono"].
'&00NVn000004l14n='.$_POST["year"].
'&00NVn000004kxRG='.$_POST["modelo"].
'&00NVn000004kylF='.$_POST["marca"].
'&00NVn000004kzJ7='.$_POST["kilometraje"].
'&00NVn000004kzar='.$_POST["ofrecido"].
'&00NVn000004kwvA='.$_POST["compra"].
'&00NVn000004kzvp='.$_POST["venta"].
'&00NVn000004kzz3='.$_POST["version"].
'&Campaign_ID=701Vn00000HA7g0IAD'.
'&GRI_Campana__c=701Vn00000HA7g0IAD';

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );

?>