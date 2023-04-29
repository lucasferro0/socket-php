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
    public function sendData(string $data)
    {
        $connection = stream_socket_client("tcp://127.0.0.1:8000", $errno, $errstr, -1);

        if (!$connection) {
            echo "$errstr ($errno)<br />\n";
            
        } else {
            fwrite($connection, "Testeeeeeeeeeeeeeee");

            var_dump('enviou dados');

            var_dump(fread($connection, 1000000));

            $dataReceived = fread($connection, 1000000);

            var_dump('recebeu dados');

            fclose($connection);

            return $dataReceived;
        }
    }
}