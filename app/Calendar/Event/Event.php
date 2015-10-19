<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/7/15
 * Time: 10:32 PM
 */

namespace Calendar\Event;

class Event {
    private $title;
    private $description;
    private $location;
    private $startDate;

    /**
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle($title)
    {
        $this->title = $this->filterTitle($title);
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    private function filterTitle($title){
        $title = html_entity_decode(htmlspecialchars_decode($title), ENT_QUOTES);
        $title = str_replace(" - Holy Day on which work is to be suspended", "", $title);
        $title = str_replace("Commemoration", "Commemora-tion", $title);
        $title = str_replace("Commemorating", "Commemorat-ing", $title);

        return $title;
    }
}