/**
 * Created by Dominic on 4/5/15.
 */
$(document).ready(function(){

    var tour = new Tour({


        steps: [
            {
                element:"",
                orphan: true,
                title: "LABC.org Walkthrough",
                content: "Welcome to the labc.org Walkthrough"
            },
            {
                element: ".encino-tab",
                reflex: true,
                title: "Select a Center",
                content: "Events at the Los Angeles Baha'i Center are listed by default. Click on Encino to see events at the Encino Baha'i Community Center."
            },
            {
                element: "#myTabContent .tab-pane.active .scrollable .scrolly:first p",
                title: "Click on Details",
                content: "Click on Details to get details for each event.",
                reflex: true,
                delay:{
                    show: 1000,
                    hide: 0
                }
            },
            {
                element: "#myTabContent .tab-pane.active .scrollable .scrolly:first div.popoverex",
                reflex: true,
                title: "Click on the Center's name",
                content: "Click on the Center's name to get directions and contact information for the Center."
            },
            {
                element: "a[href='#neighborhoodactivities']",
                title : "Down arrow",
                reflex: true,
                content: "Down arrow - Scroll down for Neighborhood activities."
            },
            {
                element: "#activities-activitiesmap",
                title: "The map",
                reflex: true,
                content: "The map shows you where all the neighborhood activities are taking place in Los Angeles."
            },
            {
                element: "#map-canvas div[title='Zoom in']",
                title : "Click on the slider",
                reflex: true,
                content: "Click on the slider to zoom in or out of the map."
            },
            {
                orphan: true,
                title: "Click on a yellow pin",
                content: "Click on a yellow pin to see the activities in that neighborhood."
            },
            {
                element: "",
                title : "Click on Details",
                reflex: true,
                content: "Click on Details to get information for that activity."
            },
            {
                element: "#tab1 .filters",
                title: "Click in the filter box",
                content: "Click in the filter box to see only certain types of neighborhood activities.",
                placement: 'left',
                backdrop: false
            },
            {
                element: ".nav-tabs .dropdown",
                title : "List View",
                backdrop: false,
                content: "If it's easier for you to read a list of activities, you can click on list view."
            },
            {
                element: ".navbar-header .navbanner",
                title: "Menu",
                content: "Click here to access the menu."
            },
            {
                element: "#bs-example-navbar-collapse-1 a[href='contact.php']",
                title: "Right now there are two active pages",
                content: "the home page, and the Contacts page. Click on Contacts."
            },
            {
                element:"",
                orphan: true,
                title: "Welcome To",
                content: "Contacts Walkthrough"
            },

            {
                element:"#map-canvas",
                title: "Click on a pin for details on that Center.",
                content:"The three pins correspond to the Baha'i Centers and Baha'i Community Centers in the area.",
                placement: 'left'
            },
            {
                element:"#map-canvas",
                title : "Los Angeles' 4 areas",
                content:"The City of Los Angeles covers a large geographical area, so the Baha'i Community divided it into four \"areas\" or \"sectors\" for administrative purposes. Click on one of the blue or green areas to get contact details for that area's coordinators.",
                placement: 'top'
            },
            {
                element:".nav-tabs .dropdown",
                title: "Directories",
                content:"For more detailed contact information, click on Directories."
            },
            {
                orphan: true,
                title: "Enjoy the Site",
                content:"And contact us with any questions"
            }
        ]});

// Initialize the tour
    tour.init();

// Start the tour
    tour.start();
});