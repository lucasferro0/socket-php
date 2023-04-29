<?php

namespace SocketPhp\Commands;

use SocketPhp\Sockets\SocketClientManager;
use SocketPhp\SubjectsManager\FileManager;

class FileCommand
{
    public function store(string $fullPathFrom, $fullPathTo)
    {
        if ($fullPathFrom == null && $fullPathTo == null){
            echo 'Caminho para o arquivo inválido';
    
            die;
        }
    
        if (file_exists($fullPathFrom)){
            $contents = file_get_contents($fullPathFrom);
    
            $dados = [
                'action' => 'store',
                'subject' => 'file',
                'data' => [
                    'full_path' => $fullPathTo,
                    'base64' => base64_encode($contents)
                ]
            ];

            $socketClientManager = new SocketClientManager();
    
            $dataReceived = $socketClientManager->sendData(json_encode($dados));
    
            echo $dataReceived;

            die;
        }else{
            echo 'arquivo inexistente';

            die;
        }
    }

    public function get(string $fullPathFrom, string $fullPathTo)
    {
        $dados = [
            'action' => 'get',
            'subject' => 'file',
            'data' => [
                'full_path' => $fullPathTo
            ]
        ];

        $socketClientManager = new SocketClientManager();
    
        $dataReceived = $socketClientManager->sendData(json_encode($dados));
    
        if ($dataReceived){
            (new FileManager())->put($fullPathFrom, $dataReceived);
    
            echo 'Arquivo obtido com sucesso.';

            die;
        }else{
            echo 'Arquivo não foi obtido.';

            die;
        }
    }

    public function destroy(string $fullPathFrom)
    {
        $dados = [
            'action' => 'destroy',
            'subject' => 'file',
            'data' => [
                'full_path' => $fullPathFrom
            ]
        ];

        $socketClientManager = new SocketClientManager();
    
        $dataReceived = $socketClientManager->sendData(json_encode($dados));
    
        if ($dataReceived){
            echo 'Arquivo excluído';

            die;
        }else{
            echo 'Arquivo não foi excluído';

            die;
        }
    }
}