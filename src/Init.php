<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure;


use Msloser\Wp2staticAddonAzure\Admin\AzureAdmin;

final class Init
{
    private static ?Init $_instance = null;

    /**
     * Load text domain
     */
    public function load_textdomain(): void
    {
        load_plugin_textdomain( 'wp2static-addon-azure', false, 'wp2static-addon-azure/languages' );
    }

    /**
     * Construct
     */
    protected function __construct()
    {
        add_action( 'plugins_loaded', [ &$this, 'load_textdomain' ] );

        $this->register_services();
    }

    /**
     * Store all classes in a array
     * @return string[]
     */
    public function get_services(): array
    {
        return [
            AzureAdmin::class,
        ];
    }

    /**
     * Loop through the classes, initialize them and call register method if exist
     */
    public function register_services(): void
    {
        foreach ( $this->get_services() as $class )
        {
            $service = new $class;

            if ( method_exists( $class, 'register' ) ) {
                $service->register();
            }
        }
    }

    public static function instance(): Init
    {
        if ( is_null( self::$_instance ) )
        {
            self::$_instance = new Init();
        }

        return self::$_instance;
    }
}