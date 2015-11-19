<?php

namespace Calendar;

use ActivityType\ActivityType;

class RegisteredCalendars
{
    /**
     * @var Calendar[]
     */
    private $tabCalendars;
    /**
     * @var ActivityType[]
     */
    private $activityTypes;

    function __construct()
    {
        $this->setTabCalendars();
        $this->setActivityTypes();
    }

    function setTabCalendars(){
        $labcCalendar = new TabCalendar("nadia@labahais.org");
        $labcCalendar
            ->setLocationTitle("LA Baha'i Center")
            ->setLocation("5755 Rodeo Road, Los Angeles, CA 90016")
            ->setContact("Nadia")
            ->setTabName("LA");

        $encinoCalendar = new TabCalendar("labc.org_k55hah7gd5ji1jhms75d7b6bh4@group.calendar.google.com");
        $encinoCalendar
            ->setContact("Nadia")
            ->setLocationTitle("Encino Baha'i Community Center")
            ->setLocation("4830 Genesta Ave, Encino, CA 91316")
            ->setTabName("Encino");

        $unityCenterCalendar = new TabCalendar("labc.org_se9o00h6euaf7hlsvcts0r5qag@group.calendar.google.com");
        $unityCenterCalendar
            ->setContact("Nadia")
            ->setLocationTitle("Unity Center")
            ->setLocation("5753 Rodeo Road, Los Angeles, CA 90016")
            ->setTabName("Unity Center");

        $this->tabCalendars = array(
            $labcCalendar,
            $encinoCalendar,
            $unityCenterCalendar
        );
    }

    function setActivityTypes(){
        $childrensClasses = new ActivityType("Children's Classes");
        $childrensClasses
            ->setLetterName("C")
            ->setCalendars(array(
                new Calendar("neda@labahais.org"),
                new Calendar("labc.org_49p2gc784mt1jptsk2oaoh7sp8%40group.calendar.google.com"),
                new Calendar("hodad@labahais.org"),
                new Calendar("viva@labahais.org"),
                new Calendar("labc.org_3ccu0eei4vi0v5h0go2q8s3gis%40group.calendar.google.com")
            ));

        $juniorYouthGroups = new ActivityType("Junior Youth");
        $juniorYouthGroups
            ->setLetterName("J")
            ->setCalendars(array(
                new Calendar("esperanza@labahais.org"),
                new Calendar("chad@labahais.org"),
                new Calendar("roya@labahais.org"),
                new Calendar("mac@labahais.org")
            ));

        $studyCircles = new ActivityType("Study Circles");
        $studyCircles
            ->setLetterName("S")
            ->setCalendars(array(
                new Calendar("mona@labahais.org"),
                new Calendar("dominic@labahais.org"),
                new Calendar("kalim@labahais.org"),
                new Calendar("naveed@labahais.org"),
                new Calendar("tannaz@labahais.org")
            ));

        $feasts = new ActivityType("Nineteen Day Feasts");
        $feasts
            ->setLetterName("F")
            ->setCalendars(array(
                new Calendar("erfan@labahais.org"),
                new Calendar("labc.org_qhss3p7qu8uu5a26go4n2b6mao%40group.calendar.google.com"),            // ACLC - Feast - Kamal
                new Calendar("nika@labahais.org"),
                new Calendar("touba@labahais.org"),
                new Calendar("labc.org_vd1oen3li3e4t8m4knb9hg7nec%40group.calendar.google.com")
            ));

        $communityLife = new ActivityType("Community Life");
        $communityLife
            ->setLetterName("L")
            ->setCalendars(array_merge(array(
                new Calendar("negar@labahais.org"), //Teaching
                new Calendar("divi@labahais.org"), //Teaching
                new Calendar("amin@labahais.org"), //Teaching
                new Calendar("ladan@labahais.org"), //Teaching
                new Calendar("lida@labahais.org"), //Teaching
                new Calendar("labc.org_6kbr02c0eiov42ipcngrrjb41o%40group.calendar.google.com"), //Teaching			// ATC - Ala

                new Calendar("labc.org_dgcs32ebtuv1q5kmdd6f26r4g0%40group.calendar.google.com"),    // CET
                new Calendar("labc.org_0o3e0ajlg3tj7kqehj4sbmmmuk%40group.calendar.google.com"),    // Center - Neighborhood
                new Calendar("labc.org_qe1cin4numuf080rhh3oqnsn38%40group.calendar.google.com"),    // ACLC - Jamal
                new Calendar("labc.org_qh1m8alt2a2drrbbgaqtj23tfs%40group.calendar.google.com"),    // ACLC - Nur
                new Calendar("labc.org_dh6enfb120t9kf7lmvppkfdop4%40group.calendar.google.com")    // ACLC - Kamal
            ), $this->getTabCalendars()));

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
     * @return TabCalendar[]
     */
    function getTabCalendars()
    {
        return $this->tabCalendars;
    }
}