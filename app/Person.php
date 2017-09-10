<?php
/**
 * Created by PhpStorm.
 * User: dominic_scimeca
 * Date: 9/10/17
 * Time: 1:10 AM
 */

class Person
{
    private $name;

    private $email;

    private $agency;

    private $focus;

    public function __construct($name, $email, $agency, $focus=null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->agency = $agency;
        $this->focus = $focus;
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
}