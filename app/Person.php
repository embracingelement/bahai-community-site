<?php
/**
 * Created by PhpStorm.
 * User: dominic_scimeca
 * Date: 9/10/17
 * Time: 1:10 AM
 */

class Person
{
    public $name;

    public $email;

    public $agency;

    public $focus;

    public $phone;

    public function __construct($name, $email, $agency, $focus=null, $phone=null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->agency = $agency;
        $this->focus = $focus;
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * @return mixed
     */
    public function getFocus()
    {
        return $this->focus;
    }

    /**
     * @return null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param null $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


}