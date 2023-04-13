<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Admin;


use Msloser\Wp2staticAddonAzure\Azure\Deployer;
use Msloser\Wp2staticAddonAzure\Base\BaseController;

class Admin extends BaseController
{
    private const NonceAction = 'wp2static-azure-options';

    public function register(): void
    {
        add_action('init', [$this, 'register_scripts__page_wp2static']);
        add_action('admin_menu', [ $this, 'addOptionsPage' ], 15, 1);
        add_action('admin_post_wp2static_azure_save_options', [ $this, 'saveOptionsFromUI' ], 15, 1);
        add_action('wp2static_deploy', [ $this, 'deploy' ], 15, 2);
    }

    public function register_scripts__page_wp2static(): void
    {
        if ( isset( $_GET['page'] ) && ( $_GET['page'] == 'wp2static')) {
            wp_enqueue_script(
                $this->plugin_name,
                $this->plugin_path . 'assets/js/wp2static-addon-azure-admin.js',
                ['jquery'],
                $this->version,
                false
            );
        }
    }

    public function renderAzurePage(): void
    {
        $view = [];
        $view['nonce_action'] = self::NonceAction;
        $view['uploads_path'] = \WP2Static\SiteInfo::getPath( 'uploads' );
        $view['options'] = $this->getOptions();

        require_once __DIR__ . '/../../views/azure-page.php';
    }

    public function addOptionsPage() : void
    {
        add_submenu_page(
            '',
            'Azure Deployment Options',
            'Azure Deployment Options',
            'manage_options',
            $this->plugin_name,
            [ $this, 'renderAzurePage' ]
        );
    }

    public function saveOptionsFromUI() : void
    {
        check_admin_referer(self::NonceAction);

        global $wpdb;

        $table_name = $wpdb->prefix . $this->plugin_table;

        $wpdb->update(
            $table_name,
            [ 'value' => sanitize_text_field( $_POST['baseUrl-azure'] ) ],
            [ 'name' => 'baseUrl-azure' ]
        );

        $wpdb->update(
            $table_name,
            [ 'value' => sanitize_text_field( $_POST['azStorageAccountName'] ) ],
            [ 'name' => 'azStorageAccountName' ]
        );

        $wpdb->update(
            $table_name,
            [ 'value' => sanitize_text_field( $_POST['azContainerName'] ) ],
            [ 'name' => 'azContainerName' ]
        );

        $secret_access_key =
            $_POST['azAccessKey'] ?
                \WP2Static\CoreOptions::encrypt_decrypt(
                    'encrypt',
                    sanitize_text_field( $_POST['azAccessKey'] )
                ) : '';

        $wpdb->update(
            $table_name,
            [ 'value' => $secret_access_key ],
            [ 'name' => 'azAccessKey' ]
        );

        $wpdb->update(
            $table_name,
            [ 'value' => sanitize_text_field( $_POST['azPath'] ) ],
            [ 'name' => 'azPath' ]
        );

        wp_safe_redirect( admin_url( 'admin.php?page=' . $this->plugin_name ) );
        exit;
    }

    /**
     * Get option value
     *
     * @return string option value
     */
    public function getValue( string $name ) : string
    {
        global $wpdb;

        $table_name = $wpdb->prefix . $this->plugin_table;

        $sql = $wpdb->prepare(
            "SELECT value FROM $table_name WHERE" . ' name = %s LIMIT 1',
            $name
        );

        $option_value = $wpdb->get_var( $sql );

        if ( ! is_string( $option_value ) ) {
            return '';
        }

        return $option_value;
    }

    public function activateForSingleSite(): void {
        $this->createOptionsTable();
        $this->seedOptions();
    }

    public function deactivateForSingleSite(): void {
        $this->removeOptionsTable();
    }

    public function removeOptionsTable() : void
    {
        global $wpdb;

        $table_name = $wpdb->prefix . $this->plugin_table;

        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
    }

    public function createOptionsTable() : void
    {
        global $wpdb;

        $table_name = $wpdb->prefix . $this->plugin_table;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name VARCHAR(191) NOT NULL,
            value VARCHAR(255) NOT NULL,
            label VARCHAR(255) NULL,
            description VARCHAR(255) NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );

        // dbDelta doesn't handle unique indexes well.
        $indexes = $wpdb->query( "SHOW INDEX FROM $table_name WHERE key_name = 'name'" );
        if ( 0 === $indexes ) {
            $result = $wpdb->query( "CREATE UNIQUE INDEX name ON $table_name (name)" );
            if ( false === $result ) {
                \WP2Static\WsLog::l( "Failed to create 'name' index on $table_name." );
            }
        }
    }

    /**
     * Seed options
     */
    public function seedOptions() : void {
        global $wpdb;

        $table_name = $wpdb->prefix . $this->plugin_table;

        $query_string =
            "INSERT IGNORE INTO $table_name (name, value, label, description) " .
            'VALUES (%s, %s, %s, %s);';

        $query = $wpdb->prepare(
            $query_string,
            'azStorageAccountName',
            '',
            'Storage account name',
            ''
        );

        $wpdb->query( $query );

        $query = $wpdb->prepare(
            $query_string,
            'baseUrl-azure',
            '',
            'BaseUrl Azure',
            ''
        );

        $wpdb->query( $query );

        $query = $wpdb->prepare(
            $query_string,
            'azContainerName',
            '',
            'Container name',
            ''
        );

        $wpdb->query( $query );

        $query = $wpdb->prepare(
            $query_string,
            'azAccessKey',
            '',
            'Access Key',
            ''
        );

        $wpdb->query( $query );

        $query = $wpdb->prepare(
            $query_string,
            'azPath',
            '',
            'Path within storage container',
            ''
        );

        $wpdb->query( $query );
    }

    /**
     *  Get all add-on options
     *
     *  @return mixed[] All options
     */
    public function getOptions() : array
    {
        global $wpdb;
        $options = [];

        $table_name = $wpdb->prefix . $this->plugin_table;

        $rows = $wpdb->get_results( "SELECT * FROM $table_name" );

        foreach ( $rows as $row ) {
            $options[ $row->name ] = $row;
        }

        return $options;
    }

    public function deploy( string $processed_site_path, string $enabled_deployer ) : void
    {
        if ( $enabled_deployer !== 'wp2static-addon-azure' ) {
            return;
        }

        \WP2Static\WsLog::l( 'Azure Addon deploying' );

        $azure_deployer = new Deployer();
        $azure_deployer->uploadFiles( $processed_site_path );
    }
}