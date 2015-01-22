<?php

/**
 * DataChecker provides static functions for checking types of data (e.g. phone number).
 *
 * @version 0.1
 * @author Samuel Bittmann
 */
class DataChecker
{
    /**
     * Checks, if input is a valid phone number
     * @param   $input      (string)The value, which should be checked
     * @return  Returns true, if input is a valid phone number, otherwise returns false
     */
    public static function isPhoneNumber($input) {
        return preg_match('^[0-9+][0-9 ]*$', $input);
    }
    
    /**
     * Checks, if input is a valid name
     * @param   $input      (string)The value, which should be checked
     * @return  Returns true, if input is a valid name, otherwise returns false
     */
    public static function isName($input) {
        return preg_match('/^[a-zA-ZהצüאיטִײÜ ]*$/', $input);
    }
    
    public static function isEmail($input) {
        return preg_match('^[\w][\w_-]*[@][\w-_]+([.][\w-_]+)*$', $input);
    }
}
