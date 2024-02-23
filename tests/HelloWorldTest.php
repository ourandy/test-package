<?php

use Ourandy\TestPackage\HelloWorld;
use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{
    public function testSayHello()
    {
        $this->expectOutputString('Hello, World from Ourandy!');
        HelloWorld::sayHello();
    }
}