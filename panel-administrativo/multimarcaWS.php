<?php
/**
 * 
 */
class multimarca_ws
{

	public static $ip_server = 'http://137.116.44.184:30021';
	public static $ws_key = 'GM0019623';
	public static $public_key = 'ARsARgAAAAAAAADb9iBm16Magkg+f02f8cQ3+HXk9bHuKJNSTHdYWQlsHNIsxdro+F7ngMRCQw75JP2xCC0VGPS02grRzvASaWVtdaiNvkAnPob+naZj/SM4MeZfHYeN18IYbZ7tyAa247I=';
	
	
	 function login($ws_key, $public_key, $ip_server){
		try {
			$licencing = array(
				"login" => [
					"licencing" => [
						"ws_key" => $ws_key,
						"id_empresa" => 1043193,
						"caducidad" => "6",
						"llave_publica" => $public_key
						]
				]
			);
			$ws = new multimarca_ws();
			$login = $ws->post($ip_server.'/wsLicencing/open_anom?tipo=dealer', json_encode($licencing));

			return $login;
			
		} catch (Exception $e) {
			echo $e;
		}
	}

	function get_clientes($ip_server, $select, $where, $ws_key){
		try {


			$ws = new multimarca_ws();
			$clientes = $ws->get($ip_server.'/apiW32/clientes/'.base64_encode($select).'/'.base64_encode($where), $ws_key);

			return $clientes;
			
		} catch (Exception $e) {
			echo $e;
		}
	}

	function post($url, $fields_string, $jwt = null)
    {
        //open connection
        $ch = curl_init();

        $http_header = array(
            'Content-Type: application/json',       
        );

        /*if (isset($jwt)) {
            $http_header[] = 'Authorization: Bearer '.$jwt;
        }*/

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, strlen($fields_string));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);      

        //execute post
        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //close connection
        curl_close($ch);

        return array('code' => $code, 'result' => json_decode($result));
    }

    public static function get($url, $ws_key)
    {
        //open connection
        $ch = curl_init();

        $http_header = array(
            'Content-Type: application/json; charset=UTF-8',
            'Authentication: '.$ws_key,          
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //execute post
        $result = curl_exec($ch);

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //close connection
        curl_close($ch);

         return array('code' => $code, 'result' => json_decode($result));
    }
}
?> 
