<?php

use BCS\BahaiCommunitySiteApp;
use Calendar\Calendar;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/Config/definitions.php';

$app = new BahaiCommunitySiteApp();

$calendarService = $app->getCalendarService();
$eventView = $app->getEventView();
$registeredCalendars = $app->getRegisteredCalendars();
$flyerService = $app->getFlyerService();

$tabs = $registeredCalendars->getTabs();

foreach( $tabs as $tab) {
    foreach($tab->getCalendars() as $calendar){
        $calendarService->getUpcomingEvents($calendar);
    }
    $tab->setEvents($calendarService->mergeCalendarsEvents($tab->getCalendars()));

}

include_once("../app/Config/membership.php");

function echoAgencyMembershipHTML($people){
    if(!empty($people)){
        foreach($people as $person){
            /** @var Person $person */
            echo "<p>";
            echo $person->getName();
            echo "<br/>";
            if($person->getFocus()){
                echo "(".$person->getFocus().")";
                echo "<br/>";
            }
            echo "<small>".$person->getEmail()."</small>";
            echo "</p>";
        }
    }
}

$flyers = $flyerService->getFlyers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("analyticstracking.php") ?>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCvFFB-0dBzAoHJUZQp8syGAxRJXwXmB-I"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Los Angeles Baha'i Community</title>

    <link href="favicon.png" rel="shortcut icon" type="image/x-icon" />

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap_revised.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/home.css?v17" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:700,100,400|Roboto:900,100,300,700,400' rel='stylesheet' type='text/css'>


    <style type="text/css">
        img[src*="gstatic.com/"], img[src*="googleapis.com/"] {
            max-width: none;
        }
    </style>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-56552635-2', 'auto');
        ga('send', 'pageview');

    </script>
    <script>
        var recaptchaToken = '';
        var form;
        var email;

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function validateEmail(){

            if(isEmail(email.val())){
                $("#email-form-error").hide();
                return true;
            }else{
                $("#email-form-error").show();
                return false;
            }
        }

        $(function() {
            form = $("#mailing-list-form");
            email = $("#email-form-field");

            email.blur(function(){
                console.log('blur');

                validateEmail();
            }).change(function(){
                console.log('change');

                validateEmail()
            });

            form.submit(function (event) {
                event.preventDefault();
                event.stopPropagation();

                if(validateEmail()) {
                    console.log('submitting');

                    var email_address = email.val();
                    $.ajax({
                        url: "mailinglistsignup.php",
                        data: {
                            "email": email_address,
                            "g-recaptcha-response": recaptchaToken
                        },
                        type: "POST",
                        success: function (response) {
                            console.log(response);
                            $("#mailing-list-form").hide()
                            if ("success" == response) {
                                $("#mailing-list-form-thank-you").show();
                            } else {
                                $("#mailing-list-form-error").show();
                            }
                        }
                    })
                }
            });
        });

        function checkRecaptcha(token) {
            recaptchaToken = token;
            console.log(token);
            form.submit();
        }
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button class="navbar-toggle navbanner" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="menu">Menu</span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" style="background: rgba(255,255,255,0.8);">
                <li class="active"><a href="#events" id="menu-home">Events</a></li>
				<li><a href="#communitylist" id="menu-list">Mailing List</a></li>
                <li><a href="#communitycontacts" id="menu-contacts">Contacts</a></li>
                <li><a href="#communitymap" id="menu-map">Map</a></li>
                <li><a href="http://www.bahai.org" id="menu-bahai-faith" class="bahai-faith" target="_blank">The Baha'i Faith</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container-fluid" style="padding: 0;">
    <div class="row herophoto bicentenary">
		<div class="headline bicentenary">

        </div>
    </div>
</div>
<div style="" class="bicentenary-videos">
    <div class="video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/6gDBU-8UzEo?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>        <div class="title">Los Angeles Bicentenary Celebration</div>
    </div>
    <div class="video">
        <a href="img/Congratulations-from-the-LA-Mayors-Office.jpg" target="_blank">
            <img src="img/Congratulations-from-the-LA-Mayors-Office-sm.jpg" alt="" style="height: 315px;">
            <div class="title">Congratulations from the LA Mayor's office</div>
        </a>
    </div>
    <div class="video">
        <a href="img/California-Legislature-Resolution.jpg" target="_blank">
            <img src="img/California-Legislature-Resolution-sm.jpg" alt="" style="height: 315px;">
            <div class="title">California Legislature Resolution</div>
        </a>
    </div>
<!--    <div class="video">
<!--        <iframe width="560" height="315" src="https://www.youtube.com/embed/Ku6BmiVbSnc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
<!--        <div class="title">A message from Eric Garcetti, Mayor of Los Angeles</div>
<!--    </div> -->
</div>
        <div class="row paddingtwenty text-center">
        <div class="container" style="padding: 0;">
            <a href="http://www.bahai.org/"><img src="img/whatnew.jpg" alt="baha'is believe" style="width:100%;height:auto;padding:25px;padding-top:100px;"></a>
                       
        </div>
    </div>
    <div class="row paddingfifty text-center" id="events">
        <div class="container">
            <div class="rowtitle"><h2>Community Events</h2></div>
            <div class="rowdescription">All events are open to the public and free to attend, unless otherwise noted.</div>
            <?php echo $eventView->getTabsHTML($tabs, $sortedAllEvents, $flyers) ?>
        </div>
    </div>
    <div class="row darkblue paddingfifty text-center" id="communitylist">
        <div class="container">
            <div class="rowtitle"><h2>Community Mailing List</h2></div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-left rowdescription">
                <form action="mailinglistsignup.php" id="mailing-list-form" novalidate>
                    <div class="form-group">
                        <label for="email-form-field">Please enter your email address:</label>
                        <input type="email" class="form-control" id="email-form-field" aria-describedby="Enter your email" placeholder="Enter email" required>
                        <div class="invalid-feedback" id="email-form-error" style="font-style: italic; display: none">
                            <p>Please enter a valid email.</p>
                        </div>
                    </div>
					<div class="text-center"> 
						<button
								class="g-recaptcha btn btn-default"
								data-sitekey="6LdJXjEUAAAAAD2dSAjs0FKs6bAebBnRuMa9wPSr"
								data-callback="checkRecaptcha">
							Subscribe
						</button>
					</div>
                </form>
                <p style="display: none" id="mailing-list-form-thank-you">Thank you, we will get back to you shortly.<br /><br />If you need further help, please contact Nadia by e-mail at <a href="mailto:mis@labc.org" style="color: white; text-decoration: underline;">mis@labc.org</a>, or by phone at 323.933.8291 x102.</p>
                <p style="display: none" id="mailing-list-form-error">We're sorry, but there's been an error.<br /><br />Please contact Nadia by e-mail at <a href="mailto:mis@labc.org" style="color: white; text-decoration: underline;">mis@labc.org</a>, or by phone at 323.933.8291 x102.</p>
            </div>
        </div>
    </div>
    <div class="row paddingfifty text-center" id="communitycontacts">
        <div class="container">
            <div class="rowtitle"><h2>Community Contacts</h2></div>
            <div class="row text-center">
                <div class="tabbable">
                    <div class="container">
                        <ul class="nav nav-tabs centerthetabs">
                            <li class="active"><a href="#tab3" data-toggle="tab" id="contacts-communityoffices">Baha'i Center</a></li>
                            <li><a href="#tab4" data-toggle="tab" id="contacts-communityagencies">Agencies</a></li>
                            <li><a href="#tab5" data-toggle="tab" id="contacts-communityreps">Reps</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab3">
                            <div class="container">
                                <table class="table table-expanded table-no-border text-left">

                                    <tbody class="blue-striped agencieslist">
									<tr>
                                        <td>
                                            <strong>Bookstore</strong>
											<ul>
                                                <li>Web: <a href="http://books.labc.org" target="_blank">books.labc.org</a></li>
                                            </ul>
                                            Hours:
                                            <ul>
                                                <li>11am-6pm Tue-Fri</li>
                                                <li>11am-3pm Sun</li>
												<li>Closed Sat & Mon</li>
                                            </ul>
											
                                        </td>
                                        <td>
                                            Judy<br/><small>323.933.8291 x109</small>
                                        </td>
                                    </tr>
                                      <tr>
                                        <td>
                                            <strong>Secretariat</strong>
                                            <ul>

                                                <li>correspondence intended for the Spiritual Assembly</li>
                                                <li>administrative assistance with Baha'i marriages</li>
                                                <li>Baha'i burial information</li>
                                            </ul>
                                        </td>
                                        <td>
                                            Deborah<br/><small>secretariat@labc.org</small><br/><small>323.933.8291 x104</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Membership Information Services</strong>
                                            <ul>
                                                <li>Baha'is moving into or out of Los Angeles</li>
                                                <li>changing mailing address and/or contact information</li>
                                                <li>email list management</li>
                                                <li>Baha'i births and deaths</li>
                                            </ul>
                                        </td>
                                        <td>
                                            Nadia<br/><small>mis@labc.org</small><br/><small>323.933.8291 x102</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Center Scheduling and Operations</strong>
                                            <ul>
                                                <li>Los Angeles Baha'i Center</li>
                                                <li>Encino Baha'i Community Center</li>
                                                <li>Unity Center</li>
                                            </ul>
                                        </td>
                                        <td>
                                            Nadia<br/><small>mis@labc.org</small><br/><small>323.933.8291 x102</small>
                                        </td>
                                    </tr>
                                    <?php /**
                                     * @var $treasuresOfficePerson Person
                                     */
                                        $treasuresOfficePerson = $memberships["Treasurer's Office"][0]; ?>
									<tr>
                                        <td>
                                            <strong>Treasurer's Office</strong>
                                            <ul>
                                                <li>Baha'i Fund</li>
                                            </ul>
                                            Please note:
                                            <ul>
                                                <li>Only Baha'is may contribute to the Baha'i Fund.</li>
                                                <li>Donations from groups and individuals who are not Baha'i are neither solicited nor accepted.</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <?= $treasuresOfficePerson->getName() ?><br/>
                                            <small><?= $treasuresOfficePerson->getEmail() ?></small><br/>
                                            <small><?= $treasuresOfficePerson->getPhone() ?></small>
                                        </td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class="container">
                                <table class="table table-expanded table-no-border text-left">

                                    <tbody class="blue-striped agencieslist">
                                    <tr>
                                        <td>
                                            <strong>Office of Public Information</strong>
                                            <ul>
                                                <li>Coordinates media requests.</li>
                                            </ul>
                                        </td>
                                        <td>
                                            Randy<br/><small>randy@labc.org</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Community Life</strong>
                                            <ul>
                                                <li>Increases the vitality of the spiritual and social life of the community.</li>
                                                <li>Welcomes new Baha'is.</li>
                                                <li>Organizes neighborhood-wide and area-wide Nineteen Day Feasts.</li>
                                                <li>Organizes neighborhood-wide Holy Day events for the Ascension of Baha'u'llah, the Ascension of `Abdu'l-Baha, and the 9th Day of Ridvan.</li>
                                                <li>Organizes area-wide social activities.</li>
                                                <li>Tends to the needs of the sick and ailing.</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <?php echoAgencyMembershipHTML($memberships["Area Community Life Committee"]) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Teaching</strong>
                                            <li>Facilitates and oversees gatherings for reflection on, and review of, efforts to transform the spiritual life of Los Angeles neighborhoods.</li>
                                            <li>Coordinates all devotional gatherings in Los Angeles.</li>
                                        </td>
                                        <td>
                                            <?php echoAgencyMembershipHTML($memberships["Cluster Teaching Committee"]) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Children's Classes</strong>
                                            <li>Coordinates all children's classes in Los Angeles.</li>
                                        </td>
                                        <td>
                                            <?php echoAgencyMembershipHTML($memberships["Children's Class Coordinators"]) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Junior Youth Groups</strong>
                                            <li>Coordinates all junior youth groups in Los Angeles.</li>
                                        </td>
                                        <td>
                                            <?php echoAgencyMembershipHTML($memberships["Jr. Youth Group Coordinators"]) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Study Circles</strong>
                                            <li>Coordinates all Baha'i study circles in Los Angeles.</li>
                                        </td>
                                        <td>
                                            <?php echoAgencyMembershipHTML($memberships["Study Circle Coordinators"]) ?>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab5">
                            <div class="container">
                                <table class="table table-expanded table-no-border text-left">

                                    <tbody class="blue-striped agencieslist">
                                    <tr>
                                        <td>
                                            <strong>Inter-Religious Council</strong>
                                        </td>
                                        <td>
                                            Randy<br/><small>randy@labc.org</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><em>Please contact the Los Angeles Baha'i Center if you wish to contact any of the Representatives listed below.</em></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>United Nations Association</strong>
                                        </td>
                                        <td>
                                            Barbara
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>USC Religious Directors Association</strong>
                                        </td>
                                        <td>
                                            Tim
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Women's Interfaith Committee</strong>
                                        </td>
                                        <td>
                                            Allison
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Valley Interfaith Council</strong>
                                        </td>
                                        <td>
                                            Key
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row blue paddingfifty text-center" id="communitymap">
        <div class="container">
            <div class="rowtitle"><h2>Community Map</h2></div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-left rowdescription"><p>The Baha'i Community of Los Angeles owns and operates two Centers - the <strong>Los Angeles Baha'i Center</strong> and the <strong>Encino Baha'i Community Center</strong> - as indicated by the pins on the map below.</p><p>Additionally, the community is geographically subdivided into four areas - <strong>"Ala"</strong>, <strong>"Nur"</strong>, <strong>"Kamal"</strong>, and <strong>"Jamal"</strong> - as indicated by the shaded areas on the map below.</p><p>For your convenience, the <strong>Santa Monica Baha'i Center</strong>, which is owned and operated by the <a href="http://www.santamonicabahai.org" target="_blank" style="color: white; text-decoration: underline;">Baha'i Community of Santa Monica</a>, is also included on the map below, as are the email contacts we have on hand for the Baha'i Communities that lie just outside our city limits.</p><p>Click anywhere on the map for more information.</p></div>
        </div>
    </div>
    <div class="row text-center">
        <div id="map-canvas"></div>
    </div>
</div>

<script type="text/javascript">
    <?php foreach($tabs as $tab){ ?>
        $('#left-scroll-<?php echo $tab->getHash() ?>').click(function () {
            $('#scrollable-<?php echo $tab->getHash() ?>').animate({scrollLeft: $('#scrollable-<?php echo $tab->getHash() ?>').scrollLeft()-285}, 250);
        });
        $('#right-scroll-<?php echo $tab->getHash() ?>').click(function () {
            $('#scrollable-<?php echo $tab->getHash() ?>').animate({scrollLeft: $('#scrollable-<?php echo $tab->getHash() ?>').scrollLeft()+285}, 250);
        });
    <?php } ?>
    $('#left-scroll-upcoming').click(function () {
        $('#scrollable-upcoming').animate({scrollLeft: $('#scrollable-upcoming').scrollLeft()-285}, 250);
    });
    $('#right-scroll-upcoming').click(function () {
        $('#scrollable-upcoming').animate({scrollLeft: $('#scrollable-upcoming').scrollLeft()+285}, 250);
    });
    $('#left-scroll-flyers').click(function () {
        $('#scrollable-flyers').animate({scrollLeft: $('#scrollable-flyers').scrollLeft()-285}, 250);
    });
    $('#right-scroll-flyers').click(function () {
        $('#scrollable-flyers').animate({scrollLeft: $('#scrollable-flyers').scrollLeft()+285}, 250);
    });

    $('#chevron-to-neighborhood-activities').click(function(){
        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top
        }, 500);
        return false;
    });

    function scrolloverabit() {
		$(".scrollable").scrollLeft(4);
		// $('#scrollable-losangeles').animate({scrollLeft: $('#scrollable-losangeles').scrollLeft()+4}, 250);
    };
    window.onload = scrolloverabit;
</script>
<script>
$('#menu-list').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});
$('#menu-contacts').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});
$('#menu-map').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});
$('#menu-home').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});
$( ".tab-pane" ).delegate( ".tab-location-contact-info", "click", function() {
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});
</script>
<script>
		var map;

		var labcLatlng = new google.maps.LatLng(34.021854,-118.371388);		
		var encinoLatlng = new google.maps.LatLng(34.158773,-118.502741);
		var santamonicaLatlng = new google.maps.LatLng(34.0346509,-118.4658966);

		function initialize() {
		    var mapOptions = {
		        zoom: 10,
		        center: {
		            lat: 34.052156,
		            lng: -118.378969
		        },
		        panControl: false,
		        zoomControl: true,
		        mapTypeControl: false,
		        scaleControl: false,
		        streetViewControl: false,
		        overviewMapControl: false,
		        scrollwheel: false,
		        disableDoubleClickZoom: true
		    };
			
		    // Create a simple map.
		    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);


		    // Load a GeoJSON from the same server as our demo.
		    map.data.loadGeoJson('maps/apc-combined.json');
			map.data.loadGeoJson('maps/el-segundo-la-county-neighborhood-current.geojson');
			// map.data.loadGeoJson('maps/aminle-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/hidden-hills-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/huntington-park-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/inglewood-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/lomita-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/long-beach-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/lynwood-la-county-neighborhood-current.geojson');
			// map.data.loadGeoJson('maps/montebello-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/monterey-park-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/pasadena-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/rancho-palos-verdes-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/san-fernando-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/santa-monica-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/south-gate-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/south-pasadena-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/torrance-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/vernon-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/west-hollywood-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/alhambra-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/beverly-hills-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/burbank-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/calabasas-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/carson-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/commerce-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/culver-city-la-county-neighborhood-current.geojson');
			map.data.loadGeoJson('maps/gardena-la-county-neighborhood-current.geojson');

		    // Load GeoJSON.
		    map.data.loadGeoJson('https://storage.googleapis.com/maps-devrel/google.json');

		    infoWindow = new google.maps.InfoWindow({
		        content: "",
				maxWidth: 400
		    });

		    map.data.setStyle(function(feature) {
		        var APC = feature.getProperty('APC');
		        var color = APC == "North Valley" ? '#99CC66' :
		            APC == "South Valley" ? '#336600' :
		            APC == "West Metro" ? '#6699CC' :
		            APC == "East Metro" ? '#003366' :
		            '#FFFFFF';
		        return {
		            fillColor: color,
		            strokeWeight: 0,
		        };


		    });

		    // Set mouseover event for each feature.
		    // When the user hovers, tempt them to click by outlining the letters.
		    // Call revertStyle() to remove all overrides. This will use the style rules
		    // defined in the function passed to setStyle()
		    map.data.addListener('mouseover', function(event) {
		        var APC = event.feature.getProperty('APC');
		        var color = APC == "North Valley" ? '#FFFF00' :
		            APC == "South Valley" ? '#FFFF00' :
		            APC == "West Metro" ? '#FFFF00' :
		            APC == "East Metro" ? '#FFFF00' :
		            '#FFFF99';
		        map.data.revertStyle();
		        map.data.overrideStyle(event.feature, {
		            fillColor: color,
		            strokeWeight: 4
		        });
		    });

		    map.data.addListener('mouseout', function(event) {
		        map.data.revertStyle();
		    });

		    map.data.addListener('click', function(event) {
		        //show an infowindow on click
				if (event.feature.getProperty("APC") == undefined) {
					var cityname = event.feature.getProperty("name");
					var cityemail = cityname == "Santa Monica" ? "info@santamonicabahai.org" :
						cityname == "Beverly Hills" ? "payam@beverlyhillsbahai.org" :
						cityname == "Culver City" ? "lsaculvercity@gmail.com" :
						cityname == "Inglewood" ? "inglewoodlsa@gmail.com" :
						cityname == "Carson" ? "carsoncalsa@gmail.com" :
						cityname == "Long Beach" ? "longbeachlsa@gmail.com" :
						cityname == "Calabasas" ? "calabasasbahaisecretary@gmail.com" :
						cityname == "Monterey Park" ? "bahaisofmpark@gmail.com" :
						cityname == "Burbank" ? "burbankbahais@gmail.com" :
						cityname == "Aminle" ? "aminlelsa@gmail.com" :
						cityname == "Pasadena" ? "lsa@pasadenabahai.org" :
						cityname == "Rancho Palos Verdes" ? "ranchopalosverdesbahais@yahoo.com" :
						"";
					
					var citycontact = "";
					
					if (cityemail != "") {
						citycontact = "<p>For more information on the Baha'i Community of " + event.feature.getProperty("name") + ", please send an e-mail to <a id='contacts-map-" + event.feature.getProperty("name") + "-email' target='_blank' href='mailto:" + cityemail + "'>" + cityemail + "</a>.</p>";
					}
				
					infoWindow.setContent("<div class='text-left infowindow' id='contacts-map-" + event.feature.getProperty("name").replace(" ", "-") + "'><p><h4>" + event.feature.getProperty("name") + "</h4></p><p>For practical purposes, Baha'i communities are organized by city boundary lines, and " + event.feature.getProperty("name") + " is an incorporated stand-alone city adjacent to, but outside of, the City of Los Angeles.</p>" + citycontact + "</div>");
				}
		        else {
					var areaname = event.feature.getProperty("APC");
					var areacontacts = areaname == "East Metro" ?
																"<table class='table'>" +
																"<tbody class='blue-striped' id='contacts-map-eastla-coordinators'>" +
																"<tr><td>Children's Classes</td><td><a target='_blank' href='mailto:touba@labahais.org'>Touba</a></td></tr>" +
																"<tr><td>Junior Youth Groups</td><td><a target='_blank' href='mailto:mac@labahais.org'>Mac</a></td></tr>" + 
																"<tr><td>Study Circles</td><td><a target='_blank' href='mailto:naveed@labahais.org'>Naveed</a></td></tr>" + 
																"<tr><td>Devotional Gatherings</td><td><a target='_blank' href='mailto:amin@labahais.org'>Amin</a></td></tr>" + 
																"</tbody></table>" :
						areaname == "West Metro" ?
																"<table class='table'>" +
																"<tbody class='blue-striped' id='contacts-map-westla-coordinators'>" +
																"<tr><td>Children's Classes</td><td><a target='_blank' href='mailto:hodad@labahais.org'>Hoda</a></td></tr>" +
																"<tr><td>Junior Youth Groups</td><td><a target='_blank' href='mailto:roya@labahais.org'>Roya</a></td></tr>" + 
																"<tr><td>Study Circles</td><td><a target='_blank' href='mailto:kalim@labahais.org'>Kalim</a></td></tr>" + 
																"<tr><td>Devotional Gatherings</td><td><a target='_blank' href='mailto:ladan@labahais.org'>Ladan</a></td></tr>" + 
																"</tbody></table>" :
						areaname == "North Valley" ?
																"<table class='table'>" +
																"<tbody class='blue-striped' id='contacts-map-northvalley-coordinators'>" +
																"<tr><td>Children's Classes</td><td><a target='_blank' href='mailto:mandana@labahais.org'>Mandana</a></td></tr>" +
																"<tr><td>Junior Youth Groups</td><td></td></tr>" + 
																"<tr><td>Study Circles</td><td><a target='_blank' href='mailto:mona@labahais.org'>Mona</a></td></tr>" + 
																"<tr><td>Devotional Gatherings</td><td><a target='_blank' href='mailto:lida@labahais.org'>Lida</a></td></tr>" + 
																"</tbody></table>" :
						areaname == "South Valley" ?
																"<table class='table'>" +
																"<tbody class='blue-striped' id='contacts-map-southvalley-coordinators'>" +
																"<tr><td>Children's Classes</td><td><a target='_blank' href='mailto:mandana@labahais.org'>Mandana</a></td></tr>" +
																"<tr><td>Junior Youth Groups</td><td><a target='_blank' href='mailto:chad@labahais.org'>Chad</a></td></tr>" + 
																"<tr><td>Study Circles</td><td><a target='_blank' href='mailto:dominic@labahais.org'>Dominic</a></td></tr>" + 
																"<tr><td>Devotional Gatherings</td><td><a target='_blank' href='mailto:divi@labahais.org'>Divi</a></td></tr>" + 
																"</tbody></table>" :

						"";
					
					var feastcontact = areaname == "East Metro" ? "Touba" :
						areaname == "West Metro" ? "Talisa" :
						areaname == "North Valley" ? "Erfan" :
						areaname == "South Valley" ? "Nika" :
						"";
					
					if (feastcontact != "") {
						// feastcontact = "<p>If you're a Baha'i living in this area and want more information about area and neighborhood Nineteen Day Feasts, please contact " + feastcontact + " at <a target='_blank' id='contacts-map-" + feastcontact.toLowerCase() + "@labahais.org' href='mailto:" + feastcontact.toLowerCase() + "@labahais.org'>" + feastcontact.toLowerCase() + "@labahais.org</a>.</p>";
					}
				
					infoWindow.setContent("<div class='text-left infowindow' id='contacts-map-" + event.feature.getProperty("APC").replace(" ", "-") + "'><p><h4>Los Angeles - \"" + event.feature.getProperty("APC").replace("East Metro", "Jamal").replace("West Metro", "Kamal").replace("North Valley", "Ala").replace("South Valley", "Nur") + "\" Area<br /><small>" + event.feature.getProperty("NAME_ALF") + "</small></h4></p><p>Baha'is are working to transform the spiritual life of Los Angeles through children's classes, junior youth groups, study circles, and devotional gatherings.</p>To get involved with one of these activities in the \"" + event.feature.getProperty("APC").replace("East Metro", "Jamal").replace("West Metro", "Kamal").replace("North Valley", "Ala").replace("South Valley", "Nur") + "\" area of Los Angeles, please contact Nadia at <a href='mailto:nadia@labahais.org'>nadia@labahais.org</a>.</p></div>"); //+ event.feature.getProperty("APC") + " coordinator:</p>" + areacontacts + feastcontact + "</div>");
				}
		        var anchor = new google.maps.MVCObject();
		        anchor.set("position", event.latLng);
		        infoWindow.open(map, anchor);
		    });

		    var styles = [{
		        "stylers": [{
		            "hue": "#99CCFF"
		        }, {
		            "saturation": -50
		        }]
		    }, {
		        "featureType": "road",
		        "elementType": "geometry",
		        "stylers": [{
		            "lightness": 100
		        }, {
		            "visibility": "simplified"
		        }]
		    }, {
		        "featureType": "transit",
		        "stylers": [{
		            "visibility": "off"
		        }]
		    }, {
		        "featureType": "poi",
		        "stylers": [{
		            "visibility": "off"
		        }]
		    }, {
		        "featureType": "road",
		        "elementType": "labels.icon",
		        "stylers": [{
		            "visibility": "off"
		        }]
		    }, {
		        "featureType": "road",
		        "elementType": "labels.text",
		        "stylers": [{
		            "visibility": "simplified"
		        }]
		    }, {
		        "featureType": "administrative.neighborhood",
		        "stylers": [{
		            "visibility": "off"
		        }]
		    }, {
		        "featureType": "administrative.land_parcel"
		    }, {
		        "featureType": "landscape.man_made"
		    }];

		    map.setOptions({
		        styles: styles
		    });
			
			var labcmarker = new google.maps.Marker({
				position: labcLatlng,
				map: map,
				icon: "http://chart.apis.google.com/chart?chst=d_map_spin&chld=1.25|0|FFFF00|9|_|LA",
				title:"Los Angeles Baha'i Center"
			});
			
			// To add the marker to the map, call setMap();
			labcmarker.setMap(map);
			
			var encinomarker = new google.maps.Marker({
				position: encinoLatlng,
				map: map,
				icon: "http://chart.apis.google.com/chart?chst=d_map_spin&chld=1.25|0|FFFF00|9|_|Encino",
				title:"Encino Baha'i Community Center"
			});

			// To add the marker to the map, call setMap();
			encinomarker.setMap(map);
			
			var santamonicamarker = new google.maps.Marker({
				position: santamonicaLatlng,
				map: map,
				icon: "http://chart.apis.google.com/chart?chst=d_map_spin&chld=1.25|0|FFFF00|9|_|Santa|Monica",
				title:"Santa Monica Baha'i Center"
			});

			// To add the marker to the map, call setMap();
			santamonicamarker.setMap(map);
		
			google.maps.event.addListener(labcmarker, 'click', function() {
				infoWindow.setContent("<div class='text-left infowindow' id='contacts-map-labcpin'><p><h4>Los Angeles Baha'i Center</h4></p><p>5755 Obama Blvd.<br/>Los Angeles, CA<br/>90016<br/>Tel: 323.933.8291</p><p><strong>Bookstore</strong><br/>Hours:<br />11am-6pm Tue-Fri<br />11am-3pm Sun<br />Closed Sat & Mon<br/>Tel: 323.933.8291 x109<br/>Web: <a href='http://books.labc.org/' target='_blank'>books.labc.org</a></p><p><strong>Unity Center</strong><br />5753 Rodeo Road<br/>Los Angeles, CA<br/>90016-5013</p></div>");
				infoWindow.open(map,labcmarker);
			});
			google.maps.event.addListener(encinomarker, 'click', function() {
				infoWindow.setContent("<div class='text-left infowindow' id='contacts-map-encinopin'><p><h4>Encino Baha'i Community Center</h4></p><p>4830 Genesta Ave<br/>Encino, CA<br/>91316<br/>Tel: 818.981.7550</p></div>");
				infoWindow.open(map,encinomarker);
			});
			google.maps.event.addListener(santamonicamarker, 'click', function() {
				infoWindow.setContent("<div class='text-left infowindow' id='contacts-map-santamonicapin'><p><h4>Santa Monica Baha'i Center</h4></p><p><em>The Santa Monica Baha'i Center is owned and operated by our sister community in Santa Monica. Its contact information is provided here for your convenience.</em></p><p>3102 Colorado Avenue<br/>Santa Monica, CA<br/>90404<br/>Tel: 310.394.7971<br />Web: <a href='http://www.santamonicabahai.org' target='_blank'>www.santamonicabahai.org</a><br />E-mail: <a href='mailto:info@santamonicabahai.org'>info@santamonicabahai.org</a></p></div>");
				infoWindow.open(map,santamonicamarker);
			});
		}

		google.maps.event.addDomListener(window, 'load', initialize);
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $(".popoverex a").popover({
            placement : 'top'
        });
        $(".popoverex button").popover({
            placement : 'top'
        });
        $(".tooltipex a").tooltip();
    });
</script>
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
    var sc_project=8795522;
    var sc_invisible=1;
    var sc_security="e0303a8a";
    var scJsHost = (("https: " == document.location.protocol) ? "https://secure.":"http://www.");
    document.write("<sc" + "ript type='text/javascript' src='" + scJsHost +
    "statcounter.com/counter/counter.js'></" + "script>");
</script>
<noscript>
    <div class="statcounter">
        <a href="http://statcounter.com/" target="_blank" title="web analytics"><img alt="web analytics" class="statcounter" src="http://c.statcounter.com/8795522/0/e0303a8a/1/"></a>
    </div>
</noscript>

<!-- End of StatCounter Code for Default Guide -->

</body>

</html>
