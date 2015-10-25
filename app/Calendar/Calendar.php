<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/24/15
 * Time: 11:54 PM
 */

namespace Calendar;


class Calendar {
    private $id;
    private $type;
    private $location;
    private $locationTitle;
    private $contact;

    function __construct($id, $type){
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }



    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getLocationTitle()
    {
        return $this->locationTitle;
    }

    /**
     * @param mixed $locationTitle
     */
    public function setLocationTitle($locationTitle)
    {
        $this->locationTitle = $locationTitle;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }




}