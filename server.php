<?php

require 'vendor/autoload.php';

use SocketPhp\Sockets\SocketServerManager;

$socketServerManager = new SocketServerManager();

$socketServerManager->runServer();
