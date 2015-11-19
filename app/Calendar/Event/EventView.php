<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 5:47 PM
 */

namespace Calendar\Event;

use ActivityType\ActivityType;
use Calendar\TabCalendar;
use Twig_Environment;

class EventView {
    private $twig;

    function __construct(Twig_Environment $twig){
        $this->twig = $twig;
    }

    public function getEventHTML($eventData, $calendar){
        $events = is_array($eventData) ? $this->sortByFeatured($eventData): [$eventData];

        if(empty($events)){
            return $this->generateEmptyHTML();
        }else {
            $html = "";
            foreach ($events as $event) {
                $html .= $this->generateHTML($event, $calendar);
            }

            return $html;
        }
    }

    /**
     * @param Event[] $events
     * @return Event[]
     */
    private function sortByFeatured($events){
        $featuredEvents = [];
        $otherEvents = [];

        /** @var Event $event */
        foreach($events as $event){
            if($event->isFeatured()){
                $featuredEvents[] = $event;
            }else{
                $otherEvents[] = $event;
            }
        }

        return array_merge($featuredEvents, $otherEvents);
    }


    private function generateHTML(Event $event, $calendar){
        $featured = $event->isFeatured() ? "featured" : "";

        //TODO fix date formatting for start date

        return $this->twig->render('event.twig',array(
            'event'=> $event,
            'calendar'=>$calendar,
            'featured'=>$featured
        ));
    }

    private function generateEmptyHTML(){
        return $this->twig->render('tabs/events.none.twig');
    }

    public function getTabsHTML($calendars = []){
        return $this->twig->render('tabs/tabs.twig', array("calendars"=>$calendars));
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