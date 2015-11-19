<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/10/15
 * Time: 10:12 PM
 */

namespace ActivityType;

use Calendar\Calendar;
use Neighborhood\Neighborhood;

class ActivityType {
    /**
     * @var String
     */
    private $name;
    /**
     * @var String
     */
    private $letterName;
    /**
     * @var Calendar[]
     */
    private $calendars;
    /**
     * @var Neighborhood[]
     */
    private $neighborhoods = [];

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

    /**
     * @return String
     */
    public function getLetterName()
    {
        return $this->letterName;
    }

    /**
     * @param String $letterName
     * @return self
     */
    public function setLetterName($letterName)
    {
        $this->letterName = $letterName;
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
     * @return \Neighborhood\Neighborhood[]
     */
    public function getNeighborhoods()
    {
        return $this->neighborhoods;
    }

    /**
     * @param \Neighborhood\Neighborhood[] $neighborhoods
     * @return self
     */
    public function setNeighborhoods($neighborhoods)
    {
        $this->neighborhoods = $neighborhoods;
        return $this;
    }

    public function getId(){
        return crc32($this->name);
    }
}