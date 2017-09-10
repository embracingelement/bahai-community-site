# bahai-community-site

## Getting Started
Get a local php instance running with the public folder as the root.
Navigate to it in your browser. It should inform you of the rest.

##Requirements
PHP 5.6
A folder called credentials in the folder about the root of this repo.
*That folder needs to have read and write access from PHP*

## Google Calendar API setup was used
## https://developers.google.com/google-apps/calendar/quickstart/php

Working through step one. Is necessary for completion of site setup.

chmod -R 777 /path/to/credentials

##Maintaining Flyers

Add flyers to a new folder in public/img/flyers
If one of those images has the word thumbnail in it it will be used as the thumbnail.
If there are more than two images then the folder will be skipped.
If there are no images than the folder will be skipped
