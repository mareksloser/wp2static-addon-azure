<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Base;


use Msloser\Wp2staticAddonAzure\Admin\Admin;

class Deactivate
{
    public static function deactivate(): void
    {
        $admin = new Admin();
        $admin->deactivateForSingleSite();
    }
}