<?php
require __DIR__ . '/../vendor/autoload.php';
use MindOfMicah\LaravelDatatables\Datatable;

register_shutdown_function(function (){
    if ($error = error_get_last()) {
        echo '<pre>' . var_dump($error);
    }
});

buildCapsuleFromConfigFile(__DIR__ . '/../integrated.json');
$request = buildRequestObject();

$datatable = new Datatable($request);
$handlers = require __DIR__ . '/../tests/helpers/routes.php';
if (($action = $request->input('action')) && array_key_exists($action, $handlers)) {
    $handlers[$action]($datatable); 
}

$datatable->asJsonResponse()->sendContent();


