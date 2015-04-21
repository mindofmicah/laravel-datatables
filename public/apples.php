<?php
require __DIR__ . '/../vendor/autoload.php';

buildCapsuleFromConfigFile(__DIR__ . '/../integrated.json');

Model::create(['hi'=>'b']);
