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
    
        $dataReceivedArray = json_decode($dataReceived, true);
    
        echo $dataReceivedArray['message'];

        die;
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
    
        $dataReceivedArray = json_decode($dataReceived, true);
    
        var_dump($dataReceivedArray['data']);

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
    
        $dataReceivedArray = json_decode($dataReceived, true);
    
        echo $dataReceivedArray['message'];

        die;
    }
}