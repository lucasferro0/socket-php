<?php
namespace SocketPhp\Destiny\Action;

use SocketPhp\Destiny\SubjectsManager\FileManager;

class ActionManager
{
    private string $type;

    private string $action;

    private string $fullPath;

    private ?string $contents;

    public function __contruct(string $type, string $action, ?array $data)
    {
        $this->type = $type;

        $this->action = $action;

        if (isset($data)){
            $this->fullPath = $data['full_path'];

            $this->contents = (isset($data['base64']) ? base64_decode($data['base64']) : null);
        }
    }

    public function runAction()
    {
        if ($this->type == 'file'){
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
        }else{ // folder
            
        }
    }
}