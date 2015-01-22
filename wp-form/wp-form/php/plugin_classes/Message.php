<?php

/**
 * Objects of this class represent a message left on the contact form.
 *
 * @version 0.1
 * @author Samuel Bittmann
 */
class Message
{
    private $timestamp;
    private $surname;
    private $forname;
    private $email;
    private $phone;
    private $message;
    
    public function __construct($surname, $forname, $email, $phone, $message, $timestamp = DateTime::getTimestamp) {
        $this->timestamp = $timestamp;
        $this->surname = $surname;
        $this->forname = $forname;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
    }
    
    /**
     * Function which returns the contained data as an associative array.
     * @return  (Array) An associative array holding all message information.
     */
    public function getArray() {
        return array(
                        'Time' => $this->timestamp,
                        'Surname' => $this->surname,
                        'Forname' => $this->forname,
                        'Email' => $this->email,
                        'Phone' => $this->phone,
                        'Message' => $this->message
                     );
    }
    
    /**
     * Check, if the contained data is valid.
     * @return  Returns true, if all data is valid, otherwise returns false
     */
    public function checkData() {
        $output = true;
        
        if ($message == "") {
            $output = false;
        } 
        else {
            require_once("/../core/DataChecker.php");
        
            $output &= DataChecker::isName($this->surname);
            $output &= DataChecker::isName($this->forname);
            $output &= DataChecker::isEmail($this->email);
            if ($this->phone != "") {
                $output &= DataChecker::isPhone($this->phone);
            }
        }
        
        return $output;
    }
}
