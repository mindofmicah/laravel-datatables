<?php
require __DIR__ . '/../vendor/autoload.php';

buildCapsuleFromConfigFile(__DIR__ . '/../integrated.json');
$request = buildRequestObject();


$datatable = new Datatable($request);
//$datatable->forEloquentModel('Model');

echo $datatable->asJsonResponse();



class Datatable
{
    public function asJsonResponse()
    {
        return json_encode([
            'aaData'               => [],
            'iTotalRecords'        => 0,
            'iTotalDisplayRecords' => 0
        ]);
    }
}
