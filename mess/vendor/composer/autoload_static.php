<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2a1f558e763fbccea926acbdd0cea3d7
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'pimax\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'pimax\\' => 
        array (
            0 => __DIR__ . '/..' . '/pimax/fb-messenger-php',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2a1f558e763fbccea926acbdd0cea3d7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2a1f558e763fbccea926acbdd0cea3d7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
