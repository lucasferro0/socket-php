<?php
namespace SocketPhp\Destiny\Action;

use SocketPhp\SubjectsManager\FileManager;
use SocketPhp\SubjectsManager\FolderManager;

trait ActionsTrait
{
    protected function actionToFile()
    {
        if ($this->action == 'store'){
            $fileManager = new FileManager();

            $wasStored = $fileManager->put($this->fullPath, $this->contents);

            $data = $wasStored 
                ? ['success' => true, 'message' => 'Arquivo armazenado.'] 
                : ['success' => false, 'message' => 'Erro ao armazenar aquivo.'];



            return json_encode($data);

        }elseif ($this->action == 'get'){
            $fileManager = new FileManager();

            $contents = $fileManager->get($this->fullPath);

            $data = $contents 
                ? ['success' => true, 'message' => 'Arquivo obtido com sucesso.', 'data' => $contents] 
                : ['success' => false, 'message' => 'Erro ao obter arquivo.'];



            return json_encode($data);
        }elseif ($this->action == 'destroy'){
            $fileManager = new FileManager();

            $wasDeleted = $fileManager->delete($this->fullPath);

            $data = $wasDeleted 
                ? ['success' => true, 'message' => 'Arquivo deletado com sucesso.'] 
                : ['success' => false, 'message' => 'Erro ao deletar arquivo.'];



            return json_encode($data);
        }
    }

    protected function actionToFolder()
    {
        if ($this->action == 'make'){
            $folderManager = new FolderManager();

            $created = $folderManager->makeDirectory($this->fullPath);

            $data = $created 
                ? ['success' => true, 'message' => 'Pasta criada com sucesso.'] 
                : ['success' => false, 'message' => 'Erro ao criar pasta.'];



            return json_encode($data);

        }elseif ($this->action == 'scan'){
            $folderManager = new FolderManager();

            $diretorioComTudo = $folderManager->scanDirectory($this->fullPath);

            $data = $diretorioComTudo 
                ? ['success' => true, 'message' => 'Pasta obtida com sucesso.', 'data' => $diretorioComTudo] 
                : ['success' => false, 'message' => 'Erro ao obter pasta.'];



            return json_encode($data);
        }elseif ($this->action == 'delete'){
            $folderManager = new FolderManager();

            $deleted = $folderManager->deleteDirectory($this->fullPath);

            $data = $deleted 
                ? ['success' => true, 'message' => 'Pasta deletada com sucesso.'] 
                : ['success' => false, 'message' => 'Erro ao deletar pasta.'];



            return json_encode($data);
        }
    }
}