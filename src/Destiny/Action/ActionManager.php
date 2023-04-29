<?php
namespace SocketPhp\Destiny\Action;

class ActionManager
{
    use ActionsTrait;

    private string $type;

    private string $action;

    private string $fullPath;

    private ?string $contents;

    public function __construct(string $type, string $action, ?array $data)
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
            return $this->actionToFile();

        }else{ // folder
            return $this->actionToFolder();
        }
    }
}