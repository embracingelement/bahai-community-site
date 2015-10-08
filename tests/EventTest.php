<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/7/15
 * Time: 10:33 PM
 */

require __DIR__ . '/../vendor/autoload.php';

class EventTest extends PHPUnit_Framework_TestCase {


    public function testCreation()
    {
        $event = new \Event();
        $this->assertInstanceOf("Event",$event,"should be an instance of an Event");
    }
}
