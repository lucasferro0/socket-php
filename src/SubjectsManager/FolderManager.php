<?php
namespace SocketPhp\Destiny\SubjectsManager;

class FolderManager
{
    public function makeDirectory(string $path): bool
    {
        
    }

    public function deleteDirectory(string $path): bool
    {

    }

    public function isDirectory(string $path): bool
    {
        return is_dir($path);
    }
}