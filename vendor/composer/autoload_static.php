<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf9e208e63f8f17819ebbc8600398e0b7
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CILogViewer\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CILogViewer\\' => 
        array (
            0 => __DIR__ . '/..' . '/seunmatt/codeigniter-log-viewer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf9e208e63f8f17819ebbc8600398e0b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf9e208e63f8f17819ebbc8600398e0b7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf9e208e63f8f17819ebbc8600398e0b7::$classMap;

        }, null, ClassLoader::class);
    }
}