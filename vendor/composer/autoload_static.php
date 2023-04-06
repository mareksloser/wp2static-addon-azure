<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit134b5b9a49ca2a117b64e440986027f7
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Msloser\\Wp2staticAddonAzure\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Msloser\\Wp2staticAddonAzure\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Msloser\\Wp2staticAddonAzure\\Admin\\AzureAdmin' => __DIR__ . '/../..' . '/src/Admin/AzureAdmin.php',
        'Msloser\\Wp2staticAddonAzure\\Azure\\AzureAddon' => __DIR__ . '/../..' . '/src/Azure/AzureAddon.php',
        'Msloser\\Wp2staticAddonAzure\\Base\\BaseController' => __DIR__ . '/../..' . '/src/Base/BaseController.php',
        'Msloser\\Wp2staticAddonAzure\\Init' => __DIR__ . '/../..' . '/src/Init.php',
        'Msloser\\Wp2staticAddonAzure\\Loader\\Loader' => __DIR__ . '/../..' . '/src/Loader/Loader.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit134b5b9a49ca2a117b64e440986027f7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit134b5b9a49ca2a117b64e440986027f7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit134b5b9a49ca2a117b64e440986027f7::$classMap;

        }, null, ClassLoader::class);
    }
}