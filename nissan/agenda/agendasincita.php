<?php
declare(strict_types=1);

/*
 * NISSAN RIVERO - CONSULTA QR
 *
 * Requisitos: PHP 8.2+, extensión cURL y HTTPS.
 *
 * Configurar en el servidor:
 * SF_CLIENT_ID       = Client ID de Salesforce
 * SF_CLIENT_SECRET   = Client Secret de Salesforce
 * QR_SIGNING_SECRET  = clave aleatoria de mínimo 32 caracteres
 * APP_BASE_URL       = https://dominio.mx/consulta.php
 *
 * Las credenciales pertenecen a una External Client App
 * con OAuth Client Credentials y usuario de solo lectura.
 *
 * Para generar el enlace del QR desde el servidor:
 * php consulta.php emitir 00QVn00000mRRq5MAG
 *
 * El QR debe contener el enlace firmado generado.
 * El ID del Lead por sí solo NO autoriza la consulta.
 *
 * Este código únicamente CONSULTA. No convierte Leads.
 */

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, max-age=0');
header('Pragma: no-cache');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header('X-Robots-Tag: noindex, nofollow, noarchive');

const SF_BASE = 'https://nissanrivero.my.salesforce.com';
const API_VERSION = 'v68.0';
const TIMEZONE = 'America/Monterrey';

function config(string $key): string {
    $value = getenv($key);

    if ($value === false || $value === '') {
        throw new RuntimeException(
            'Falta configuración: ' . $key
        );
    }

    return $value;
}

function validoLead(string $id): bool {
    return (bool) preg_match(
        '/^00Q[A-Za-z0-9]{12}(?:[A-Za-z0-9]{3})?$/D',
        $id
    );
}

function firmado(string $id): string {
    $key = config('QR_SIGNING_SECRET');

    if (strlen($key) < 32) {
        throw new RuntimeException(
            'La clave de firma debe tener mínimo 32 caracteres.'
        );
    }

    return hash_hmac('sha256', $id, $key);
}

function pedir(
    string $url,
    array $headers = [],
    ?array $post = null
): array {

    $ch = curl_init($url);

    if ($ch === false) {
        throw new RuntimeException('Error iniciando cURL.');
    }

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTPHEADER => $headers
    ]);

    if ($post !== null) {
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            http_build_query(
                $post,
                '',
                '&',
                PHP_QUERY_RFC3986
            )
        );
    }

    $raw = curl_exec($ch);
    $status = (int) curl_getinfo(
        $ch,
        CURLINFO_RESPONSE_CODE
    );

    curl_close($ch);

    if ($raw === false || $status < 200 || $status >= 300) {
        throw new RuntimeException(
            'Error Salesforce HTTP ' . $status
        );
    }

    $data = json_decode($raw, true);

    if (!is_array($data)) {
        throw new RuntimeException(
            'Respuesta JSON inválida.'
        );
    }

    return $data;
}

/*
 * AUTENTICACIÓN SALESFORCE
 */

function accesoSalesforce(): string {

    $oauth = pedir(
        SF_BASE . '/services/oauth2/token',
        [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json'
        ],
        [
            'grant_type' => 'client_credentials',
            'client_id' => config('SF_CLIENT_ID'),
            'client_secret' => config('SF_CLIENT_SECRET')
        ]
    );

    if (empty($oauth['access_token'])) {
        throw new RuntimeException(
            'Salesforce no devolvió access_token.'
        );
    }

    $expected = strtolower(
        (string) parse_url(SF_BASE, PHP_URL_HOST)
    );

    $actual = strtolower(
        (string) parse_url(
            (string) ($oauth['instance_url'] ?? ''),
            PHP_URL_HOST
        )
    );

    if ($expected !== $actual) {
        throw new RuntimeException(
            'La conexión OAuth no corresponde a Nissan.'
        );
    }

    return (string) $oauth['access_token'];
}

/*
 * CONSULTA SOQL
 */

function consulta(string $token, string $soql): ?array {

    $url = SF_BASE .
        '/services/data/' .
        API_VERSION .
        '/query?' .
        http_build_query(
            ['q' => $soql],
            '',
            '&',
            PHP_QUERY_RFC3986
        );

    $respuesta = pedir($url, [
        'Authorization: Bearer ' . $token,
        'Accept: application/json'
    ]);

    return $respuesta['records'][0] ?? null;
}


function registrarPrimeraAtencion(
    string $token,
    string $oppId,
    ?string $fechaExistente
): ?string {

    // Si ya fue atendido, conservar la fecha original.
    if (!empty($fechaExistente)) {
        return $fechaExistente;
    }

    // Fecha y hora actual en UTC.
    $fecha = gmdate('Y-m-d\TH:i:s\Z');

    $url = SF_BASE .
        '/services/data/' .
        API_VERSION .
        '/sobjects/Opportunity/' .
        rawurlencode($oppId);

    $datos = json_encode([
        'Fecha_y_Hora_Atendido__c' => $fecha
    ], JSON_THROW_ON_ERROR);

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST => 'PATCH',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Accept: application/json'
        ],
        CURLOPT_POSTFIELDS => $datos
    ]);

    $respuesta = curl_exec($ch);

    $codigo = (int) curl_getinfo(
        $ch,
        CURLINFO_RESPONSE_CODE
    );

    curl_close($ch);

    // Salesforce responde 204 al actualizar correctamente.
    if ($respuesta === false || $codigo !== 204) {
        throw new RuntimeException(
            'No se pudo registrar la primera atención. HTTP ' .
            $codigo
        );
    }

    return $fecha;
}



/*
 * DIRECCIONES DE VENTAS NISSAN
 */

function agencia(?string $punto): array {

    $valor = strtolower(trim($punto ?? ''));

    $valor = strtr($valor, [
        'á' => 'a',
        'é' => 'e',
        'í' => 'i',
        'ó' => 'o',
        'ú' => 'u'
    ]);

    $valor = preg_replace(
        '/^nissan rivero\s+/u',
        '',
        $valor
    ) ?? $valor;

    $valor = preg_replace(
        '/\s+/u',
        ' ',
        $valor
    ) ?? $valor;

    if ($valor === 'soriana la pastora') {
        $valor = 'la pastora';
    }

    if ($valor === 'alfonso reyes') {
        $valor = 'invernadero';
    }

    $catalogo = [
        'valle oriente' => [
            'Valle Oriente',
            'Av. Lázaro Cárdenas 2514, San Pedro Garza García, Nuevo León 66200'
        ],
        'contry' => [
            'Contry',
            'Av. Eugenio Garza Sada 3800, Mas Palomas (Valle de Santiago), Monterrey, Nuevo León 64780'
        ],
        'valle' => [
            'Valle',
            'Calzada Del Valle 110, Col Del Valle, San Pedro Garza García, Nuevo León 66220'
        ],
        'plaza alquimia' => [
            'Plaza Alquimia',
            'Carr Nacional Km. 262, El Barro, Sin Nombre de Col 52, 64997 Monterrey, N.L.'
        ],
        'la pastora' => [
            'La Pastora',
            'Av Eloy Cavazos 2000-6to Sector, Contry Sol, 67145 Guadalupe, N.L.'
        ],
        'invernadero' => [
            'Invernadero',
            'Av. Alfonso Reyes, Alta Vista Invernadero, 64740 Monterrey, N.L.'
        ]
    ];

    [$nombre, $direccion] = $catalogo[$valor]
        ?? [$punto, null];

    return [
        'nombre' => $nombre,
        'direccion' => $direccion
    ];
}

/*
 * FORMATO DE FECHA MONTERREY
 */

function fechaLocal(?string $iso): ?string {

    if (!$iso) {
        return null;
    }

    return (new DateTimeImmutable($iso))
        ->setTimezone(new DateTimeZone(TIMEZONE))
        ->format('d/m/Y h:i A');
}

/*
 * RESPUESTA JSON
 */

function responder(int $codigo, array $data): never {

    http_response_code($codigo);

    echo json_encode(
        $data,
        JSON_UNESCAPED_UNICODE |
        JSON_PRETTY_PRINT |
        JSON_UNESCAPED_SLASHES
    );

    exit;
}

/*
 * PROCESO PRINCIPAL
 */

try {

    /*
     * GENERACIÓN DE ENLACE QR FIRMADO
     * Solo mediante CLI del servidor.
     */

    if (
        PHP_SAPI === 'cli' &&
        ($argv[1] ?? '') === 'emitir'
    ) {
        $id = $argv[2] ?? '';

        if (!validoLead($id)) {
            throw new InvalidArgumentException(
                'ID de Lead inválido.'
            );
        }

        $url = config('APP_BASE_URL');

        $separator = str_contains($url, '?')
            ? '&'
            : '?';

        echo $url . $separator .
            http_build_query(
                [
                    'id' => $id,
                    'sig' => firmado($id)
                ],
                '',
                '&',
                PHP_QUERY_RFC3986
            ) . PHP_EOL;

        exit;
    }

    if (PHP_SAPI === 'cli') {
        throw new RuntimeException(
            'Utiliza el comando emitir.'
        );
    }

    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'GET') {
        responder(405, [
            'error' => 'Método no permitido.'
        ]);
    }

    // El servidor o proxy debe forzar HTTPS.
    if (
        empty($_SERVER['HTTPS']) ||
        $_SERVER['HTTPS'] === 'off'
    ) {
        responder(403, [
            'error' => 'Se requiere HTTPS.'
        ]);
    }

    /*
     * VALIDACIÓN DEL QR
     */

    $leadId = (string) ($_GET['id'] ?? '');
    $firma = (string) ($_GET['sig'] ?? '');

    if (
        !validoLead($leadId) ||
        !preg_match('/^[a-f0-9]{64}$/D', $firma) ||
        !hash_equals(firmado($leadId), $firma)
    ) {
        responder(403, [
            'error' => 'QR no válido.'
        ]);
    }

    /*
     * AUTENTICACIÓN CON SALESFORCE
     */

    $token = accesoSalesforce();

    /*
     * COMPROBAR CONVERSIÓN DEL LEAD
     */

    $lead = consulta(
        $token,
        "SELECT
            Id,
            IsConverted,
            ConvertedOpportunityId
         FROM Lead
         WHERE Id = '$leadId'
         LIMIT 1"
    );

    if (!$lead) {
        responder(404, [
            'error' => 'Prospecto no encontrado.'
        ]);
    }

    if (!$lead['IsConverted']) {
        responder(200, [
            'estado' => 'pendiente_conversion',
            'mensaje' => 'El prospecto aún no se ha convertido.'
        ]);
    }

    $oppId = (string) (
        $lead['ConvertedOpportunityId'] ?? ''
    );

    if (
        !preg_match(
            '/^006[A-Za-z0-9]{12}(?:[A-Za-z0-9]{3})?$/D',
            $oppId
        )
    ) {
        responder(200, [
            'estado' => 'convertido_sin_oportunidad'
        ]);
    }

    /*
     * CONSULTAR OPPORTUNITY
     */

    $oportunidad = consulta(
        $token,
        "SELECT
            Id,
            Name,
            StageName,
            Fecha_y_Hora_Atendido__c
        FROM Opportunity
        WHERE Id = '$oppId'
        LIMIT 1"
    );

    if (!$oportunidad) {
        responder(404, [
            'error' => 'Oportunidad no accesible.'
        ]);
    }

    // Registrar la primera consulta si el campo está vacío.
    $fechaAtencion = registrarPrimeraAtencion(
        $token,
        $oppId,
        $oportunidad['Fecha_y_Hora_Atendido__c'] ?? null
    );

    /*
     * CONSULTAR INFORMACIÓN DEL PROSPECTO
     * Campos tomados del Visualforce de Nissan.
     */

    $datos = consulta(
        $token,
        "SELECT
            Id,
            Name,
            Email,
            MobilePhone,
            Owner.Name,
            Agencia_Nombre__c,
            Como_se_entero_de_nosotros__c,
            NombreProduct__c,
            Auto_a_cuenta__c,
            Para_quien_es__c,
            Plandeinteres__c,
            Plan_Precio__c,
            Plan_Enganche__c,
            Plan_Mensualidad__c,
            Plan_Plazo__c,
            Comentarios__c,
            Credito_o_Contado__c
         FROM Lead
         WHERE Id = '$leadId'
         LIMIT 1"
    );

    /*
     * CONSULTAR ÚLTIMO EVENTO DE VENTAS
     */

    $evento = consulta(
        $token,
        "SELECT
            Id,
            Subject,
            StartDateTime,
            Punto_de_Venta__c
         FROM Event
         WHERE (
            WhoId = '$leadId'
            OR Prospecto__c = '$leadId'
         )
         AND (
            Subject LIKE '%Piso%'
            OR Subject LIKE '%Ventas%'
            OR Subject LIKE '%Visita%'
         )
         ORDER BY CreatedDate DESC, Id DESC
         LIMIT 1"
    );

    $ubicacion = agencia(
        $evento['Punto_de_Venta__c'] ?? null
    );

    /*
     * DEVOLVER INFORMACIÓN A LA WEBAPP
     */

    responder(200, [
        'estado' => 'convertido',

        'lead_id' => $leadId,

        'oportunidad' => [
            'id' => $oppId,
            'nombre' => $oportunidad['Name'],
            'etapa' => $oportunidad['StageName'],
            'fecha_hora_atendido' => fechaLocal($fechaAtencion)
        ],

        'cita_ventas' => [
            'evento_id' => $evento['Id'] ?? null,

            'fecha_hora' => fechaLocal(
                $evento['StartDateTime'] ?? null
            ),

            'agencia' => $ubicacion['nombre'],
            'direccion' => $ubicacion['direccion']
        ],

        'prospecto' => [
            'nombre' => $datos['Name'] ?? null,
            'correo' => $datos['Email'] ?? null,
            'telefono' => $datos['MobilePhone'] ?? null,

            'asesor' =>
                $datos['Owner']['Name'] ?? null,

            'agencia_original' =>
                $datos['Agencia_Nombre__c'] ?? null,

            'origen' =>
                $datos['Como_se_entero_de_nosotros__c'] ?? null,

            'auto_interes' =>
                $datos['NombreProduct__c'] ?? null,

            'auto_a_cuenta' =>
                $datos['Auto_a_cuenta__c'] ?? null,

            'para_quien' =>
                $datos['Para_quien_es__c'] ?? null,

            'plan' =>
                $datos['Plandeinteres__c'] ?? null,

            'precio' =>
                $datos['Plan_Precio__c'] ?? null,

            'enganche' =>
                $datos['Plan_Enganche__c'] ?? null,

            'mensualidad' =>
                $datos['Plan_Mensualidad__c'] ?? null,

            'plazo' =>
                $datos['Plan_Plazo__c'] ?? null,

            'pago' =>
                $datos['Credito_o_Contado__c'] ?? null,

            'comentarios' =>
                $datos['Comentarios__c'] ?? null
        ]
    ]);

} catch (Throwable $ex) {

    // No exponer errores internos ni credenciales.
    error_log(
        'Consulta Nissan QR: ' . get_class($ex)
    );

    responder(503, [
        'error' => 'No fue posible consultar Salesforce.'
    ]);
}