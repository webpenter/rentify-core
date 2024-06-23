<?php

/**
 * Fired during plugin activation
 *
 * @link       https://webpenter.com
 * @since      1.0.0
 *
 * @package    Rentify_Core
 * @subpackage Rentify_Core/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rentify_Core
 * @subpackage Rentify_Core/includes
 * @author     WebPenter <sales@webpenter.com>
 */
class Rentify_Core_Activator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {

        require_once plugin_dir_path( __FILE__ ) . 'db/db-tables.php';
        rentify_create_table();
    }

}
