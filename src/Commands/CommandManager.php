<?php
namespace SocketPhp\Commands;

use ReflectionClass;

class CommandManager
{
    private array $argv;

    private string $command;

    private ?string $fullPathFrom;

    private ?string $fullPathTo; 

    public function __construct(array $argv)
    {
        $this->argv = $argv;

        $this->prepareCommands();
    }

    private function prepareCommands()
    {
        if (count($this->argv) == 1){
            echo 'Comando inválido.';
        
            die;
        }
        
        if (count($this->argv) > 4){
            echo 'Comando inválido';
        
            die;
        }

        $nameFileCommand = $this->argv[0];
        $this->command = $this->argv[1];
        $this->fullPathFrom = $this->argv[2] ?? null;
        $this->fullPathTo = $this->argv[3] ?? null;
    }

    public function registerCommand(string $name, string $dotDotClass)
    {
        if ($this->command == $name){
            $classAndMethod = explode('@', $dotDotClass);
            $classComNamespace = $classAndMethod[0];
            $method = $classAndMethod[1];

            $reflectionClass = new ReflectionClass($classComNamespace);

            foreach($reflectionClass->getMethods() as $reflectionMethodObject){
                $nameMethod = $reflectionMethodObject->getName();

                if ($nameMethod == $method){
                    $reflectionMethodObject->getParameters();

                    $countParameter = count($reflectionMethodObject->getParameters());

                    break;
                }
            }

            if (!isset($countParameter)){
                echo 'Erro, pois o count de paremeter não está definido.';

                die;
            }

            if ($countParameter == 1){
                $object = new $classComNamespace();
                $object->{$method}($this->fullPathFrom);
            }elseif ($countParameter == 2){
                $object = new $classComNamespace();
                $object->{$method}($this->fullPathFrom, $this->fullPathTo);
            }else{
                echo 'Quantidade de parâmetros errada.';

                die;
            }
        }
    }
}