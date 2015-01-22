<?php

/**
 * ThisPlugin is a class which extends the Plugin interface and provides
 * functions for the plugin handling like installing and uninstalling it.
 *
 * @version 0.1
 * @author Samuel Bittmann
 */

//Get the interface
require_once(__DIR__."/../core/Plugin.php");
 
class ThisPlugin implements Plugin
{
    public function __construct() {
    
    }
    
    public function install() {
        require_once("/../core/DataHandler.php");
        
        //Create the data table
        $tableStructure = "MessageId mediumint(9) NOT NULL AUTO_INCREMENT,
                            Time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                            Surname tinytext NOT NULL,
                            Forname tinytext NOT NULL,
                            Email tinytext NOT NULL,
                            Phone tinytext,
                            Message text NOT NULL,
                            PRIMARY KEY  (MessageId)";
                            
        $database = new DataHandler();
        $database->createDataTable("wpform", $tableStructure, false);
    }
    
    public function uninstall() {
    
    }
}
