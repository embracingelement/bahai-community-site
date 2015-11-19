<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/10/15
 * Time: 10:47 PM
 */

namespace Neighborhood;


use Calendar\Event\Event;

class Neighborhood {
    /**
     * @var String
     */
    private $name;
    /**
     * @var String
     */
    private $location;
    /**
     * @var Event[]
     */
    private $events = array();

    /**
     * @param String $name
     */
    public function __construct($name){
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    public function getId(){
        return crc32($this->name);
    }

    /**
     * @return \Calendar\Event\Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param \Calendar\Event\Event[] $events
     * @return self
     */
    public function setEvents($events)
    {
        $this->events = $events;
        return $this;
    }

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


}