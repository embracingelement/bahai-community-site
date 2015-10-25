<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 5:47 PM
 */

namespace Calendar\Event;

use Twig_Environment;

class EventView {
    private $twig;

    function __construct(Twig_Environment $twig){
        $this->twig = $twig;
    }

    public function getEventHTML($eventData, $calendar){
        $events = is_array($eventData) ? $this->sortByFeatured($eventData): [$eventData];
//        print_r("<pre>");
//        print_r($events);

        $html = "";
        foreach($events as $event){
            $html .= $this->generateHTML($event, $calendar);
        }

        return $html;
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

        return $this->twig->render('event.twig',array(
            'event'=> $event,
            'calendar'=>$calendar,
            'featured'=>$featured
        ));
    }

}