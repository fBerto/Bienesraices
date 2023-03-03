<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit583525a289c56e3d592d4520eeaba09d
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit583525a289c56e3d592d4520eeaba09d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit583525a289c56e3d592d4520eeaba09d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit583525a289c56e3d592d4520eeaba09d::$classMap;

        }, null, ClassLoader::class);
    }
}
