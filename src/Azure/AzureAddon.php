<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Azure;


use Msloser\Wp2staticAddonAzure\Base\BaseController;

class AzureAddon extends BaseController
{

    public function register(): void
    {
    }

    private function define_admin_hooks(): void
    {
        $plugin_admin = new Wp2static_Addon_Azure_Admin( $this->get_plugin_name(), $this->get_version() );

        if ( isset( $_GET['page'] ) && ( $_GET['page'] === 'wp2static')) {
            $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        }
    }
}