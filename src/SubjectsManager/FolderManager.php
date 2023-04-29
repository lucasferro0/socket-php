<?php
namespace SocketPhp\SubjectsManager;

class FolderManager
{
    public function makeDirectory(string $path): bool
    {
        return mkdir($path);
    }

    public function deleteDirectory(string $path): bool
    {
        return rmdir($path);
    }

    public function isDirectory(string $path): bool
    {
        return is_dir($path);
    }

    public function scanDirectory(string $path)
    {
        return scandir($path);
    }
}