<?php

namespace Collectivism\Autoloader;

/**
 * Autoloader
 *
 * A simple autoloading class which is only PSR-4 compliant
 */

class Autoloader
{
    /**
     * Returns the *Singleton* instance of this class.
     *
     * @staticvar Singleton $instance The *Singleton* instances of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }

    public function load($classMap)
    {
        $files = [];
        foreach ($classMap as $namespace => $path) {
            $files = array_merge($files, $this->getFiles($namespace, $path));
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
     * @param   $namespace string      Namespace
     * @param   $path      string      Directory path of namespace
     *
     * @return mixed Returns list of files if directory is valid
     */
    protected function getFiles($namespace, $path)
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
    protected function validate($namespace, $path)
    {
    }

}
