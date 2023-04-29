<?php

require 'vendor/autoload.php';

use SocketPhp\Sockets\SocketClientManager;
use SocketPhp\Sockets\SocketServerManager;

$socketClient = new SocketClientManager();


$socketClient->create('127.0.0.1', 3000);

$socketClient->connect('127.0.0.1', 8000);

$data = [
    'action' => 'store',
    'subject' => 'file',
    'data' => [
        'full_path' => 'public/teste.txt',
        'base64' => base64_encode('CONSEGUIIIII')
    ]
];

$teste = $socketClient->sendData(json_encode($data));

var_dump($socketClient->isConnected());

var_dump($teste);

echo 'COMANDO REALIZADO COM SUCESSO.';

$socketClient->disconnect();

var_dump('conexão fechada');
