<?php

	$file = 'enable1.txt';
	$input = $_POST['input'];
	$parameter = $_POST['parameter'];
	$output = '';
	$contents = file_get_contents($file);
	$lines = count(file($file));

	$pattern = "/^$input/";

	$handle = fopen($file, "r");
	if ($parameter == 'first')
	{
		if ($handle) {
		    while (($line = fgets($handle)) !== false) {
		    	if(preg_match("/^$input/", $line))
		    	{
		    		echo $line;
		    	}

		    }
		}
	}
	elseif ($parameter == 'last') {
		if ($handle) {
		    while (($line = fgets($handle)) !== false) {
		    	if(preg_match("/$input$/", $line))
		    	{
		    		echo $line;
		    	}

		    }
		}

	}

	fclose($handle);

	echo $output;

?>