<h2>Azure Deployment Options</h2>

<form name="wp2static-azure-save-options" method="POST"
      action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
        style="padding-right: 9px;">

    <?php wp_nonce_field( $view['nonce_action'] ); ?>
    <input name="action" type="hidden" value="wp2static_azure_save_options" />

    <table class="widefat striped">
        <tbody>

        <tr>
            <td style="width:50%;">
                <label for="<?php echo $view['options']['baseUrl-azure']->name; ?>">
                    <?php echo $view['options']['baseUrl-azure']->label; ?>
                </label>
            </td>
            <td>
                <input
                        id="<?php echo $view['options']['baseUrl-azure']->name; ?>"
                        name="<?php echo $view['options']['baseUrl-azure']->name; ?>"
                        type="text"
                        value="<?php echo $view['options']['baseUrl-azure']->value; ?>"
                />
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <p><i><?php echo __("Set this to the URL you intend to host your static exported site on, ie http://mystaticsite.com. Do not set this to the same URL as the WordPress site you're currently using (the address in your browser above). This plugin will rewrite all URLs in the exported static html from your current WordPress URL to what you set here. Supports http, https and protocol relative URLs.", 'wp2static-addon-azure');?></i></p>
            </td>
        </tr>

        <tr>
            <td style="width:50%;">
                <label for="<?php echo $view['options']['azStorageAccountName']->name; ?>">
                    <?php echo $view['options']['azStorageAccountName']->label; ?>
                </label>
            </td>

            <td>
                <input
                        id="<?php echo $view['options']['azStorageAccountName']->name; ?>"
                        name="<?php echo $view['options']['azStorageAccountName']->name; ?>"
                        type="text"
                        value="<?php echo $view['options']['azStorageAccountName']->value; ?>"
                />
            </td>
        </tr>

        <tr>
            <td style="width:50%;">
                <label for="<?php echo $view['options']['azContainerName']->name; ?>">
                    <?php echo $view['options']['azContainerName']->label; ?>
                </label>
            </td>

            <td>
                <input
                        id="<?php echo $view['options']['azContainerName']->name; ?>"
                        name="<?php echo $view['options']['azContainerName']->name; ?>"
                        type="text"
                        value="<?php echo $view['options']['azContainerName']->value; ?>"
                />
            </td>
        </tr>

        <tr>
            <td style="width:50%;">
                <label for="<?php echo $view['options']['azAccessKey']->name; ?>">
                    <?php echo $view['options']['azAccessKey']->label; ?>
                </label>
            </td>

            <td>
                <input
                        id="<?php echo $view['options']['azAccessKey']->name; ?>"
                        name="<?php echo $view['options']['azAccessKey']->name; ?>"
                        type="password"
                        value="<?php echo $view['options']['azAccessKey']->value !== '' ?
                            \WP2Static\CoreOptions::encrypt_decrypt(
                                    'decrypt',
                                    $view['options']['azAccessKey']->value
                            ) : ''; ?>"
                />
            </td>
        </tr>

        <tr>
            <td style="width:50%;">
                <label for="<?php echo $view['options']['azPath']->name; ?>">
                    <?php echo $view['options']['azPath']->label; ?>
                </label>
            </td>

            <td>
                <input
                        id="<?php echo $view['options']['azPath']->name; ?>"
                        name="<?php echo $view['options']['azPath']->name; ?>"
                        type="text"
                        value="<?php echo $view['options']['azPath']->value; ?>"
                />
            </td>
        </tr>

        <tr>
            <td style="width:50%;">
                <label for="az_test"><?php echo __('Test Azure Settings', 'wp2static-addon-azure');?></label>
            </td>

            <td>
                <button id="azure-test-button" type="button" class="btn-primary button">Test Azure Settings</button>
            </td>
        </tr>
        </tbody>
    </table>

    <br>

    <button class="button btn-primary"><?php echo __('Save Options', 'wp2static-addon-azure') ?></button>

</form>
