<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Admin;


use Msloser\Wp2staticAddonAzure\Base\BaseController;

class AzureAdmin extends BaseController
{
    public function register(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    }

    public function register_scripts(): void
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