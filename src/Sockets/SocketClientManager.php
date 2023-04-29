<?php
namespace SocketPhp\Sockets;
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
            fwrite($connection, $data);

            var_dump('enviou dados');

            $dataReceived = fread($connection, 1000000);

            var_dump($dataReceived);

            var_dump('recebeu dados');

            fclose($connection);

            return $dataReceived;
        }
    }
}