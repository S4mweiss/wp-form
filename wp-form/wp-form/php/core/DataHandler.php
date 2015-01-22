<?php

/**
 * DataHandler handles all database manipulations.
 *
 * @version 0.1
 * @author Samuel Bittmann
 */
class DataHandler {
    private $prefix;
    
    public function __construct() {
        $prefix = "";
    }
    
    /**
     * Creates a new table in the database
     * @param   $name       (string) The name of the table
     * @param   $structure  (string) A string representing the structur written in sql syntax
     * @param   $overwrite  (boolean) defining if an existing table should be overwritten
     */
    public function createDataTable($name, $structure, $overwrite = false) {
        //Getting Access to Wordpress-Functions
        global $wpdb;
        
        //If overwrite is true, the table will first be droped
        if($overwrite == true) {
            $this->dropDataTable($name);
        }
        
        //Creating the sql-string
        $dbName = $this->generateTableName($name);
        $dbCharsetCollate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $dbName ($structure) $dbCharsetCollate;";
        
        //Execute the query
        $this->doQuery($sql);
    }
    
    /**
     *  Drops a table in the database
     *  @param  $name       The name of the table
     */
    public function dropDataTable($name) {
        //Creating the sql-string
        $dbName = $this->generateTableName($name);
        $sql = "DROP TABLE $dbName";
        
        //Execute the query
        $this->doQuery($sql);
    }
    
    /**
     * Returns data from the database
     * @param   $name       (sring) The name of the table
     * @param   $attributes (array) The fields, which should be returned
     * @param   $filters    (array) All filters
     */
    public function getData($name, $attributes = "*", $filters = "") {
        $sql = "SELECT ";
        
        //Generate requested attributes string
        if(is_array($attributes)) {
            $i = 0;
            foreach($attributes as $attribute) {
                if ($i > 0) {
                    $sql .= ", ";
                }
                
                $sql .= $attribute;
                $i++;
            }
        }
        else {
            $sql .= $attributes;
        }
        
        $sql .= "FROM ".$this->generateTableName($name);
        
        //Generate filter string
        if(is_array($filters)) {
            $sql .= " WHERE ";
            
            $i = 0;            
            foreach($filters as $filter) {
                if ($i > 0) {
                    $sql .= " AND ";
                }
                
                $sql .= $filter;
                $i++;
            }
        }
        
        global $wpdb;
        return $wpdb->get_results($sql, OBJECT);
    }
    
    /**
     * Inserts data into a table
     * @param   $name       (string) The name of the table
     * @param   $values     (array) A one dimensional array containing one dataset or a two dimensional array containing several datasets
     */
     public function insertData($name, $values) {
        require_once("Arrays.php");
        
        //Checking the depth of the values array
        $valuesDepth = Arrays::getArrayDepth($values, 3);
        
        if ($valuesDepth <= 2 && $valuesDepth >= 1) {
            if($valuesDepth == 1) {
                //Insert one data entry, if depth of the values array equals 1
                $this->insertSingleEntry($name, $values);
            }
            else {
                //Insert each data entry successively
                foreach($values as $insertValues) {
                    $this->insertSingleEntry($name, $insertValues);
                }
            }
        }
        else if ($valuesDepth < 1) {
            //If the parameter values is not an array, throw an error
            throw new Exception('Parameter [values] must be an array');
        } else {
            //If the values array is deeper than 2, throw an error
            throw new Exception('Maximum depth for Array is 2');
        }
     }
    
    /**
     * Generates the full table name and returns it
     * @param   $name       (string) The name of the table
     * @return  The full name including all prefixes
     */
    private function generateTableName($name) {
        global $wpdb;
        return $wpdb->prefix.$prefix.$name;
    }
    
    /**
     * Executes an sql query
     * @param   $sqlQuery   A string representing an sql query
     */
    private function doQuery($sqlQuery) {
        require_once( ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($sqlQuery) or trigger_error("Database could not be created: $sqlQuery", E_USER_ERROR);
    }
    
    /**
     * Inserts one data entry into a data table
     * @param   $name       (string) The name of the table
     * @param   $values     (array) An associative array containig the data
     */
    private function insertSingleEntry($name, $values) {
        global $wpdb;
        $wpdb->insert($this->generateTableName($name), $values);
    }
}
