<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Base;


use Msloser\Wp2staticAddonAzure\Admin\Admin;

class Activate
{
    public static function activate(): void
    {
        do_action(
            'wp2static_register_addon',
            'wp2static-addon-azure',
            'deploy',
            'Azure Deployment',
            'https://github.com/mareksloser/wp2static-addon-azure',
            'Adds Microsoft Azure Cloud Storage as a deployment option for WP2Static'
        );

        $admin = new Admin();
        $admin->activateForSingleSite();
    }
}