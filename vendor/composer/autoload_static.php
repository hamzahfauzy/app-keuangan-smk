<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteb382d53e0c122ea76c0ec34aae6496e
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BlueM\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BlueM\\' => 
        array (
            0 => __DIR__ . '/..' . '/bluem/tree/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteb382d53e0c122ea76c0ec34aae6496e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteb382d53e0c122ea76c0ec34aae6496e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticIniteb382d53e0c122ea76c0ec34aae6496e::$classMap;

        }, null, ClassLoader::class);
    }
}
