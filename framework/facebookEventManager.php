<?php

class EventManager {

	function __construct(){
		require('facebookApi.php');
		global $wpdb;

	}

	function haveEvents(){
		global $wpdb;
		$wpdb->get_results('SELECT * FROM `wp_facebook_events`');

		if(!$wpdb->num_rows){
			return false;
		}else{
			return true;
		}
	}

	function OneEvent(){
		global $wpdb;

		if($this->haveEvents()){
			$upcomingEvent = $wpdb->get_results('SELECT * FROM `wp_facebook_events` ORDER BY `eventStart` ASC LIMIT 1');

			return $upcomingEvent[0];
		}
	}

	function BrygadaHasEvents($location = 'Warszawa'){
		global $wpdb;

		$wpdb->get_results("SELECT * FROM `wp_facebook_events` WHERE `eventLocation` = '{$location}'");
		if(!$wpdb->num_rows){
			return false;
		}else{
			return true;
		}
	}

	function BrygadaEvent($location = 'Warszawa'){
		global $wpdb;
		
		if($this->BrygadaHasEvents($location)){
			$upcomingEvent = $wpdb->get_results("SELECT * FROM `wp_facebook_events` WHERE `eventLocation` = '{$location}' ORDER BY `eventStart` ASC LIMIT 1");

			return $upcomingEvent[0];
		}
	}

	function syncEvents(){
		mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("error");
		mysql_select_db(DB_NAME);


		$facebookConfigArray = mysql_query("SELECT * FROM `wp_facebook_config` ORDER BY `ID` DESC LIMIT 1");
		$facebookConfig = mysql_fetch_array($facebookConfigArray);

       	$access_token = $facebookConfig['accessToken'];
       	$fields="id,name,description,location,venue,timezone,start_time,cover";
       
       	$c = curl_init();

        curl_setopt($c, CURLOPT_URL, 'https://graph.facebook.com/'.FANPAGE_ID.'/events/feed/?fields='.$fields.'&access_token='.$access_token);
        curl_setopt($c, CURLOPT_POST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_ENCODING ,"");

        $data = curl_exec($c);

        curl_close($c);

        $decode = json_decode($data, true);
		$events = $decode['data'];

		foreach($events as $event){
			global $wpdb;

			$eventName = $event['name'];
			$eventStart = $event['start_time'];
			$eventId = $event['id'];
			$eventLocation = $event['venue']['city'];

			$eventInfo = serialize($this->eventInfo($eventId, $access_token));

			$query = mysql_query("SELECT * FROM `wp_facebook_events` WHERE `eventId` = '{$eventId}'");

			if(mysql_num_rows($query)){
				mysql_query("DELETE FROM `wp_facebook_events` WHERE `eventId` = '{$eventId}'");
			}

			mysql_query("INSERT INTO `wp_facebook_events` 
				SET 
				`eventId` = '{$eventId}', 
				`eventName` = '{$eventName}', 
				`eventLocation` = '{$eventLocation}', 
				`eventInfo` = '{$eventInfo}', 
				`eventStart` = '{$eventStart}'");

		}
	}

	function clearEvents(){
		mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("error");
		mysql_select_db(DB_NAME);

		$events = mysql_query("SELECT * FROM `wp_facebook_events`");
		while($array_events = mysql_fetch_array($events)){
			if(strtotime($array_events['eventStart']) + 3600 < time()){
				mysql_query("DELETE FROM `wp_facebook_events` WHERE `ID` = '{$array_events['ID']}'");
			}
		}
	}

	function renewAccessToken(){
		mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("error");
		mysql_select_db(DB_NAME);

		$facebookConfigArray = mysql_query("SELECT * FROM `wp_facebook_config` ORDER BY `ID` DESC LIMIT 1");
		$facebookConfig = mysql_fetch_array($facebookConfigArray);

		$daySeconds = 60 * 60 * 30;

		if($facebookConfig['expireTime'] - $daySeconds <= time()){
			$access_token = $facebookConfig['accessToken'];

			$c = curl_init();

	        curl_setopt($c, CURLOPT_URL, 'https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id='.APP_ID.'&client_secret='.APP_SECRET.'&fb_exchange_token='.$access_token);
	        curl_setopt($c, CURLOPT_POST, 1).
	        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

	        $new = curl_exec($c);

	        $explode = explode('&', $new);
	        $access_token_array = explode('=', $explode[0]);
	        $expire_array = explode('=', $explode[1]);

	        curl_close($c);

	        $time = time();
	        $expireTime = $time + $expire_array[1];
	        $new_access_token = $access_token_array[1];

	        mysql_query("INSERT INTO `wp_facebook_config` SET `accessToken` = '{$new_access_token}', `saveTime` = '{$time}', `expireTime` = '{$expireTime}'");
		}

	}

	function eventInfo($id,$access_token){
        $c = curl_init();

        curl_setopt($c, CURLOPT_URL, 'https://graph.facebook.com/'.$id.'/?access_token='.$access_token);
        curl_setopt($c, CURLOPT_POST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_ENCODING ,"");

        $data = curl_exec($c);

        curl_close($c);

        return $data;

	}
}