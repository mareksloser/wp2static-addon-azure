<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Admin;


use Msloser\Wp2staticAddonAzure\Base\BaseController;

class Admin extends BaseController
{
    public function register(): void
    {
        if ( isset( $_GET['page'] ) && ( $_GET['page'] === 'wp2static')) {
            add_action('wp_enqueue_scripts', [$this, 'register_scripts__page_wp2static']);
        }
    }

    public function register_scripts__page_wp2static(): void
    {
        wp_enqueue_script(
            $this->plugin_name,
            $this->plugin_path . '/assets/js/wp2static-addon-azure-admin.js',
            ['jquery'],
            $this->version,
            false
        );
    }
}