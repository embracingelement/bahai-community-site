<?php

use BCS\BahaiCommunitySiteApp;
use Calendar\Calendar;

require '../vendor/autoload.php';
require '../app/Config/Definitions.php';

function pr($object){
    print_r("<pre>");
    print_r($object);
    print_r("</pre>");
}

$app = new BahaiCommunitySiteApp();

$calendarService = $app->getCalendarService();
$eventView = $app->getEventView();
$registeredCalendars = $app->getRegisteredCalendars();

$activityTypes = $registeredCalendars->getActivityTypes();

$activityTypes = $calendarService->setNeighborhoods($activityTypes);

$tabCalendars = $registeredCalendars->getTabCalendars();

foreach( $tabCalendars as $tabCalendar) {
    $calendarService->getUpcomingEvents($tabCalendar);
}
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
    <link href="css/home.css?v16" rel="stylesheet">

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
                <li class="active"><a href="index.php" id="menu-home">Home</a></li>
                <li class="disabled"><a href="">About Us</a></li>
                <li class="disabled"><a href="">The Baha'i Faith</a></li>
                <li class="disabled"><a href="">Get Involved</a></li>
                <li><a href="contact.php" id="menu-contacts">Contacts</a></li>
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
            <div class="rowtitle"><h2>Baha'i Center Events</h2></div>
            <div class="rowdescription">All events are open to the public and free to attend, unless otherwise noted.</div>
            <?php echo $eventView->getTabsHTML($tabCalendars) ?>
            <div class="rowdown"><h1><a href="#neighborhoodactivities" title="Scroll down for Neighborhood Activities" id="chevron-to-neighborhood-activities"><span class="glyphicon glyphicon-chevron-down"></span></a></h1></div>
        </div>
    </div>
    <div class="row blue paddingfifty text-center" id="neighborhoodactivities">
        <div class="container">
            <div class="rowtitle"><h2>Neighborhood Activities</h2></div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-left rowdescription"><p>Baha'is believe that the peace and security of humankind can only be achieved through spiritual means, so they are working to transform the spiritual lives of their neighborhoods through four core activities: moral education classes for children, empowerment and leadership training for junior youth, service and study groups for youth and adults, and devotional gatherings where communities can pray and meditate together.</p><p>Other activities are also listed below for your convenience.</p><p>All events are open to the public and free to attend, unless otherwise noted.</p></div>
        </div>
    </div>
    <div class="row blue text-center">
        <div class="tabbable">
            <div class="container">
                <ul class="nav nav-tabs blue-nav-tabs centerthetabs">
                    <li class="active"><a href="#tab1" role="tab" data-toggle="tab" id="activities-activitiesmap">Map View</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">List View <b class="caret"></b></a>
                        <ul class="dropdown-menu text-left">
                            <?php foreach($activityTypes as $activityType){ ?>
                                <li>
                                    <a href="#map-tab-<?php echo $activityType->getId(); ?>" data-toggle="tab">
                                        <?php echo $activityType->getName(); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div id="map-canvas"></div>
                <div class="filters text-left">
                    <button type="button" class="close" data-toggle="collapse" data-target="#filterinput" style="margin-right:-20px; margin-top: -5px;" aria-expanded="true" aria-controls="filterinput"><span class="caret"></span></button>
                    <div id="filterinput" class="collapse in">
                        <div class="filtersheader">Show the<br />following:</div>
                        <form>
                            <ul>
                                <?php foreach($activityTypes as $activityType){ ?>
                                    <li class="mapfilter" white-space="nowrap">
                                        <input type="radio" name="filterType" id="<?php echo $activityType->getLetterName(); ?>-filter" class="<?php echo $activityType->getLetterName(); ?>-filter" <?php if($activityType->getName() == "All Activities"){ ?>checked<?php } ?>/>
                                        <a class="<?php echo $activityType->getLetterName(); ?>-filter"> <?php echo $activityType->getName(); ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <?php foreach($activityTypes as $activityType){ ?>
                <div class="tab-pane blue" id="map-tab-<?php echo $activityType->getId(); ?>">
                    <div class="container">
                        <div class="col-sm-4 activityicondiv">
                            <span class="activityicon">
                                <?php echo $activityType->getLetterName(); ?>
                            </span>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $eventView->getEventListHTML($activityType->getNeighborhoods()); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</div>

<script type="text/javascript">
    $('#left-scroll-losangeles').click(function () {
        $('#scrollable-losangeles').animate({scrollLeft: $('#scrollable-losangeles').scrollLeft()-285}, 250);
    });
    $('#right-scroll-losangeles').click(function () {
        $('#scrollable-losangeles').animate({scrollLeft: $('#scrollable-losangeles').scrollLeft()+285}, 250);
    });
    $('#left-scroll-encino').click(function () {
        $('#scrollable-encino').animate({scrollLeft: $('#scrollable-encino').scrollLeft()-285}, 250);
    });
    $('#right-scroll-encino').click(function () {
        $('#scrollable-encino').animate({scrollLeft: $('#scrollable-encino').scrollLeft()+285}, 250);
    });
    $('#left-scroll-unity').click(function () {
        $('#scrollable-unity').animate({scrollLeft: $('#scrollable-unity').scrollLeft()-285}, 250);
    });
    $('#right-scroll-unity').click(function () {
        $('#scrollable-unity').animate({scrollLeft: $('#scrollable-unity').scrollLeft()+285}, 250);
    });

    $('#chevron-to-neighborhood-activities').click(function(){
        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top
        }, 500);
        return false;
    });

    $(".mapfilter").click(function(){
        $(this).addClass("filterselected").siblings().removeClass("filterselected");
    });
</script>
<?php foreach($activityTypes as $activityType){ ?>
    <?php echo $eventView->getEventMapHtml($activityType); ?>
<?php } ?>
<script type="text/javascript">

    //<![CDATA[
    // delay between geocode requests - at the time of writing, 100 miliseconds seems to work well
    var delay = 100;
    var markers = [];

    // ====== Create map objects ======
    var infowindow = new google.maps.InfoWindow();
    var latlng = new google.maps.LatLng(34.052156, -118.378969);
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
    var geo = new google.maps.Geocoder();
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    var bounds = new google.maps.LatLngBounds();
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

    // Load a GeoJSON from the same server as our demo.
    map.data.loadGeoJson('maps/apc-combined.json');

    // Load GeoJSON.
    map.data.loadGeoJson('https://storage.googleapis.com/maps-devrel/google.json');

    map.data.setStyle(function(feature) {
        var APC = feature.getProperty('APC');
        var color = APC == "North Valley" ? '#99CC66' :
            APC == "South Valley" ? '#336600' :
                APC == "West LA" ? '#6699CC' :
                    APC == "East LA" ? '#003366' :
                        '#FFFFFF';
        return {
            fillColor: color,
            strokeWeight: 0
        };
    });



    // ====== Lat-Lng Coordinates ======
    // using this table to check against so there are less reqs to Maps API
    var coords = {
        // Search: [Lat, Lng],
        "Beverly Hills, CA, USA": [34.0736204, -118.4003563],
        "Encino, Los Angeles, CA, USA": [34.1517492, -118.5214282],
        "Canoga Park, Los Angeles, CA, USA": [34.208254, -118.60586089999998],
        "Panorama City, Los Angeles, CA, USA": [34.227617, -118.44242500000001],
        "Brentwood, Los Angeles, CA, USA": [34.0521011, -118.4732464],
        "Los Angeles Baha&#039;i Center, 5755 Rodeo Rd, Los Angeles, CA 90016, United States": [34.0220233, -118.37147319999997], // this may not work
        "Marina del Rey, CA, USA": [33.9802893, -118.4517449],
        "Downtown, Los Angeles, CA, USA": [34.0522342, -118.2436849],
        "West Los Angeles, Los Angeles, CA, USA": [34.0412085, -118.44259599999998],
        "Martin Luther King Jr / Western, Los Angeles, CA, United States": [34.011005, -118.309418],
        "Woodland Hills, Los Angeles, CA, USA": [34.165357, -118.60897520000003],
        "Granada Hills, Los Angeles, CA, USA": [34.2793576, -118.50215270000001],
        "Sherman Oaks, Los Angeles, CA, USA": [34.1489719, -118.45135700000003],
        "West Hills, Los Angeles, CA, USA": [34.1973122, -118.64398089999997],
        "Park La Brea Apartments, 6200 W 3rd St, Los Angeles, CA 90036, United States": [34.0701777, -118.35501369999997],
        "Park La Brea Apartments, 6200 West 3rd Street, Los Angeles, CA 90036, United States": [34.0701777, -118.35501369999997],
        "Mar Vista Recreation Center, 11430 Woodbine St, Los Angeles, CA 90066, United States": [34.0175914, -118.42835839999998],
        "Reseda, Los Angeles, CA, USA": [34.2011141, -118.53605170000003],
        "Mar Vista Recreation Center, 11430 Woodbine Street, Los Angeles, CA 90066, United States": [34.0175914, -118.42835839999998],
        "Tarzana, Los Angeles, CA, USA": [34.1494848, -118.5506158],
        "Chatsworth, Los Angeles, CA, USA": [34.2506356, -118.61481000000003],
        "Porter Ranch, Los Angeles, CA, USA": [34.2822134, -118.5506158],
        "Winnetka, Los Angeles, CA, USA": [34.2048586, -118.57396210000002],
        "View Park-Windsor Hills, CA, USA": [33.993611, -118.34694400000001],
        "Westwood, Los Angeles, CA, USA": [34.0635016, -118.44551639999997],
        "Northridge, Los Angeles, CA, USA": [34.2381251, -118.530123],
        "Cheviot Hills, Los Angeles, CA 90064, USA": [34.0403397, -118.40420140000003],
        "Cheviot Hills, Los Angeles, CA, USA": [34.0403397, -118.40420140000003],
        "University of California, Los Angeles, Los Angeles, CA 90095, United States": [34.068921, -118.44518110000001],
        "Rancho Park, Los Angeles, CA, USA": [34.0454302, -118.42069149999998],
        "Pacific Palisades, Los Angeles, CA, USA": [34.03563310000001, -118.5155901]
    };

    // ====== Geocoding ======
    function getAddress(search, next, formattedcontentId, numberofevents) {
        if (search in coords) {
            var loc = coords[search];
            createMarker(formattedcontentId, loc[0], loc[1], numberofevents);
            // console.log("No request for " + search);
        } else {
            geo.geocode({
                address: search
            }, function(results, status) {
                // If that was successful
                if (status == google.maps.GeocoderStatus.OK) {
                    // console.log("Searched for " + search);
                    // Lets assume that the first marker is the one we want
                    var p = results[0].geometry.location;
                    var lat = p.lat();
                    var lng = p.lng();
                    // uncomment next line to find coordinates for searches
                    // console.log("Search: " + search + " . Lat: " + lat + " Lng: " + lng);
                    // Output the data
                    // Create a marker
                    createMarker(formattedcontentId, lat, lng, numberofevents);
                }
                // ====== Decode the error status ======
                else {
                    // === if we were sending the requests too fast, try this one again and increase the delay
                    if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                        nextAddress--;
                        delay++;
                    } else {
                        var reason = "Code " + status;
                    }
                }

            });
        }
        // filterPins passes in null
        if (next != null) {
            next();
        }

    }


    // ======= Filtering pins function
    function filterPins(filteredArray) {
        if (filteredArray) {
            clearMarkers();
            deleteMarkers();
            var i;
            for (i = 0; i < filteredArray.length; i++) {
                var locationId = filteredArray[i]["id"];
                var name = filteredArray[i]["name"];
                var type = filteredArray[i]["type"];
                var count = filteredArray[i]["count"];
                var id = locationId+'-'+type;

                setTimeout(getAddress(name, null, id, count), 100);
            }
        }


    }

    // Sets the map on all markers in the array.
    function setAllMap(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setAllMap(null);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }


    // ======= Function to create a marker
    function createMarker(contentId, lat, lng, numberofevents) {
        var content = document.getElementById(contentId).innerHTML;
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: map,
            // icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+numberofevents+'|FFFF00|000000'
            icon: 'http://chart.apis.google.com/chart?chst=d_map_spin&chld=0.75|0|FFFF00|12|_|'+numberofevents
        });
        markers.push(marker);
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(content);
            infowindow.open(map, marker);
        });
        bounds.extend(marker.position);
    }


    // ======= Arrays of locations that we want to Geocode - The first is combined, the rest are activity specific.========

    <?php foreach($activityTypes as $activityType){ ?>
        var <?php echo $activityType->getLetterName(); ?>addresses = <?php echo $eventView->getEventJSObject($activityType); ?>;
        $(function() {
            $(".<?php echo $activityType->getLetterName(); ?>-filter").click(function() {
                document.getElementById('<?php echo $activityType->getLetterName(); ?>-filter').checked = true;
                filterPins(<?php echo $activityType->getLetterName(); ?>addresses);
            });
        });
    <?php } ?>
    // links to filtering buttons

    function arrayCheck() {
        <?php foreach($activityTypes as $activityType){ ?>
            if (!<?php echo $activityType->getLetterName(); ?>addresses) {
                document.getElementById("<?php echo $activityType->getLetterName(); ?>-filter").disabled = true;
            }
        <?php } ?>
    }

    // ======= Global variable to remind us what to do next
    var nextAddress = 0;

    // ======= Function to call the next Geocode operation when the reply comes back
    function theNext() {
        if (nextAddress < Aaddresses.length) {
            var locationId = Aaddresses[nextAddress]["id"];
            var location = Aaddresses[nextAddress]["location"];
            var type = Aaddresses[nextAddress]["type"];
            var count = Aaddresses[nextAddress]["count"];
            var id = locationId+'-'+type;

            setTimeout("getAddress('" + location + "',theNext,'" + id + "'," + count + ")", delay);
            nextAddress++;
        } else {
            // We're done. Show map bounds
            map.fitBounds(bounds);
        }
    }


    // ======= Call that function for the first time =======

    google.maps.event.addListener(infowindow, 'domready', function() {
        $(".popoverex a").popover({
            placement: 'top',
            html: true,
            container: 'body'
        });
    });

    theNext();

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/
    // http://econym.org.uk/gmap/
    //]]>

    $(function() {
        $("#activities-activitiesmap").click(function() {
            $("#activities-activitiesmap").animate({"height" : "80%"}, 500,function(){
                google.maps.event.trigger(map, 'resize');
                map.fitBounds(bounds);
                // map.setCenter(latlng);
                //  initialize();
            });

        });
    });
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
<script>
    // function scrolloverabit() {
    // 	$(".scrollable").scrollLeft(145);
    // };
    // window.onload = scrolloverabit;
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
