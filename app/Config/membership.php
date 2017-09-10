<?php
/**
 * Created by PhpStorm.
 * User: dominic_scimeca
 * Date: 9/10/17
 * Time: 1:07 AM
 */
include_once(__DIR__."/../Person.php");

function pr($object){
    print_r("<pre>");
    print_r($object);
    print_r("</pre>");
}

$raw_memberships = array_map('str_getcsv', file(__DIR__.'/../membership/membership.csv'));

$memberships = [];
foreach($raw_memberships as $index => $raw_membership){
    if($index === 0){
        continue;
    }

    $agency = $raw_membership[0];
    $name = $raw_membership[1];
    $email = $raw_membership[2];
    $focus = $raw_membership[3];

    if(!array_key_exists($agency,$memberships)){
        $memberships[$agency] = [];
    }
    array_push($memberships[$agency], new Person($name, $email, $agency, $focus));
}

//$membership = array(
//    "Area Community Life Committee" => [],
//    "Study Circle Coordinators" => [
//        new Person("Grania McCall" ,"graniamary@gmail.com"),
//        new Person("Naeema Eckfeld", "naeemaeckfeld@gmail.com"),
//        new Person( "Rod Mobini", "rodmobini@gmail.com")
//    ],
//    "Children’s Class Coordinators" => [
//        new Person( "Nabil Maghzi", "nabilgm@gmail.com"),
//        new Person( "Carmel (Saba) Rashidi", "carmel.rashidi@gmail.com")
//    ],
//    "Jr. Youth Group Coordinators" => [
//        new Person( "Shaheen Abkenari", "shaheenabkenari@gmail.com"),
//        new Person( "Mac Heravian", "mac@labahais.org")
//    ],
//    "Cluster Teaching Committee" => array(
//        "Secretary" => new Person( "Ariana Vajdi", "arianavajdi@gmail.com"),
//        "‘Alá" => new Person( "Lida Darabi", "lida@labahais.org"),
//        "Kamál" => new Person( "Ladan Vajdi", "ladan@labahais.org"),
//        "Jamál" => new Person("Nura Darabi", "Bassnurface@gmail.com"),
//        "Núr" => new Person( "Negah Behnam", "negahbehnam@sbcglobal.net")
//    )
//
//);