<?php
declare(strict_types=1);

namespace SocketPhp\Sockets;

use Socket;

// Ignorando warnings aqui.
// Warnings que, por sinal, acontecem bastante ao se trabalhar com sockets.
error_reporting(E_ERROR | E_PARSE);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($socket, '127.0.0.1', 8000);

socket_listen($socket, 1);

echo 'SERVER RODANDO ...' . PHP_EOL . PHP_EOL;

while(true){
    $connection = socket_accept($socket);

    if ($connection){
        echo 'CONEXÃO ESTABELECIDA.' . PHP_EOL . PHP_EOL;

        while($buffer = socket_read($connection, 2048)){
            if ($buffer != ''){
                echo 'Mensagem recebida do socket_client: ' . $buffer . PHP_EOL . PHP_EOL;

                sleep(10);
            }
        }

        socket_close($connection);

    }else{
        echo 'AGUARDANDO CONEXÃO.' . PHP_EOL . PHP_EOL;

        sleep(10);
    }
}

/**
 * Possui o papel de socket server
 */
class SocketServerManager
{
    /**
     * @var resource|Socket $socket
     */
    private $socket;

    private bool $status;

    public function create(string $ip, int $port): SocketServerManager
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        socket_bind($this->socket, $ip, $port);

        socket_listen($this->socket, 1);

        return $this;
    }

    public function runServer()
    {
        

        while(true){
            $connection = socket_accept($this->socket);
        
            if ($connection){
                echo 'CONEXÃO ESTABELECIDA.' . PHP_EOL . PHP_EOL;
        
                while($buffer = socket_read($connection, 100000000)){
                    if ($buffer != ''){
                        echo 'Mensagem recebida do socket_client: ' . $buffer . PHP_EOL . PHP_EOL;
        
                        sleep(10);
                    }
                }
        
                socket_close($connection);
        
            }else{
                echo 'AGUARDANDO CONEXÃO.' . PHP_EOL . PHP_EOL;
        
                sleep(10);
            }
        }
    }
}