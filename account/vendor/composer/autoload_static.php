<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit27380c0a313e4581e65b6f5e61ee3f73
{
    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsstream/src/main/php',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit27380c0a313e4581e65b6f5e61ee3f73::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit27380c0a313e4581e65b6f5e61ee3f73::$classMap;

        }, null, ClassLoader::class);
    }
}
