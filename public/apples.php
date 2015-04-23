<?php
require __DIR__ . '/../vendor/autoload.php';

buildCapsuleFromConfigFile(__DIR__ . '/../integrated.json');
$request = buildRequestObject();



echo Model::all()->toJSON();
//echo json_encode(['micah'=>'awesome']);
