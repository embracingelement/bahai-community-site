<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/8/15
 * Time: 10:14 PM
 */

namespace Calendar;


use Calendar\Event\Event;

class Tab{
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
     * @var Calendar[]
     */
    private $calendars;
    /**
     * @var Event[]
     */
    private $events;

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

    /**
     * @return Calendar[]
     */
    public function getCalendars()
    {
        return $this->calendars;
    }

    /**
     * @param Calendar[] $calendars
     * @return self
     */
    public function setCalendars($calendars)
    {
        $this->calendars = $calendars;
        return $this;
    }

    /**
     * @return Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param Event[] $events
     * @return self
     */
    public function setEvents($events)
    {
        $this->events = $events;
        return $this;
    }

    public function getHash(){
        return crc32($this->tabName);
    }



}