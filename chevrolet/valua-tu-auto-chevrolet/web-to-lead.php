<?php
if($_POST["udid"]=="0"){
	$_POST["udid"]="gruporivero.com";
}
if($_POST["cid"]=="0"){
	$_POST["cid"]="7012S000000Gj6pQAC";
}
$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';


$myvars = 'oid=00Df4000004ls8N'.
'&debug=0'.
'&debugEmail=ecasas@gruporivero.com'.
'&lead_source=Web'.
'&00Nf400000UBhZw=Valuacion'.
'&recordType=0122S000000DM0N'.
'&00Nf400000UBhYt=1043193'.
'&url=https://gruporivero.com/valua-tu-carro'.
'&00N2S000007ThUK=https://gruporivero.com/valua-tu-carro'.
'&00Nf400000UBhZl=WhatsApp'.
'&00Nf400000UBhZ6=chevroletrivero.com'.
'&first_name='.$_POST["nombre"].
'&last_name=-'.
'&email='.$_POST["correo"].
'&00Nf400000UBha3='.$_POST["telefono"].
'&00Nf400000UBhYw='.$_POST["year"].
'&00Nf400000UBhZb='.$_POST["modelo"].
'&00Nf400000UBhZZ='.$_POST["marca"].
'&00Nf400000UBhZW='.$_POST["kilometraje"].
'&00Nf400000UBha0='.$_POST["ofrecido"].
'&00N2S000006mGAe='.$_POST["compra"].
'&00N2S000006mGAj='.$_POST["venta"].
'&00N2S000006mGzD='.$_POST["version"].
'&Campaign_ID=7012S000000Gj6pQAC'.
'&GRI_Campana__c=7012S000000Gj6pQAC';

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );

?>