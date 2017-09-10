<?php
/**
 * Created by PhpStorm.
 * User: dominic_scimeca
 * Date: 9/9/17
 * Time: 11:14 PM
 */

namespace Flyer;


class Flyer
{
    private $flyer;

    private $thumbnail;

    public function __construct($flyer, $thumbnail=false)
    {
        $this->flyer = $flyer;
        $this->thumbnail = $thumbnail === false ? $flyer : $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getFlyer()
    {
        return $this->flyer;
    }

    /**
     * @return bool
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }


}