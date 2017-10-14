<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Population Map - Baha'i Community of Los Angeles</title>

    <!-- Bootstrap core CSS -->
	<link href="../css/bootstrap_revised.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/home.css" rel="stylesheet">

	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:700,100,400|Roboto:900,100,300,700,400' rel='stylesheet' type='text/css'>
	
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
	<!-- <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<!-- <div class="navbar-header">
				<button class="navbar-toggle navbanner" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="menu">Menu</span>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav" style="background: rgba(255,255,255,0.8);">
					<li><a href="index.php">Home</a></li>
					<li class="disabled"><a href="" id="menu-home">About Us</a></li>
					<li class="disabled"><a href="">The Baha'i Faith</a></li>
					<li class="disabled"><a href="">Get Involved</a></li>
					<li class="active"><a href="contact.php" id="menu-contacts">Contacts</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		<!-- </div><!-- /.container-fluid -->
	<!-- </nav> -->
	
	<div class="container-fluid">

		<div class="row paddingfifty text-center">
			<div class="container">
				<div class="rowtitle"><h2>Population Map</h2></div>
				<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-left rowdescription">
					<p>This map shows how the 3228 Baha'is of Los Angeles are distributed throughout the city.</p>
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="tab-content"><div class="tab-pane active" id="tab1">
			<div id="map-canvas"></div>
			<div class="filters text-left">
				<button type="button" class="close" data-toggle="collapse" data-target="#filterinput" style="margin-right:-20px; margin-top: -5px;" aria-expanded="true" aria-controls="filterinput"><span class="caret"></span></button>
				<div id="filterinput" class="collapse in">
					<div class="filtersheader">Legend</div>
					<ul>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #e6e6ff;">&block;</span> 1</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #ccccff;">&block;</span> 2-5</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #b3b3ff;">&block;</span> 6-9</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #9999ff;">&block;</span> 10-14</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #8080ff;">&block;</span> 15-19</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #6666ff;">&block;</span> 20-29</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #4d4dff;">&block;</span> 30-39</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #3333ff;">&block;</span> 40-49</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #1a1aff;">&block;</span> 50-59</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #0000ff;">&block;</span> 60-69</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #0000e6;">&block;</span> 70-79</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #0000cc;">&block;</span> 80-89</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #0000b3;">&block;</span> 90-99</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #000099;">&block;</span> 100-149</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #000066;">&block;</span> 150-199</li>
						<li class="mapfilter c-filter" white-space="nowrap"><span style="color: #000033;">&block;</span> 200-249</li>
					</ul>
				</div>
			</div>
			</div></div>
		</div>
	</div>

	<!-- JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
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
			map.data.loadGeoJson('../maps/zip-code-tabulation-areas-2012.geojson');

		    // Load GeoJSON.
		    map.data.loadGeoJson('https://storage.googleapis.com/maps-devrel/google.json');

		    infoWindow = new google.maps.InfoWindow({
		        content: "",
				maxWidth: 400,
				disableAutoPan: true
		    });

		    map.data.setStyle(function(feature) {
		        var name = feature.getProperty('name');
		        var color =
					name== "90025" ? ' #000033 ' :
					name== "91335" ? ' #000033 ' :
					name== "91316" ? ' #000033 ' :
					name== "91356" ? ' #000066 ' :
					name== "91367" ? ' #000066 ' :
					name== "90049" ? ' #000099 ' :
					name== "91306" ? ' #000099 ' :
					name== "91304" ? ' #000099 ' :
					name== "90035" ? ' #000099 ' :
					name== "90024" ? ' #0000b3 ' :
					name== "91326" ? ' #0000e6 ' :
					name== "91303" ? ' #0000e6 ' :
					name== "90034" ? ' #0000e6 ' :
					name== "91364" ? ' #0000e6 ' :
					name== "91436" ? ' #0000ff ' :
					name== "91403" ? ' #1a1aff ' :
					name== "91344" ? ' #1a1aff ' :
					name== "91307" ? ' #1a1aff ' :
					name== "91311" ? ' #3333ff ' :
					name== "91406" ? ' #3333ff ' :
					name== "91324" ? ' #3333ff ' :
					name== "90272" ? ' #3333ff ' :
					name== "90077" ? ' #4d4dff ' :
					name== "91401" ? ' #4d4dff ' :
					name== "90064" ? ' #4d4dff ' :
					name== "90066" ? ' #4d4dff ' :
					name== "91423" ? ' #4d4dff ' :
					name== "90036" ? ' #6666ff ' :
					name== "90046" ? ' #6666ff ' :
					name== "90210" ? ' #6666ff ' :
					name== "90019" ? ' #6666ff ' :
					name== "90062" ? ' #6666ff ' :
					name== "90043" ? ' #6666ff ' :
					name== "90016" ? ' #6666ff ' :
					name== "91604" ? ' #6666ff ' :
					name== "91342" ? ' #6666ff ' :
					name== "91607" ? ' #6666ff ' :
					name== "90048" ? ' #8080ff ' :
					name== "90068" ? ' #8080ff ' :
					name== "91343" ? ' #8080ff ' :
					name== "90026" ? ' #8080ff ' :
					name== "90004" ? ' #8080ff ' :
					name== "90045" ? ' #8080ff ' :
					name== "90027" ? ' #8080ff ' :
					name== "90028" ? ' #8080ff ' :
					name== "90292" ? ' #8080ff ' :
					name== "91325" ? ' #8080ff ' :
					name== "91405" ? ' #8080ff ' :
					name== "90029" ? ' #9999ff ' :
					name== "90039" ? ' #9999ff ' :
					name== "90291" ? ' #9999ff ' :
					name== "91602" ? ' #9999ff ' :
					name== "91605" ? ' #9999ff ' :
					name== "90008" ? ' #9999ff ' :
					name== "90042" ? ' #9999ff ' :
					name== "91411" ? ' #9999ff ' :
					name== "91601" ? ' #9999ff ' :
					name== "90006" ? ' #9999ff ' :
					name== "90018" ? ' #9999ff ' :
					name== "90020" ? ' #9999ff ' :
					name== "91402" ? ' #9999ff ' :
					name== "90065" ? ' #b3b3ff ' :
					name== "90038" ? ' #b3b3ff ' :
					name== "91040" ? ' #b3b3ff ' :
					name== "91331" ? ' #b3b3ff ' :
					name== "90005" ? ' #b3b3ff ' :
					name== "90015" ? ' #b3b3ff ' :
					name== "90017" ? ' #b3b3ff ' :
					name== "90031" ? ' #b3b3ff ' :
					name== "90047" ? ' #b3b3ff ' :
					name== "90293" ? ' #b3b3ff ' :
					name== "90731" ? ' #b3b3ff ' :
					name== "91352" ? ' #b3b3ff ' :
					name== "91357" ? ' #b3b3ff ' :
					name== "91606" ? ' #b3b3ff ' :
					name== "90012" ? ' #ccccff ' :
					name== "90014" ? ' #ccccff ' :
					name== "90037" ? ' #ccccff ' :
					name== "90041" ? ' #ccccff ' :
					name== "90069" ? ' #ccccff ' :
					name== "90007" ? ' #ccccff ' :
					name== "90011" ? ' #ccccff ' :
					name== "90013" ? ' #ccccff ' :
					name== "90067" ? ' #ccccff ' :
					name== "90710" ? ' #ccccff ' :
					name== "90732" ? ' #ccccff ' :
					name== "91337" ? ' #ccccff ' :
					name== "90061" ? ' #ccccff ' :
					name== "91042" ? ' #ccccff ' :
					name== "91345" ? ' #ccccff ' :
					name== "90001" ? ' #ccccff ' :
					name== "90032" ? ' #ccccff ' :
					name== "90044" ? ' #ccccff ' :
					name== "90057" ? ' #ccccff ' :
					name== "90211" ? ' #ccccff ' :
					name== "90230" ? ' #ccccff ' :
					name== "90501" ? ' #ccccff ' :
					name== "91340" ? ' #ccccff ' :
					name== "91409" ? ' #ccccff ' :
					name== "91413" ? ' #ccccff ' :
					name== "91416" ? ' #ccccff ' :
					name== "90003" ? ' #e6e6ff ' :
					name== "90010" ? ' #e6e6ff ' :
					name== "90023" ? ' #e6e6ff ' :
					name== "90059" ? ' #e6e6ff ' :
					name== "90073" ? ' #e6e6ff ' :
					name== "90075" ? ' #e6e6ff ' :
					name== "90078" ? ' #e6e6ff ' :
					name== "90089" ? ' #e6e6ff ' :
					name== "90094" ? ' #e6e6ff ' :
					name== "90213" ? ' #e6e6ff ' :
					name== "90232" ? ' #e6e6ff ' :
					name== "90316" ? ' #e6e6ff ' :
					name== "90404" ? ' #e6e6ff ' :
					name== "90436" ? ' #e6e6ff ' :
					name== "90502" ? ' #e6e6ff ' :
					name== "90733" ? ' #e6e6ff ' :
					name== "90744" ? ' #e6e6ff ' :
					name== "90802" ? ' #e6e6ff ' :
					name== "91302" ? ' #e6e6ff ' :
					name== "91365" ? ' #e6e6ff ' :
					name== "91372" ? ' #e6e6ff ' :
					name== "91426" ? ' #e6e6ff ' :
					name== "91504" ? ' #e6e6ff ' :
					name== "91603" ? ' #e6e6ff ' :
					name== "91614" ? ' #e6e6ff ' :
					name== "91615" ? ' #e6e6ff ' :
		            'TRANSPARENT';
				var weight =
					color == "TRANSPARENT" ? '0' :
					'2';
		        return {
		            fillColor: color,
		            strokeWeight: weight,
					fillOpacity: 0.7,
		        };


		    });

		    map.data.addListener('mouseout', function(event) {
		        map.data.revertStyle();
		    });

		    map.data.addListener('mouseover', function(event) {
		        //show an infowindow on click
		        map.data.revertStyle();
		        map.data.overrideStyle(event.feature, {
		            strokeWeight: 4
		        });
				var name = event.feature.getProperty("name");
				var population =
					name == "90025" ? '249' :
					name == "91335" ? '228' :
					name == "91316" ? '223' :
					name == "91356" ? '181' :
					name == "91367" ? '150' :
					name == "90049" ? '125' :
					name == "91306" ? '121' :
					name == "91304" ? '104' :
					name == "90035" ? '103' :
					name == "90024" ? '96' :
					name == "91326" ? '77' :
					name == "91303" ? '74' :
					name == "90034" ? '71' :
					name == "91364" ? '71' :
					name == "91436" ? '62' :
					name == "91403" ? '59' :
					name == "91344" ? '58' :
					name == "91307" ? '53' :
					name == "91311" ? '46' :
					name == "91406" ? '45' :
					name == "91324" ? '43' :
					name == "90272" ? '41' :
					name == "90077" ? '38' :
					name == "91401" ? '36' :
					name == "90064" ? '35' :
					name == "90066" ? '33' :
					name == "91423" ? '32' :
					name == "90036" ? '27' :
					name == "90046" ? '27' :
					name == "90210" ? '27' :
					name == "90019" ? '24' :
					name == "90062" ? '24' :
					name == "90043" ? '22' :
					name == "90016" ? '21' :
					name == "91604" ? '21' :
					name == "91342" ? '20' :
					name == "91607" ? '20' :
					name == "90048" ? '19' :
					name == "90068" ? '19' :
					name == "91343" ? '19' :
					name == "90026" ? '18' :
					name == "90004" ? '17' :
					name == "90045" ? '17' :
					name == "90027" ? '15' :
					name == "90028" ? '15' :
					name == "90292" ? '15' :
					name == "91325" ? '15' :
					name == "91405" ? '15' :
					name == "90029" ? '13' :
					name == "90039" ? '13' :
					name == "90291" ? '13' :
					name == "91602" ? '13' :
					name == "91605" ? '13' :
					name == "90008" ? '11' :
					name == "90042" ? '11' :
					name == "91411" ? '11' :
					name == "91601" ? '11' :
					name == "90006" ? '10' :
					name == "90018" ? '10' :
					name == "90020" ? '10' :
					name == "91402" ? '10' :
					name == "90065" ? '9' :
					name == "90038" ? '8' :
					name == "91040" ? '8' :
					name == "91331" ? '8' :
					name == "90005" ? '7' :
					name == "90015" ? '7' :
					name == "90017" ? '7' :
					name == "90031" ? '7' :
					name == "90047" ? '7' :
					name == "90293" ? '6' :
					name == "90731" ? '6' :
					name == "91352" ? '6' :
					name == "91357" ? '6' :
					name == "91606" ? '6' :
					name == "90012" ? '5' :
					name == "90014" ? '5' :
					name == "90037" ? '5' :
					name == "90041" ? '5' :
					name == "90069" ? '5' :
					name == "90007" ? '4' :
					name == "90011" ? '4' :
					name == "90013" ? '4' :
					name == "90067" ? '4' :
					name == "90710" ? '4' :
					name == "90732" ? '4' :
					name == "91337" ? '4' :
					name == "90061" ? '3' :
					name == "91042" ? '3' :
					name == "91345" ? '3' :
					name == "90001" ? '2' :
					name == "90032" ? '2' :
					name == "90044" ? '2' :
					name == "90057" ? '2' :
					name == "90211" ? '2' :
					name == "90230" ? '2' :
					name == "90501" ? '2' :
					name == "91340" ? '2' :
					name == "91409" ? '2' :
					name == "91413" ? '2' :
					name == "91416" ? '2' :
					name == "90003" ? '1' :
					name == "90010" ? '1' :
					name == "90023" ? '1' :
					name == "90059" ? '1' :
					name == "90073" ? '1' :
					name == "90075" ? '1' :
					name == "90078" ? '1' :
					name == "90089" ? '1' :
					name == "90094" ? '1' :
					name == "90213" ? '1' :
					name == "90232" ? '1' :
					name == "90316" ? '1' :
					name == "90404" ? '1' :
					name == "90436" ? '1' :
					name == "90502" ? '1' :
					name == "90733" ? '1' :
					name == "90744" ? '1' :
					name == "90802" ? '1' :
					name == "91302" ? '1' :
					name == "91365" ? '1' :
					name == "91372" ? '1' :
					name == "91426" ? '1' :
					name == "91504" ? '1' :
					name == "91603" ? '1' :
					name == "91614" ? '1' :
					name == "91615" ? '1' :
					"";
				var windowcontent =
					population == "" ? "<div class='text-left infowindow'><p><h4>" + event.feature.getProperty("name") + "</h4></p></div>" :
					population == "1" ? "<div class='text-left infowindow' id='contacts-map-" + event.feature.getProperty("name").replace(" ", "-") + "'><p><h4>" + event.feature.getProperty("name") + "</h4></p><p>There is <b>" + population + "</b> Baha'i living in this zip code.</p></div>" :
					"<div class='text-left infowindow' id='contacts-map-" + event.feature.getProperty("name").replace(" ", "-") + "'><p><h4>" + event.feature.getProperty("name") + "</h4></p><p>There are <b>" + population + "</b> Baha'is living in this zip code.</p></div>";
				infoWindow.setContent(windowcontent);
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
				// icon: "http://chart.apis.google.com/chart?chst=d_map_spin&chld=1.25|0|FFFF00|9|_|LA",
				title:"Los Angeles Baha'i Center"
			});
			
			// To add the marker to the map, call setMap();
			labcmarker.setMap(map);
			
			var encinomarker = new google.maps.Marker({
				position: encinoLatlng,
				map: map,
				// icon: "http://chart.apis.google.com/chart?chst=d_map_spin&chld=1.25|0|FFFF00|9|_|Encino",
				title:"Encino Baha'i Community Center"
			});

			// To add the marker to the map, call setMap();
			encinomarker.setMap(map);
			
			var santamonicamarker = new google.maps.Marker({
				position: santamonicaLatlng,
				map: map,
				// icon: "http://chart.apis.google.com/chart?chst=d_map_spin&chld=1.25|0|FFFF00|9|_|Santa|Monica",
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

	<!-- Start of StatCounter Code for Default Guide -->
	<script type="text/javascript">
		var sc_project=8795522;
		var sc_invisible=1;
		var sc_security="e0303a8a";
		var scJsHost = (("https:" == document.location.protocol) ?
		"https://secure." : "http://www.");
		document.write("<sc"+"ript type='text/javascript' src='" +
		scJsHost+
		"statcounter.com/counter/counter.js'></"+"script>");
	</script>

	<noscript>
		<div class="statcounter"><a title="web analytics" href="http://statcounter.com/" target="_blank"><img class="statcounter" src="http://c.statcounter.com/8795522/0/e0303a8a/1/" alt="web analytics"></a></div>
	</noscript>

	<!-- End of StatCounter Code for Default Guide -->

</body>

</html>