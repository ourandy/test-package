<?php

namespace Api\Cloud\Aws\Storage;

use Aws\S3\S3Client;
use Ourandy\TestPackage\Common\Storage\StorageInterface;


class S3Storage implements StorageInterface
{
    protected $client;
    protected $bucket;

    public function __construct(S3Client $client, $bucket)
    {
        $this->client = $client;
        $this->bucket = $bucket;
    }

    public function getObject($path)
    {
        $result = $this->client->getObject([
            'Bucket' => $this->bucket,
            'Key'    => $path,
        ]);
        return $result['Body'];
    }

    public function deleteObject($path)
    {
        $this->client->deleteObject([
            'Bucket' => $this->bucket,
            'Key'    => $path,
        ]);
        return true;
    }
}