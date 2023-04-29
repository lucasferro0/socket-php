<?php
declare(strict_types=1);

namespace SocketPhp\Sockets;

use Socket;
use SocketPhp\Destiny\DestinyChooser;

// Ignorando warnings aqui.
// Warnings que, por sinal, acontecem bastante ao se trabalhar com sockets.
error_reporting(E_ERROR | E_PARSE);

// $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// socket_bind($socket, '127.0.0.1', 8000);

// socket_listen($socket, 1);

// echo 'SERVER RODANDO ...' . PHP_EOL . PHP_EOL;

// while(true){
//     $connection = socket_accept($socket);

//     if ($connection){
//         echo 'CONEXÃO ESTABELECIDA.' . PHP_EOL . PHP_EOL;

//         while($buffer = socket_read($connection, 2048)){
//             if ($buffer != ''){
//                 echo 'Mensagem recebida do socket_client: ' . $buffer . PHP_EOL . PHP_EOL;

//                 sleep(10);
//             }
//         }

//         socket_close($connection);

//     }else{
//         echo 'AGUARDANDO CONEXÃO.' . PHP_EOL . PHP_EOL;

//         sleep(10);
//     }
// }

/**
 * Possui o papel de socket server
 */
class SocketServerManager
{
    public function runServer()
    {
        echo 'SERVER DO PROJETO SERVER RODANDO ...';

        $socketServer = stream_socket_server("tcp://0.0.0.0:8000", $errno, $errstr);

        if (!$socketServer) {
            echo "$errstr ($errno)<br />\n";

        }else {

            if ($socketServer){
                while (true){
                    $conn = stream_socket_accept($socketServer);

                    if (!$conn){
                        break;
                    }

                    var_dump(fread($conn, 2048));

                    sleep(10);

                    fwrite($conn, 'La fecha y hora actuales es ' . date('n/j/Y g:i a') . "\n");

                    fclose($conn);
                }

                fclose($socketServer);
            }
        }
    }
}