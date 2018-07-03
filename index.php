<?php
// My microservice!
if(!defined('STDOUT')) define('STDOUT', fopen('php://stdout', 'w'));
fwrite(STDOUT, 'Fighter is running');

set_exception_handler(function ($e) {
    $code = $e->getCode() ? : 400;
    header("Content-Type: application/json", NULL, $code);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
});

// assume JSON, handle requests by verb and path
$verb = $_SERVER['REQUEST_METHOD'];

// declare GET request response and database query response
$getRequestResponse;

error_log(print_r($verb, TRUE));
switch ($verb) {
    case 'GET':
    	// sample GET URL
        //$url = "http://ip.jsontest.com/";
	$url = "http://129.157.179.180:3000/shield/33/45/red/Asandolo";
	$getRequestResponse = file_get_contents($url);
					
        break;
    default:
        throw new Exception('Method Not Supported', 405);
}

header("Content-Type: application/json");
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, PATCH, DELETE');
header('Access-Control-Allow-Headers:X-Requested-With,content-type');
header('Access-Control-Allow-Credentials:true');

echo $getRequestResponse;
fwrite(STDOUT, $getRequestResponse);
fclose(STDOUT);
