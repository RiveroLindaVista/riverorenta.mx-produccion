
<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$leadId = (string) ($_GET['id'] ?? '');

if ($leadId === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Falta el ID del Lead']);
    exit;
}

// =====================================
// CONSULTAR LEAD
// =====================================

$query = [
    "select" => "Id,Name,Email,MobilePhone,Owner.Name,Agencia_Nombre__c,Como_se_entero_de_nosotros__c,NombreProduct__c,Auto_a_cuenta__c,Para_quien_es__c,Plandeinteres__c,Plan_Precio__c,Plan_Enganche__c,Plan_Mensualidad__c,Plan_Plazo__c,Comentarios__c,Credito_o_Contado__c",
    "where" => "Id = '$leadId'",
    "table" => "Lead",
    "limit" => "5000",
    "offset" => "0"
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/datalake/chevrolet/query',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS => json_encode($query),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json']
]);

$responseRaw = curl_exec($curl);

if (curl_errno($curl)) {
    http_response_code(500);
    echo json_encode(['error' => curl_error($curl)]);
    curl_close($curl);
    exit;
}

curl_close($curl);

$responseLead = json_decode($responseRaw, true);

$rows = $responseLead['data']['response']
    ?? $responseLead['data']
    ?? $responseLead['response']
    ?? $responseLead;

$lead = (isset($rows[0]) && is_array($rows[0]))
    ? $rows[0]
    : $rows;

if (!is_array($lead) || empty($lead['Id'])) {
    http_response_code(404);
    echo json_encode(['error' => 'No se encontró el Lead']);
    exit;
}

// =====================================
// CONSULTAR QR
// =====================================

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/salesforce/qr-send-greeter-chevrolet/' . urlencode($leadId),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => 'GET'
]);

$responseQR = curl_exec($curl);
$httpCodeQR = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if (curl_errno($curl)) {
    http_response_code(500);
    echo json_encode(['error' => curl_error($curl)]);
    curl_close($curl);
    exit;
}

curl_close($curl);

$qr = json_decode($responseQR, true);

// =====================================
// RESPUESTA PARA REACT
// =====================================

echo json_encode([
    'lead' => $lead,
    'qr' => $qr,
    'qr_http_code' => $httpCodeQR
], JSON_UNESCAPED_UNICODE);

