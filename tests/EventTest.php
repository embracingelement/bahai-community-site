<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/7/15
 * Time: 10:33 PM
 */

use Calendar\Event\Event;

require __DIR__ . '/../vendor/autoload.php';

class EventTest extends PHPUnit_Framework_TestCase {


    public function testCreation()
    {
        $event = new Event();
        $this->assertInstanceOf(get_class($event), $event, "should be an instance of an Event");
    }
}
