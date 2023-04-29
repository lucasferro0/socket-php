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

            return $wasStored;

        }elseif ($this->action == 'show'){
            $fileManager = new FileManager();

            $contents = $fileManager->get($this->fullPath);

            return $contents;
        }elseif ($this->action == 'destroy'){
            $fileManager = new FileManager();

            $wasDeleted = $fileManager->delete($this->fullPath);

            return $wasDeleted;
        }
    }

    protected function actionToFolder()
    {
        if ($this->action == 'store'){
            $folderManager = new FolderManager();

            $created = $folderManager->makeDirectory($this->fullPath);

            return $created;

        }elseif ($this->action == 'show'){
            $folderManager = new FolderManager();

            $diretorioComTudo = $folderManager->scanDirectory($this->fullPath);

            return $diretorioComTudo;
        }elseif ($this->action == 'destroy'){
            $folderManager = new FolderManager();

            $deleted = $folderManager->deleteDirectory($this->fullPath);

            return $deleted;
        }
    }
}