<?php


	 $hits = file_get_contents("hits.txt"); 
	 $hits = $hits + 1; 

	 $handle = fopen("hits.txt", "w"); 
	 fwrite($handle, $hits); 
	 fclose($handle); 

	 echo "Number of visits: ";
	 print $hits; 


?>
