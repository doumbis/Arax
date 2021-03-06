<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfb0bcd49cf930ae49a4adfa92d1fb21c
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitfb0bcd49cf930ae49a4adfa92d1fb21c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfb0bcd49cf930ae49a4adfa92d1fb21c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfb0bcd49cf930ae49a4adfa92d1fb21c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
