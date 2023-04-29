<?php
namespace SocketPhp\SubjectsManager;

class FileManager
{
    public function get(string $path)
    {
        if ($this->isFile($path)){
            return file_get_contents($path);
        }

        return false;
    }

    public function put(string $path, string $contents): bool
    {
        if (file_exists(dirname($path))){
            $file = fopen($path, 'w');

            fwrite($file, $contents);

            return fclose($file); 
        }

        mkdir(dirname($path));

        $file = fopen($path, 'w');

        fwrite($file, $contents);

        return fclose($file); 

    }

    public function append(string $path, $contents): bool
    {
        $file = fopen($path, 'a');

        fwrite($contents, strlen($contents));

        return fclose($file);  
    }

    public function delete(string $path): bool
    {
        if (file_exists($path)){
            return unlink($path);
        }

        return false;
    }

    public function isFile(string $path): bool
    {
        return is_file($path);
    }

    public function size(string $path): int
    {
        return filesize($path);
    }

    public function fileExists(string $path): bool
    {
        return file_exists($path);
    }
}