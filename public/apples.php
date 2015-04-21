<?php
require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$data = generateConnectionDataFromConfigFile(__DIR__ . '/../integrated.json');
$base_path = __DIR__ . '/../';
$contents = json_decode(file_get_contents($base_path .'integrated.json'));

list($driver, $path) = explode(':', $contents->pdo->connection, 2);

$capsule = new Capsule;
$capsule->addConnection($data);

$capsule->setAsGlobal();
$capsule->bootEloquent();


Model::create(['hi'=>'b']);
