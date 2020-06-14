<?php
/**
 * Created by PhpStorm.
 * User: dominic_scimeca
 * Date: 9/10/17
 * Time: 1:07 AM
 */
include_once(__DIR__."/../Person.php");

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
    $phone = $raw_membership[4];

    if(!array_key_exists($agency,$memberships)){
        $memberships[$agency] = [];
    }
    array_push($memberships[$agency], new Person($name, $email, $agency, $focus, $phone));
}