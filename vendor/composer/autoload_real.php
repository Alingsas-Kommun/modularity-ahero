<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf6b825ff1466459ea74b31611595c9cd
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitf6b825ff1466459ea74b31611595c9cd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf6b825ff1466459ea74b31611595c9cd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitf6b825ff1466459ea74b31611595c9cd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}