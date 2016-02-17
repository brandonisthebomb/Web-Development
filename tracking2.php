<?php

	// Increment
	if (!$memcache->get('page_' . $page_id)) {
	    $memcache->set('page_' . $page_id, 1);
	}
	else {
	    $memcache->increment('page_' . $page_id, 1);
	}

	// Cron
	if ($pageviews = $memcache->get('page_' . $page_id)) {
	    $sql = "UPDATE pages SET pageviews = pageviews + " . $pageviews . " WHERE page_id = " . $page_id;
	    mysql_query($sql);
	    $memcache->delete('page_' . $page_id);
	}
?>


<?php	
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$page = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
//	$page = iif(!empty($_SERVER['QUERY_STRING']), "?{$_SERVER['QUERY_STRING']}", "");
	$referrer .= $_SERVER['HTTP_REFERER'];
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$remotehost = @getHostByAddr($ipaddress);


	// Create log line
	$logline = $ipaddress . '|' . $referrer . '|' . $useragent . '|' . $remotehost .  "\n";
	// Write to log file:
	$logfile = 'hits.txt';
	// Open the log file in “Append” mode
	if (!$handle = fopen($logfile, 'a+')) {
		die("Failed to open log file");
	}
	// Write $logline to our logfile.
	if (fwrite($handle, $logline) === FALSE) {
		die("Failed to write to log file");
	}

	echo "done";
?>