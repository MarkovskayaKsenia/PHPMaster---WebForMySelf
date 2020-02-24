<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit771cbde64a15a41a7bc9b96d0fe31fad
{
    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'ishop\\' => 6,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ishop\\' => 
        array (
            0 => __DIR__ . '/..' . '/ishop',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit771cbde64a15a41a7bc9b96d0fe31fad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit771cbde64a15a41a7bc9b96d0fe31fad::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
