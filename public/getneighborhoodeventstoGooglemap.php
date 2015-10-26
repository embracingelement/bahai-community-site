						<?php
							include 'cleanEncoding.php';
							include 'datesort.php';
							include 'ParseMultipleGoogleCalendarsToGoogleMapDelay_email.php';
							include 'ParseMultipleGoogleCalendarsToListDelay_email.php';
							$neighborhoodGoogleCalendarFeedsToGoogleMap = array(
								array("https://www.google.com/calendar/feeds/mona%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/tannaz%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/kalim%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/naveed%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/dominic%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/neda%40labahais.org/public/basic","Children's Classes"),
								array("https://www.google.com/calendar/feeds/labc.org_49p2gc784mt1jptsk2oaoh7sp8%40group.calendar.google.com/public/basic","Children's Classes"), // CC - Ala
								array("https://www.google.com/calendar/feeds/hodad%40labahais.org/public/basic","Children's Classes"),
								array("https://www.google.com/calendar/feeds/viva%40labahais.org/public/basic","Children's Classes"),
								array("https://www.google.com/calendar/feeds/labc.org_3ccu0eei4vi0v5h0go2q8s3gis%40group.calendar.google.com/public/basic","Children's Classes"), // CC - Jamal
								array("https://www.google.com/calendar/feeds/chad%40labahais.org/public/basic","Jr. Youth"),
								array("https://www.google.com/calendar/feeds/mac%40labahais.org/public/basic","Jr. Youth"),
								array("https://www.google.com/calendar/feeds/roya%40labahais.org/public/basic","Jr. Youth"),
								array("https://www.google.com/calendar/feeds/esperanza%40labahais.org/public/basic","Jr. Youth"),
								array("https://www.google.com/calendar/feeds/negar%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/divi%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/amin%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/ladan%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/lida%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/labc.org_6kbr02c0eiov42ipcngrrjb41o%40group.calendar.google.com/public/basic","Teaching"),			// ATC - Ala
								array("https://www.google.com/calendar/feeds/nadia%40labahais.org/public/basic","Community Life"),												// Center - LA
								array("https://www.google.com/calendar/feeds/labc.org_k55hah7gd5ji1jhms75d7b6bh4%40group.calendar.google.com/public/basic","Community Life"),	// Center - Encino
								array("https://www.google.com/calendar/feeds/erfan%40labahais.org/public/basic","Feast"),
								array("https://www.google.com/calendar/feeds/nika%40labahais.org/public/basic","Feast"),
								array("https://www.google.com/calendar/feeds/anne%40labahais.org/public/basic","Feast"),
								array("https://www.google.com/calendar/feeds/touba%40labahais.org/public/basic","Feast"),
								array("https://www.google.com/calendar/feeds/labc.org_vd1oen3li3e4t8m4knb9hg7nec%40group.calendar.google.com/public/basic","Feast"),			// Center - Feast
								array("https://www.google.com/calendar/feeds/labc.org_dgcs32ebtuv1q5kmdd6f26r4g0%40group.calendar.google.com/public/basic","Community Life"),	// CET
								array("https://www.google.com/calendar/feeds/labc.org_0o3e0ajlg3tj7kqehj4sbmmmuk%40group.calendar.google.com/public/basic","Community Life"),	// Center - Neighborhood
								array("https://www.google.com/calendar/feeds/labc.org_qe1cin4numuf080rhh3oqnsn38%40group.calendar.google.com/public/basic","Community Life"),	// ACLC - Jamal
								array("https://www.google.com/calendar/feeds/labc.org_qh1m8alt2a2drrbbgaqtj23tfs%40group.calendar.google.com/public/basic","Community Life"),	// ACLC - Nur
								array("https://www.google.com/calendar/feeds/pardis%40labahais.org/private-15b61ea74890dc02c5e0587580819989/basic","Teaching")
							);
							$neighborhoodCfeeds = array (
								array("https://www.google.com/calendar/feeds/neda%40labahais.org/public/basic","Children's Classes"),
								array("https://www.google.com/calendar/feeds/labc.org_49p2gc784mt1jptsk2oaoh7sp8%40group.calendar.google.com/public/basic","Children's Classes"), // CC - Ala
								array("https://www.google.com/calendar/feeds/hodad%40labahais.org/public/basic","Children's Classes"),
								array("https://www.google.com/calendar/feeds/viva%40labahais.org/public/basic","Children's Classes"),
								array("https://www.google.com/calendar/feeds/labc.org_3ccu0eei4vi0v5h0go2q8s3gis%40group.calendar.google.com/public/basic","Children's Classes") // CC - Jamal
							);
							$neighborhoodJfeeds = array (
								array("https://www.google.com/calendar/feeds/esperanza%40labahais.org/public/basic","Jr. Youth"),
								array("https://www.google.com/calendar/feeds/chad%40labahais.org/public/basic","Jr. Youth"),
								array("https://www.google.com/calendar/feeds/roya%40labahais.org/public/basic","Jr. Youth"),
								array("https://www.google.com/calendar/feeds/mac%40labahais.org/public/basic","Jr. Youth")
							);

							$neighborhoodSfeeds = array (
								array("https://www.google.com/calendar/feeds/mona%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/dominic%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/kalim%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/naveed%40labahais.org/public/basic","Study Circles"),
								array("https://www.google.com/calendar/feeds/tannaz%40labahais.org/public/basic","Study Circles")
							);
							
							$neighborhoodFfeeds = array (
								array("https://www.google.com/calendar/feeds/erfan%40labahais.org/public/basic","Feast"),
								array("https://www.google.com/calendar/feeds/anne%40labahais.org/public/basic","Feast"),
								array("https://www.google.com/calendar/feeds/nika%40labahais.org/public/basic","Feast"),
								array("https://www.google.com/calendar/feeds/touba%40labahais.org/public/basic","Feast"),
								array("https://www.google.com/calendar/feeds/labc.org_vd1oen3li3e4t8m4knb9hg7nec%40group.calendar.google.com/public/basic","Feast")				// Center - Feast
							);

							$neighborhoodDfeeds = array (
								array("https://www.google.com/calendar/feeds/negar%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/divi%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/amin%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/ladan%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/lida%40labahais.org/public/basic","Teaching"),
								array("https://www.google.com/calendar/feeds/labc.org_6kbr02c0eiov42ipcngrrjb41o%40group.calendar.google.com/public/basic","Teaching"),			// ATC - Ala
								array("https://www.google.com/calendar/feeds/nadia%40labahais.org/public/basic","Community Life"),												// Center - LA
								array("https://www.google.com/calendar/feeds/labc.org_k55hah7gd5ji1jhms75d7b6bh4%40group.calendar.google.com/public/basic","Community Life"),	// Center - Encino
								array("https://www.google.com/calendar/feeds/labc.org_dgcs32ebtuv1q5kmdd6f26r4g0%40group.calendar.google.com/public/basic","Community Life"),	// CET
								array("https://www.google.com/calendar/feeds/labc.org_0o3e0ajlg3tj7kqehj4sbmmmuk%40group.calendar.google.com/public/basic","Community Life"),	// Center - Neighborhood
								array("https://www.google.com/calendar/feeds/labc.org_qe1cin4numuf080rhh3oqnsn38%40group.calendar.google.com/public/basic","Community Life"),	// ACLC - Jamal
								array("https://www.google.com/calendar/feeds/labc.org_qh1m8alt2a2drrbbgaqtj23tfs%40group.calendar.google.com/public/basic","Community Life")	// ACLC - Nur
							);

							$parsedcontent = ParseMultipleGoogleCalendarsToGoogleMapDelay($neighborhoodGoogleCalendarFeedsToGoogleMap);
							$parsedcontentc = ParseMultipleGoogleCalendarsToGoogleMapDelay($neighborhoodCfeeds);
							$parsedcontentj = ParseMultipleGoogleCalendarsToGoogleMapDelay($neighborhoodJfeeds);
							$parsedcontents = ParseMultipleGoogleCalendarsToGoogleMapDelay($neighborhoodSfeeds);
							$parsedcontentf = ParseMultipleGoogleCalendarsToGoogleMapDelay($neighborhoodFfeeds);
							$parsedcontentd = ParseMultipleGoogleCalendarsToGoogleMapDelay($neighborhoodDfeeds);
							$parsedClist = ParseMultipleGoogleCalendarsToListDelay($neighborhoodCfeeds);
							$parsedJlist = ParseMultipleGoogleCalendarsToListDelay($neighborhoodJfeeds);
							$parsedSlist = ParseMultipleGoogleCalendarsToListDelay($neighborhoodSfeeds);
							$parsedFlist = ParseMultipleGoogleCalendarsToListDelay($neighborhoodFfeeds);
							$parsedDlist = ParseMultipleGoogleCalendarsToListDelay($neighborhoodDfeeds);
							$mapfile = fopen("neighborhoodeventstomap.php", "w") or die("Unable to open file!");
							fwrite($mapfile, "var ".$parsedcontent);
							fclose($mapfile);
							$Cmapfile = fopen("neighborhoodeventstomapC.php", "w") or die("Unable to open file!");
							fwrite($Cmapfile, "var c".$parsedcontentc);
							fclose($Cmapfile);
							$Jmapfile = fopen("neighborhoodeventstomapJ.php", "w") or die("Unable to open file!");
							fwrite($Jmapfile, "var j".$parsedcontentj);
							fclose($Jmapfile);
							$Smapfile = fopen("neighborhoodeventstomapS.php", "w") or die("Unable to open file!");
							fwrite($Smapfile, "var s".$parsedcontents);
							fclose($Smapfile);
							$Fmapfile = fopen("neighborhoodeventstomapF.php", "w") or die("Unable to open file!");
							fwrite($Fmapfile, "var f".$parsedcontentf);
							fclose($Fmapfile);
							$Dmapfile = fopen("neighborhoodeventstomapD.php", "w") or die("Unable to open file!");
							fwrite($Dmapfile, "var d".$parsedcontentd);
							fclose($Dmapfile);
							$Cfile = fopen("activitylistC.php", "w") or die("Unable to open file!");
							fwrite($Cfile, $parsedClist);
							fclose($Cfile);
							$Jfile = fopen("activitylistJ.php", "w") or die("Unable to open file!");
							fwrite($Jfile, $parsedJlist);
							fclose($Jfile);
							$Sfile = fopen("activitylistS.php", "w") or die("Unable to open file!");
							fwrite($Sfile, $parsedSlist);
							fclose($Sfile);
							$Ffile = fopen("activitylistF.php", "w") or die("Unable to open file!");
							fwrite($Ffile, $parsedFlist);
							fclose($Ffile);
							$Dfile = fopen("activitylistD.php", "w") or die("Unable to open file!");
							fwrite($Dfile, $parsedDlist);
							fclose($Dfile);
						?>