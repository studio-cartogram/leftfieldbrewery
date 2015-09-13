<?php
/**
 * Cartogram API
 *
 * A consitent JSON API extension for cartogram sites.
 *
 * @package   cartogram-api
 * @author    Matthew Seccafien <matt@studiocartogram.com>
 * @license   GPL-2.0+
 * @link      http://cartogram.ca
 * @copyright 7-3-2014 Cartogram
 *
 * @wordpress-plugin
 * Plugin Name: Cartogram API
 * Plugin URI:  http://cartogram.ca
 * Description: A consitent JSON API extension for cartogram sites.
 * Version:     1.0.0
 * Author:      Matthew Seccafien
 * Author URI:  http://cartogram.ca
 * Text Domain: cartogram-api-locale
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
	die;
}

require_once(plugin_dir_path(__FILE__) . "/lib/class-cartogram-json-api.php");

function cartogram_api_init() {
    global $cartogram_api;

    $cartogram_api = new Cartogram_API();
    add_filter( 'json_endpoints', array( $cartogram_api, 'register_routes' ) );
}

add_action( 'wp_json_server_before_serve', 'cartogram_api_init' );
