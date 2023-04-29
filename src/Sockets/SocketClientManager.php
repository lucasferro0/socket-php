<?php
declare(strict_types=1);

namespace SocketPhp\Sockets;

use Socket;

error_reporting(E_ERROR | E_PARSE);

// $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// socket_bind($socket, '127.0.0.1', 3000);

// if ($socket){
//     while(true){
//         $connected = socket_connect($socket, '127.0.0.1', 8000);

//         if ($connected){
//             echo 'Conexão estabelecida.' . PHP_EOL . PHP_EOL;

//             while(true){
//                 $mensagem = 'Olá, eu sou o socket client';
        
//                 $sent = socket_send($socket, $mensagem, strlen($mensagem), 0);
        
//                 if ($sent){
//                     echo 'Dados enviados para o socket servidor.' . PHP_EOL . PHP_EOL;

//                     sleep(10);
        
//                 }else{
//                     echo 'Servidor não recebeu a mensagem.' . PHP_EOL . PHP_EOL;

//                     sleep(10);
        
//                     break;
//                 }
//             }

//         }else{
//             echo 'Não foi possível conectar ao socket server.' . PHP_EOL . PHP_EOL;

//             sleep(10);
//         }
//     }
// }

/**
 * Possui o papel de socket client
 */
class SocketClientManager
{
    /**
     * @var resource|Socket $socket
     */
    private $socket;

    private bool $status;

    public function create(string $ip, int $port): SocketClientManager
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        socket_bind($this->socket, $ip, $port);

        return $this;
    }

    public function connect(string $ip, int $port): SocketClientManager
    {
        $connected = socket_connect($this->socket, $ip, $port);

        $this->status = $connected;

        return $this;
    }

    public function disconnect(): void
    {
        socket_close($this->socket);
    }

    public function isConnected(): bool
    {
        return $this->status;
    }

    public function sendData(string $data): bool
    {
        if (!$this->isConnected()){
            return false;
        }

        $sent = socket_send($this->socket, $data, strlen($data), 0);

        return (bool) $sent;
    }

    public function runServer()
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        socket_bind($socket, '127.0.0.1', 1500);

        socket_listen($socket, 100);

        echo 'SERVER RODANDO DO PROJETO CLIENT ...' . PHP_EOL . PHP_EOL;

        while(true){
            $connection = socket_accept($socket);

            if ($connection){
                echo 'CONEXÃO ESTABELECIDA.' . PHP_EOL . PHP_EOL;

                while($buffer = socket_read($connection, 100000000)){
                    if ($buffer != ''){
                        echo 'resposta recebida: ' . $buffer . PHP_EOL . PHP_EOL;
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