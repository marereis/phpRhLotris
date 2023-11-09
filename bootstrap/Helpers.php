<?php

function ajaxResponse(string $param, array $values): string
{
    return json_encode([$param => $values]);
}

function site(string $param = null): string
{
    if ($param && !empty(SITE[$param])) {
        return SITE[$param];
    }

    return SITE['root'];
}

/**
 * @param type $imageUrl
 *
 * @return type
 */
function routeImage($imageUrl)
{
    return "https://via.placeholder.com/1200x628/0984e3/ffffff?text={$imageUrl}";
}

/**
 * @param bool $time
 */
function asset(string $path, $time = true): string
{
    $file = SITE['root']."/resources/assets/{$path}";
    $fileOndir = dirname(__DIR__, 1)."/resources/assets/{$path}";
    if ($time && file_exists($fileOndir)) {
        $file .= '?time='.filemtime($fileOndir);
    }

    return $file;
}

/**
 * @return string|null
 */
function flash(string $type = null, string $message = null)
{
    if ($type && $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
        ];

        return null;
    }

    if (!empty($_SESSION['flash']) && $flash = $_SESSION['flash']) {
        unset($_SESSION['flash']);

        return "<div class=\"message{$flash['Type']}\">{$flash['message']}</div>";
    }

    return null;
}

function tratarCaracter(string $vlr, $tipo): string
{
    switch ($tipo) {
        case 1: $rst = utf8_decode($vlr);
            break;
        case 2: $rst = utf8_encode($vlr);
            break;
        case 3: $rst = htmlentities($vlr, ENT_QUOTES, 'ISO-8859-1');
            break;
    }

    return $rst;
}

/**
 * @param int $tipo
 *
 * @return string
 */
function dataAtual($tipo): string
{
    switch ($tipo) {
        case 1: $rst = date('Y-m-d');
            break;
        case 2: $rst = date('Y-m-d H:i:s');
            break;
        case 3: $rst = date('d/m/Y');
            break;
        case 4: $rst = date('d /m /Y - H:i:s');
            break;
        case 5: $rst = date('Y');
            break;
        case 6: $rst = date('H:i:s');
            break;
        case 7: $rst = date('Y-m-01');
            break;
        case 8: $rst = date('Y-m-01', strtotime('-1 month'));
            break;
        case 9: $rst = date('Y-m-31', strtotime('-1 month'));
            break;
        case 10: $rst = date('d');
            break;
        case 11: $rst = date('m');
            break;
    }

    return $rst;
}

/**
 * @param type $vlr
 * @param type $tipo
 *
 * @return type
 */
function conversordata(string $vlr, $tipo): string
{
    switch ($tipo) {
        case 1: $rst = date('d/m/Y', strtotime($vlr));
            break;
        case 2: $rst = date('d', strtotime($vlr));
            break;
    }

    return $rst;
}

/**
 * @param type $vlr
 * @param type $tipo
 *
 * @return type
 */
function base64(string $vlr, $tipo): string
{
    switch ($tipo) {
        case 1: $rst = base64_encode($vlr);
            break;
        case 2: $rst = base64_decode($vlr);
            break;
        case 3: $rst = md5($vlr);
            break;
    }

    return $rst;
}

/**
 * @param type $vlr
 */
function somaDatanasc(string $vlr): string
{
    $d1 = date_create(dataAtual(1));
    $d2 = date_create($vlr);

    $intervaloData = date_diff($d1, $d2);

    return $intervaloData->format('%Y anos, %m meses, %a dias');
}

/**
 * formata numero com duas casas.
 *
 * @param int $numero
 */
function duasCZ(string $numero): string
{
    return number_format($numero, 2, '.', ',');
}

/**
 * formata numero com tres casas.
 *
 * @param int $numero
 */
function tresCZ(string $numero): string
{
    return number_format($numero, 3, ',', '.');
}

function hast_senhas(string $password): string
{
    $hash = md5($password);

    return $hash;
}

/**
 * @param type $password
 */
function gerarHash($password): string
{
    $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);

    return $hash;
}

/**
 * @param type $password
 * @param type $hast
 */
function testeHash($password, $hast): bool
{
    $ok = password_verify($password, $hast);

    return $ok;
}

// $senha = "123456";
//
// $hast =  gerarHash($senha);
// echo $hast ;
//
// echo testeHash($senha, $hast);

/**
 * @param type $hast
 */
function passwd_rehast($hast): bool
{
    $ok = password_needs_rehash($hast, CONF_PASSWD_ALGO, CONFI_PASSWD_OPTION);

    return $ok;
}
