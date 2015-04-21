<?php
function generateConnectionDataFromConfigFile($config_file)
{
    if (!preg_match('/^(.+)integrated.json$/', $config_file, $match)) {
        throw new Exception('This needs to be an instance of integrated.json');
    }

    $path = $match[1];
    $contents = json_decode(file_get_contents($config_file));

    if (!preg_match('/^(sqlite):(.+)$/', $contents->pdo->connection, $match)) {
        throw new Exception('Currently only sqlite databases are supported');
    }

    return [
        'username'=>$contents->pdo->username,
        'password'=>$contents->pdo->password,
        'driver'=>$match[1],
        'database'=>$path . $match[2]
    ];
}
