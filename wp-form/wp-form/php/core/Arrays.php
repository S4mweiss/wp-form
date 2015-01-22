<?php

/**
 * Arrays holds auxilary functions for handling arrays.
 *
 * @version 0.1
 * @author Samuel Bittmann
 */
class Arrays
{
    /**
     * A static function wich returns the depth of an array
     * @param   $sapmle     (array) The array, which should be examined
     * @return  An integer value representing the depth of the array
     */
    public static function getArrayDepth($sample, $maxDepth = 5) {
        $depth = 1;
        
        if(is_array($sample)) {
            if($maxDepth > 0) {
                foreach($sample as $value) {
                    $depth += self::getArrayDepth($value, $maxDepth-1);
                }
            }
            else {
                $depth = 1;
            }
        }
        else {
            $depth = 0;
        }
        
        return $depth;
    }
}
