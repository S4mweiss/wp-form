<?php
    /**
 * Plugin Name: WP Form.
 * Description: A simple form for WordPress.
 * Version: 0.0.1
 * Author: Samuel Bittmann
 * License: GPL2
 */

    //Prevention from direct access
    defined('ABSPATH') or die("Direct Access not permitted");
    
    /**
     * Generic function calling the install routine of the plugin
     */
    function install() {
        require_once("php/plugin_classes/ThisPlugin.php");
        $thisPlugin = new ThisPlugin();
        $thisPlugin->install();
    }
    
    /**
     * Generic function calling the uninstall routine of the plugin
     */
    function uninstall() {
        require_once("php/plugin_classes/ThisPlugin.php");
        $thisPlugin = new ThisPlugin();
        $thisPlugin->uninstall();
    }
    
    //Hooks and filters
    register_activation_hook( __FILE__, 'install' );
    include("php/custom/hooks.php");
?>