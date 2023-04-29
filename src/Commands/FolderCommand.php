<?php
namespace SocketPhp\Commands;

use SocketPhp\Sockets\SocketClientManager;

class FolderCommand
{
    public function make(string $fullPathFrom)
    {
        $dados = [
            'action' => 'make',
            'subject' => 'folder',
            'data' => [
                'full_path' => $fullPathFrom
            ]
        ];

        $socketClientManager = new SocketClientManager();
    
        $dataReceived = $socketClientManager->sendData(json_encode($dados));
    
        if ($dataReceived){
            echo 'Pasta criada.';

            die;
        }else{
            echo 'Pasta não foi criada';

            die;
        }
    }

    public function scan(string $fullPathFrom)
    {
        $dados = [
            'action' => 'scan',
            'subject' => 'folder',
            'data' => [
                'full_path' => $fullPathFrom
            ]
        ];

        $socketClientManager = new SocketClientManager();
    
        $dataReceived = $socketClientManager->sendData(json_encode($dados));
    
        echo $dataReceived;

        die;
    }

    public function delete(string $fullPathFrom)
    {
        $dados = [
            'action' => 'delete',
            'subject' => 'folder',
            'data' => [
                'full_path' => $fullPathFrom
            ]
        ];

        $socketClientManager = new SocketClientManager();
    
        $dataReceived = $socketClientManager->sendData(json_encode($dados));
    
        echo $dataReceived;

        die;
    }
}