<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.gruporivero.com/v1/quotations/'.$_POST["id"],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PATCH',
  CURLOPT_POSTFIELDS =>'{
"car_id": '.$_POST["car_id"].',
"entry_percentage": '.$_POST["entry_percentage"].',
"months": '.$_POST["months"].',
"warraty_id": '.$_POST["warraty_id"].'
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: XSRF-TOKEN=eyJpdiI6ImtJeHBPdEdpZXpJY1lxVFU4THd6eUE9PSIsInZhbHVlIjoid2hDSWdnR2ErVER3RkN3SENEYyt0eEd5ZjJydmpYNFMvK2EveEJjVHo5dllNYWRJallWcEQwM3dhOUd3d0tYd20xZ3pVQmxzMWFzYkovTFNvcHNncDJPSHM3Y3oycHBUVnYrakFyUHlQQnI4RVRNT0hpdnl1ZGR4WkluT2RpV1MiLCJtYWMiOiJkZDdhYTkxN2NkMzM4MmQ3ZWUwNmZlMjdmZDk5ZWM1ODYxMTZjNzM5Mzg5MmE3YjJkZWVmOGY3YTlhODQyNDEwIn0%3D; rivero_session=eyJpdiI6IllVRnIrYk0wMi9oLy9VZGdLVjVpM0E9PSIsInZhbHVlIjoiV0taT0xXUkpHWnJSSmpXWjFOd1JGRmMrQW1IMVZTdGJjVTh1R2tXeXljbklsL0RXeFB4cnhEOGJLNUJGTjhLdDBQcGRiQUgrQ3RTeGhhQkplT1JQbmZxM3UrUW03QTdCUGoweEtSMk1USmtSd2VFUndlZEFHd2t1bnp4WE5icG0iLCJtYWMiOiJkZjVhNDViNGMxMjAxM2UyZDFlMjZjMmNhMzA1OTZjNDBiN2MwOTcwOWRmOTI2NDA2ODFlZjNlN2NmN2IwYWQ2In0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>