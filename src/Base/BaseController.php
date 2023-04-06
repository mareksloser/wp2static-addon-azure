<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Base;


use Msloser\Wp2staticAddonAzure\Loader\Loader;

class BaseController
{
    public string $plugin_name;
    public string $version;
    public Loader $loader;

    public string $plugin_path;
    public string $plugin_url;
    public string $plugin;

    public function __construct()
    {
        $this->version      = '0.2';
        $this->plugin_name  = 'wp2static-addon-azure';

        $this->plugin_path  = plugin_dir_path( dirname( __FILE__, 2) );
        $this->plugin_url   = plugin_dir_url(  dirname( __FILE__, 2) );
        $this->plugin       = plugin_basename( dirname( __FILE__, 3) ) . '/'. $this->plugin_name .'.php';

        $this->loader       = new Loader();
    }
}