<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/8/15
 * Time: 10:14 PM
 */

namespace Calendar;


class TabCalendar extends Calendar{
    /**
     * @var String
     */
    private $location;
    /**
     * @var String
     */
    private $locationTitle;
    /**
     * @var String
     */
    private $contact;
    /**
     * @var String
     */
    private $tabName;

    /**
     * @return String
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param String $location
     * @return self
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return String
     */
    public function getLocationTitle()
    {
        return $this->locationTitle;
    }

    /**
     * @param String $locationTitle
     * @return self
     */
    public function setLocationTitle($locationTitle)
    {
        $this->locationTitle = $locationTitle;
        return $this;
    }

    /**
     * @return String
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param String $contact
     * @return self
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return String
     */
    public function getTabName()
    {
        return $this->tabName;
    }

    /**
     * @param String $tabName
     * @return self
     */
    public function setTabName($tabName)
    {
        $this->tabName = $tabName;
        return $this;
    }



}