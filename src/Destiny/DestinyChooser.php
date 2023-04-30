<?php
namespace SocketPhp\Destiny;

use Exception;
use SocketPhp\Destiny\Action\ActionManager;

class DestinyChooser
{
    private string $action;

    private string $subject;

    private ?array $data;

    public function __construct (string $data)
    {
        $dadosArray = json_decode($data, true);

        $action = $dadosArray['action'] ?? null;
        $subject = $dadosArray['subject'] ?? null;
        $data = $dadosArray['data'] ?? null;

        if (!$action){
            throw new Exception('O action é obrigataório.');
        }

        $this->action = $action;

        if (!$subject){
            throw new Exception('O subject é obrigataório.');
        }

        $this->subject = $subject;

        if ($data){
            $this->data = $data;
        }
    }

    public function sendToDestiny()
    {
        return (new ActionManager($this->subject, $this->action, $this->data))->runAction();
    }
}