
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../analyticstracking.php") ?>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Los Angeles Baha'i Community</title>

    <link href="../favicon.png" rel="shortcut icon" type="image/x-icon" />

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap_revised.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/home.css?v17" rel="stylesheet">

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
                <li class="active"><a href="/" id="home">Home</a></li>
                <li><a href="/#events" id="menu-home">Events</a></li>
				<li><a href="/#communitylist" id="menu-list">Mailing List</a></li>
                <li><a href="/#communitycontacts" id="menu-contacts">Contacts</a></li>
                <li><a href="/#communitymap" id="menu-map">Map</a></li>
                <li><a href="http://www.bahai.org" id="menu-bahai-faith" class="bahai-faith" target="_blank">The Baha'i Faith</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


        <div class="container-fluid">
    <div class="row herophoto herophoto200">
        <div style="position: relative">
            <img src="../css/herophoto200-correction.jpg" alt="baha'is believe" style="
            width: 110%;
            margin-left: -5%;
            display:none;
            "/>

        </div>

        </div></div>
    <div class="row  text-center" id="events">
        <div class="container" style="padding: 0; width: 100%; position: relative;">
            <img src="../css/roycehallflyer.jpg" alt="" style="width:100%">
            <a href="https://oss.ticketmaster.com/aps/uclacto2/EN/buy/details/M172527" class="bicentenary-ticketmaster-link ">
                <img src="../css/logo200-reserve.png" alt="baha'is believe"/>
            </a>
          
        </div>
    </div>
</div>

<script type="text/javascript">
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
