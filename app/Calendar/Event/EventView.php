<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 5:47 PM
 */

namespace Calendar\Event;

use ActivityType\ActivityType;
use Twig_Environment;

class EventView {
    private $twig;

    function __construct(Twig_Environment $twig){
        $this->twig = $twig;
    }

    public function getTabsHTML($tabs = []){
        return $this->twig->render('tabs/tabs.twig', array("tabs"=>$tabs));
    }

    public function getUpcomingHTML($events = []){
        return $this->twig->render('upcoming/events.twig',array("events"=>$events));
    }

    public function getEventListHTML($neighborhoods){
        return $this->twig->render('list/events.twig', array("neighborhoods"=>$neighborhoods));
    }

    public function getEventJSObject(ActivityType $activityType){
        return $this->twig->render('map/events.json.twig', array("activityType"=>$activityType));
    }

    public function getEventMapHtml(ActivityType $activityType){
        return $this->twig->render('map/events.html.twig', array("activityType"=>$activityType));
    }

}