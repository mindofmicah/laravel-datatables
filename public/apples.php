<?php
require __DIR__ . '/../vendor/autoload.php';

buildCapsuleFromConfigFile(__DIR__ . '/../integrated.json');
$request = buildRequestObject();


echo '<pre>';
var_dump($request);
Model::create(['hi'=>'b']);
