<?php

/**
 * Interface for the class Plugin. Every plugin needs to have a class which inherits form this interface.
 * The interface defines neccessary functions which provide the install and uninstall functionality.
 *
 * @version 0.1
 * @author Samuel Bittmann
 */
interface Plugin
{
    public function __construct();
    
    /**
     *  Function for installing the plugin
     */
    public function install();
    
    
    /**
     * Function for uninstalling the plugin
     */
    public function uninstall();
}
