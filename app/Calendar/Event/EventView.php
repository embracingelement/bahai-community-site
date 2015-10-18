<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 5:47 PM
 */

namespace Calendar\Event;


class EventView {
    public function getEventHTML(Event $event){
        $html = "<li>";
        $html.= "<h4>".$event->getTitle()."</h4>";
        $html.= "<p>Start Date : ".$event->getStartDate()."</p>";
        $html.= "</li>";
        return $html;
    }
}