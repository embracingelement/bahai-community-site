<?php

namespace Calendar;

use ActivityType\ActivityType;

class RegisteredCalendars
{
    /**
     * @var Tab[]
     */
    private $tabs;

    /**
     * @var ActivityType[]
     */
    private $activityTypes;

    /**
     * @var CalendarService
     */
    private $calendarService;

    function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
        $this->setTabs();
//        $this->setActivityTypes();
    }

    function setTabs(){
        $tabCalendars = $this->getTabCalendars();

        $labcTab = new Tab();
        $labcTab
            ->setLocationTitle("LA Baha'i Center")
            ->setLocation("5755 Obama Blvd., Los Angeles, CA 90016")
            ->setContact("Nadia")
            ->setTabName("LA")
            ->setCalendars([$tabCalendars['labc'], $tabCalendars['labcFeast']]);

        $encinoTab = new Tab(); //labc.org_k55hah7gd5ji1jhms75d7b6bh4@group.calendar.google.com
        $encinoTab
            ->setContact("Nadia")
            ->setLocationTitle("Encino Baha'i Community Center")
            ->setLocation("4830 Genesta Ave, Encino, CA 91316")
            ->setTabName("Encino")
            ->setCalendars([$tabCalendars['encinoCenter']]);

        $this->tabs = array(
            $labcTab,
            $encinoTab
        );
    }

    function setActivityTypes(){
        $tabCalendars = $this->getTabCalendars();
        $myCalendarIdsMap = $this->calendarService->getMyCalendarsIdMap();

        $childrensClasses = new ActivityType("Children's Classes");
        $childrensClasses
            ->setLetterName("C")
            ->setCalendars(array(
                new Calendar("mandana@labahais.org"),
                new Calendar("labc.org_2qsns32dv36fc6alg6fa06e0mk@group.calendar.google.com"), // CC - Ala
                new Calendar("hodad@labahais.org"),
                new Calendar("viva@labahais.org"),
                new Calendar("labc.org_3ccu0eei4vi0v5h0go2q8s3gis@group.calendar.google.com"),
                new Calendar($myCalendarIdsMap["Children's Classes"])
            ));

        $juniorYouthGroups = new ActivityType("Junior Youth Groups");
        $juniorYouthGroups
            ->setLetterName("J")
            ->setCalendars(array(
                new Calendar("esperanza@labahais.org"),
                new Calendar("chad@labahais.org"),
                new Calendar("roya@labahais.org"),
                new Calendar("mac@labahais.org"),
                new Calendar($myCalendarIdsMap["Junior Youth Groups"])
            ));

        $studyCircles = new ActivityType("Study Circles");
        $studyCircles
            ->setLetterName("S")
            ->setCalendars(array(
                new Calendar("mona@labahais.org"),
                new Calendar("dominic@labahais.org"),
                new Calendar("kalim@labahais.org"),
                new Calendar("naveed@labahais.org"),
                new Calendar("tannaz@labahais.org"),
                new Calendar($myCalendarIdsMap["Study Circles"])
            ));

        $feasts = new ActivityType("Nineteen Day Feasts");
        $feasts
            ->setLetterName("F")
            ->setCalendars(array(
                new Calendar("erfan@labahais.org"),
                new Calendar("labc.org_qhss3p7qu8uu5a26go4n2b6mao@group.calendar.google.com"),            // ACLC - Feast - Kamal
                new Calendar("nika@labahais.org"),
                new Calendar("touba@labahais.org"),
                new Calendar("labc.org_vd1oen3li3e4t8m4knb9hg7nec@group.calendar.google.com"),
                $tabCalendars['labcFeast'],
                new Calendar($myCalendarIdsMap["Nineteen Day Feasts"])
            ));

        $communityLife = new ActivityType("Community Life");
        $communityLife
            ->setLetterName("L")
            ->setCalendars(array(
                new Calendar("negar@labahais.org"), //Teaching
                new Calendar("divi@labahais.org"), //Teaching
                new Calendar("amin@labahais.org"), //Teaching
                new Calendar("ladan@labahais.org"), //Teaching
                new Calendar("lida@labahais.org"), //Teaching
                new Calendar("labc.org_6kbr02c0eiov42ipcngrrjb41o@group.calendar.google.com"), //Teaching			// ATC - Ala

                new Calendar("labc.org_dgcs32ebtuv1q5kmdd6f26r4g0@group.calendar.google.com"),    // CET
                new Calendar("labc.org_0o3e0ajlg3tj7kqehj4sbmmmuk@group.calendar.google.com"),    // Center - Neighborhood
                new Calendar("labc.org_qe1cin4numuf080rhh3oqnsn38@group.calendar.google.com"),    // ACLC - Jamal
                new Calendar("labc.org_qh1m8alt2a2drrbbgaqtj23tfs@group.calendar.google.com"),    // ACLC - Nur
                new Calendar("labc.org_dh6enfb120t9kf7lmvppkfdop4@group.calendar.google.com"),
                $tabCalendars['labc'], $tabCalendars['encinoCenter'], $tabCalendars['unityCenter']// ACLC - Kamal
                ,
                new Calendar($myCalendarIdsMap["Community Life"])
            ));

        $this->activityTypes = array(
            $childrensClasses,
            $juniorYouthGroups,
            $studyCircles,
            $communityLife,
            $feasts
        );
    }


    /**
     * @return ActivityType[]
     */
    function getActivityTypes()
    {
        return $this->activityTypes;
    }

    /**
     * @return Tab[]
     */
    function getTabs()
    {
        return $this->tabs;
    }

    /**
     * @return mixed
     */
    public function getTabCalendars()
    {
        return [
            "labc" => new Calendar("nadia@labahais.org"),
            "labcFeast" => new Calendar("labc.org_vd1oen3li3e4t8m4knb9hg7nec@group.calendar.google.com"),
            "encinoCenter" => new Calendar("labc.org_k55hah7gd5ji1jhms75d7b6bh4@group.calendar.google.com"),
            "unityCenter" => new Calendar("labc.org_se9o00h6euaf7hlsvcts0r5qag@group.calendar.google.com")
        ];
    }


}