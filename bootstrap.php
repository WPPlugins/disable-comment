<?php
/*
Plugin Name: WSX Disable Comments
Plugin URI:  http://www.htmlcssinfo.com/
Description: Disable comments, trackbacks and/or pingbacks
Version:     0.4
Author:      Alex Jones
Author URI:  http://www.htmlcssinfo.com/
*/



if (!defined('ABSPATH')) {
    die('Access denied.');
}

define('WSXDC_NAME', 'WSX Disable Comments');
define('WSXDC_REQUIRED_PHP_VERSION', '5.3'); // because of get_called_class()
define('WSXDC_REQUIRED_WP_VERSION', '3.1'); // because of esc_textarea()

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if not
 */
function adc_requirements_met()
{
    global $wp_version;

    if (version_compare(PHP_VERSION, WSXDC_REQUIRED_PHP_VERSION, '<')) {
        return false;
    }

    if (version_compare($wp_version, WSXDC_REQUIRED_WP_VERSION, '<')) {
        return false;
    }

    return true;
}

/**
 * Prints an error that the system requirements weren't met.
 */
function adc_requirements_error()
{
    global $wp_version;

    require_once(dirname(__FILE__) . '/views/requirements-error.php');
}


if (adc_requirements_met()) {
    require_once(__DIR__ . '/classes/wsxdc-module.php');
    require_once(__DIR__ . '/classes/wsx-disable-comments.php');
    require_once(__DIR__ . '/includes/admin-notice-helper/admin-notice-helper.php');
    require_once(__DIR__ . '/classes/wsxdc-settings.php');
    require_once(__DIR__ . '/classes/wsxdc-instance-class.php');

    if (class_exists('WordPress_Disable_Comments')) {
        $GLOBALS['wsxdc'] = WordPress_Disable_Comments::get_instance();
        register_activation_hook(__FILE__, array($GLOBALS['wsxdc'], 'activate'));
        register_deactivation_hook(__FILE__, array($GLOBALS['wsxdc'], 'deactivate'));
    }
} else {
    add_action('admin_notices', 'adc_requirements_error');
}
