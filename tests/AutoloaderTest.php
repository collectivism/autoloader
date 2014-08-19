<?php

use Collectivism\Autoloader\Autoloader;

class AutoloaderTest extends \PHPUnit_Framework_TestCase
{
    function __construct()
    {
    }

    function testLoad()
    {
        $classMap = [
            'Autoloader\\Tests\\Namespace1' => __DIR__ . '/classes/Namespace1',
            'Autoloader\\Tests\\Namespace2' => __DIR__ . '/classes/Namespace2'
            ];

        Autoloader::load($classMap);
    }
}
