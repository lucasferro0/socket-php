<?php

declare(strict_types=1);

error_reporting(E_ERROR | E_PARSE);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($socket, '127.0.0.1', 3000);

if ($socket){
    while(true){
        $connected = socket_connect($socket, '127.0.0.1', 8000);

        if ($connected){
            echo 'Conexão estabelecida.' . PHP_EOL . PHP_EOL;

            while(true){
                $mensagem = 'Olá, eu sou o socket client';
        
                $sent = socket_send($socket, $mensagem, strlen($mensagem), 0);
        
                if ($sent){
                    echo 'Dados enviados para o socket servidor.' . PHP_EOL . PHP_EOL;

                    sleep(10);
        
                }else{
                    echo 'Servidor não recebeu a mensagem.' . PHP_EOL . PHP_EOL;

                    sleep(10);
        
                    break;
                }
            }

        }else{
            echo 'Não foi possível conectar ao socket server.' . PHP_EOL . PHP_EOL;

            sleep(10);
        }
    }
}