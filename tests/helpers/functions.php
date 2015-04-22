<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Http\Request;

function buildCapsuleFromConfigFile($config_file)
{
    if (!preg_match('/^(.+)integrated.json$/', $config_file, $match)) {
        throw new Exception('This needs to be an instance of integrated.json');
    }

    $path = $match[1];
    $contents = json_decode(file_get_contents($config_file));

    if (!preg_match('/^(sqlite):(.+)$/', $contents->pdo->connection, $match)) {
        throw new Exception('Currently only sqlite databases are supported');
    }

    $capsule = new Capsule;
    $capsule->addConnection([
        'username' => $contents->pdo->username,
        'password' => $contents->pdo->password,
        'driver'   => $match[1],
        'database' => $path . $match[2]
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
}

function buildRequestObject()
{
    return Request::capture();
}
