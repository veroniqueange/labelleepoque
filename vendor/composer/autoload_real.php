<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2785f9ef51b03a7171d66c3ffbade4ec
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

        spl_autoload_register(array('ComposerAutoloaderInit2785f9ef51b03a7171d66c3ffbade4ec', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2785f9ef51b03a7171d66c3ffbade4ec', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit2785f9ef51b03a7171d66c3ffbade4ec::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
