<?php

require 'vendor/autoload.php';

use SocketPhp\Sockets\SocketClientManager;

$socketClient = new SocketClientManager();

$socketClient->runServer();