<?php

require 'vendor/autoload.php';

use SocketPhp\Sockets\SocketServerManager;

$socketServerManager = new SocketServerManager();

$socketServerManager->create('127.0.0.1', 8000);

$socketServerManager->runServer();