<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Base;


use Msloser\Wp2staticAddonAzure\Admin\Admin;

class Uninstall
{
    public static function uninstall(): void
    {
        $admin = new Admin();
        $admin->deactivateForSingleSite();
    }
}