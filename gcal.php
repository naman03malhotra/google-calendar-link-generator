<?php
//Call this with the shown parameters (make sure $time and $end are integers and in Unix timestamp format!)
//Get a link that will open a new event in Google Calendar with those details pre-filled
function google_calendar_link_generator($name, $begin, $end, $location, $details) {
	$params = array('&dates=', '/', '&details=', '&location=', '&sf=true&output=xml');
	$url = 'https://www.google.com/calendar/render?action=TEMPLATE&text=';
	$arg_list = func_get_args();
    for ($i = 0; $i < count($arg_list); $i++) {
    	$current = $arg_list[$i];
    	if(is_int($current)) {
    		$t = new DateTime('@' . $current, new DateTimeZone('UTC'));
    		$current = $t->format('Ymd\THis\Z');
    		unset($t);
    	}
    	else {
    		$current = urlencode($current);
    	}
    	$url .= (string) $current . $params[$i];
    }
    return $url;
}
//Sample link, navigate to it while logged into your Google account
echo google_calendar_link_generator("An Awesome Event", 1412348900, 1412368900, "NSIT DELhi", "Descriptions require ");
?>