<?php

namespace Ourandy\TestPackage\Common\Storage;

interface StorageInterface {

    public function getObject($path);
    
    public function deleteObject($path);
}