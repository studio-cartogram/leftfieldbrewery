<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   cartogram-api
 * @author    Matthew Seccafien <matt@studiocartogram.com>
 * @license   GPL-2.0+
 * @link      http://cartogram.ca
 * @copyright 7-3-2014 Cartogram
 */

// If uninstall, not called from WordPress, then exit
if (!defined("WP_UNINSTALL_PLUGIN")) {
	exit;
}

// TODO: Define uninstall functionality here