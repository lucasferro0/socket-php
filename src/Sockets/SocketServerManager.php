<?php
namespace SocketPhp\Sockets;

use SocketPhp\Destiny\DestinyChooser;

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

                    $dataReceived = fread($conn, 2048);

                    if ($dataReceived){
                        echo PHP_EOL . 'AÇÃO EXECUTADA' . PHP_EOL;
                        $data = (new DestinyChooser($dataReceived))->sendToDestiny();
                        var_dump($data);
                    }

                    // sleep(10);

                    if (isset($data)){
                        fwrite($conn, $data);
                    }

                    fclose($conn);
                }

                fclose($socketServer);
            }
        }
    }
}