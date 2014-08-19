<?php

namespace Collectivism\Autoloader;

/**
 * Autoloader
 *
 * A simple autoloading class which is only PSR-4 compliant
 */

class Autoloader
{
    public static function load($classMap)
    {
        $files = [];
        foreach ($classMap as $namespace => $path) {
            $files = array_merge($files, self::getFiles($namespace, $path));
        }

        foreach ($files as $file) {
            include_once $file;
        }
    }

    /**
     * getFiles
     *
     * Scans the directory and returns the list of files
     * Also checks the directory exists or not
     *
     * @param       $namespace      string      Namespace
     * @param       $path           string      Directory path of namespace
     *
     * @return      mixed           Returns list of files if directory is valid
     */
    public static function getFiles($namespace, $path)
    {
        $output = [];
        if (is_dir($path)) {
            $files = scandir($path);
            foreach ($files as $file) {
                if (!is_dir($file))
                    $output[] = $path . '/' . $file;
            }
            return $output;
        } else {
            throw new \Exception($path . ' does not exist');
        }
    }

    /**
     * Validate
     *
     * Checks the namespace in the file
     */
    public static function validate($namespace, $path)
    {
    }

}
