<?php

namespace Ourandy\TestPackage\Tests\Common\Storage;

use PHPUnit\Framework\TestCase;
use Ourandy\TestPackage\Common\Storage\LocalStorage;

class LocalStorageTest extends TestCase
{
    protected $storage;
    protected $testDir = 'C:/Users/andym/Dev/capsphere/test-package/tests/common/resources'; // Adjust this path

    protected function setUp(): void
    {
        // Ensure the directory exists and is writable
        if (!is_dir($this->testDir)) {
            mkdir($this->testDir, 0777, true);
        }

        $this->storage = new LocalStorage($this->testDir);
    }

    protected function tearDown(): void
    {
        // Cleanup: Delete test files within the directory after each test
        $files = glob($this->testDir . "/*"); // Get all file names in the directory
        foreach ($files as $file) { // Iterate over each file
            if (is_file($file))
                unlink($file); // Delete the file if it is not a directory
        }
    }

    public function testGetObjectSuccess()
    {
        // Setup: Create a file to test retrieval
        $filePath = $this->testDir . '/output.txt';
        $expectedContent = 'Ave Maria, gratia plena, Dominus tecum, benedicta tu in mulieribus';
        file_put_contents($filePath, $expectedContent);

        // Act: Retrieve the file content via LocalStorage
        $content = $this->storage->getObject('output.txt');

        // Assert: The content matches expected
        $this->assertEquals($expectedContent, $content);
    }

    public function testGetObjectFailure()
    {
        // Act & Assert: Expecting an exception when file does not exist
        $this->expectException(\Exception::class);
        $this->storage->getObject('nonexistentfile.txt');
    }

    public function testDeleteObjectSuccess()
    {
        // Setup: Create a file to test deletion
        $filePath = $this->testDir . '/todelete.txt';
        file_put_contents($filePath, 'Delete me');

        // Act: Delete the file via LocalStorage
        $result = $this->storage->deleteObject('todelete.txt');

        // Assert: The file is deleted successfully
        $this->assertTrue($result);
        $this->assertFileDoesNotExist($filePath);
    }

    public function testDeleteObjectFailure()
    {
        // Act & Assert: Expecting an exception when attempting to delete a non-existent file
        $this->expectException(\Exception::class);
        $this->storage->deleteObject('nonexistentfile.txt');
    }
}
