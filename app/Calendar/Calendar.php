<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/24/15
 * Time: 11:54 PM
 */

namespace Calendar;


use Calendar\Event\Event;

class Calendar {
    /**
     * @var String
     */
    private $id;
    /**
     * @var Event[]
     */
    private $events;


    /**
     * @param String $id
     */
    function __construct($id){
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param String $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
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
        return crc32($this->id);
    }


}