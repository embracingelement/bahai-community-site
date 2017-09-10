<?php

use BCS\BahaiCommunitySiteApp;
use Calendar\Calendar;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/Config/Definitions.php';

$app = new BahaiCommunitySiteApp();

$calendarService = $app->getCalendarService();
$eventView = $app->getEventView();
$registeredCalendars = $app->getRegisteredCalendars();

$activityTypes = $registeredCalendars->getActivityTypes();

$activityTypes = $calendarService->setNeighborhoods($activityTypes);

$tabs = $registeredCalendars->getTabs();

foreach( $tabs as $tab) {
    foreach($tab->getCalendars() as $calendar){
        $calendarService->getUpcomingEvents($calendar);
    }
    $tab->setEvents($calendarService->mergeCalendarsEvents($tab->getCalendars()));

}

$allUpcomingEvents = [];
foreach($activityTypes as $activityType){
    if($activityType->getName() == "All Activities"){
        foreach($activityType->getNeighborhoods() as $neighborhood){
            $allUpcomingEvents = array_merge($allUpcomingEvents, $neighborhood->getEvents());
        }
    }
}

$sortedAllEvents = $calendarService->sortEvents($allUpcomingEvents);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Los Angeles Baha'i Community</title>

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
                <li class="active"><a href="index.php" id="menu-home">Events</a></li>
                <li><a href="#communitylist" id="menu-contacts">Mailing List</a></li>
                <li><a href="#communitycontacts" id="menu-contacts">Contacts</a></li>
                <li><a href="#communitymap" id="menu-contacts">Map</a></li>
                <li><a href="http://www.bahai.org" id="menu-bahai-faith" class="bahai-faith" target="_blank">The Baha'i Faith</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
    <div class="row herophoto"><div class="header-image">
            <div class="headline">
                <h1>Los Angeles Baha'i Community</h1>
                <h4>"To be a Baha'i simply means to love all the world;<br />
                    to love humanity and try to serve it; to work for<br />
                    universal peace and universal brotherhood."</h4>
            </div>
        </div></div>
    <div class="row paddingfifty text-center">
        <div class="container">
            <div class="rowtitle"><h2>Community Events</h2></div>
            <div class="rowdescription">All events are open to the public and free to attend, unless otherwise noted.</div>
            <?php echo $eventView->getTabsHTML($tabs, $sortedAllEvents) ?>
        </div>
    </div>
    <div class="row darkblue paddingfifty text-center" id="communitylist">
        <div class="container">
            <div class="rowtitle"><h2>Community Mailing List</h2></div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-left rowdescription"><p></p></div>
        </div>
    </div>
    <div class="row paddingfifty text-center" id="communitycontacts">
        <div class="container">
            <div class="rowtitle"><h2>Community Contacts</h2></div>
                <table class="table table-expanded table-no-border text-left">
                    <tbody class="blue-striped agencieslist">
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
                                Dena<br/><small>treasurer@labc.org</small><br/><small>323.933.8291 x107</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

        </div>
    </div>
    <div class="row blue paddingfifty text-center" id="communitymap">
        <div class="container">
            <div class="rowtitle"><h2>Community Map</h2></div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-left rowdescription"><p>The Baha'i Community of Los Angeles owns and operates two Centers - the Los Angeles Baha'i Center and the Encino Baha'i Community Center - as indicated by the pins on the map below.</p><p>Additionally, the community is geographically subdivided into four areas - Ala, Nur, Kamal, and Jamal - as indicated by the shaded areas on the map below.</p><p>Click anywhere on the map for more information.</p></div>
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

    $('#chevron-to-neighborhood-activities').click(function(){
        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top
        }, 500);
        return false;
    });

    function scrolloverabit() {
		// $(".scrollable").scrollLeft(4);
		$('#scrollable-losangeles').animate({scrollLeft: $('#scrollable-losangeles').scrollLeft()+4}, 250);
    };
    window.onload = scrolloverabit;
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
				infoWindow.setContent("<div class='text-left infowindow' id='contacts-map-labcpin'><p><h4>Los Angeles Baha'i Center</h4></p><p>5755 Rodeo Road<br/>Los Angeles, CA<br/>90016<br/>Tel: 323.933.8291</p><p><strong>Bookstore</strong><br/>Hours:<br />11am-6pm Tue-Fri<br />11am-3pm Sun<br />Closed Sat & Mon<br/>Tel: 323.933.8291 x109<br/>Web: <a href='http://books.labc.org/' target='_blank'>books.labc.org</a></p><p><strong>Unity Center</strong><br />5753 Rodeo Road<br/>Los Angeles, CA<br/>90016-5013</p></div>");
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
        arrayCheck();
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