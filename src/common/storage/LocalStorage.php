<?php

namespace Ourandy\TestPackage\Common\Storage;

class LocalStorage implements StorageInterface {
    
    protected $baseDir;

    public function __construct($baseDir)
    {
        $this->baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    public function getObject($path)
    {
        $fullPath = $this->baseDir . $path;
        if (!is_file($fullPath)) {
            throw new \Exception("File not found: {$path}");
        }
        return file_get_contents($fullPath);
    }

    public function deleteObject($path)
    {
        $fullPath = $this->baseDir . $path;
        if (!is_file($fullPath)) {
            throw new \Exception("File not found: {$path}");
        }
        if (!unlink($fullPath)) {
            throw new \Exception("Failed to delete file: {$path}");
        }
        return true;
    }
}