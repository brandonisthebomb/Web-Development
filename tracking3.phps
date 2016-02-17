<?php 

$servername = "localhost";
$username = "username";
$password = "password";

$database = new SQLite3('my_database.db') or die('Unable to open database');
$currTime = date("Y-m-d H:i:s"); 
$ip = ip2long(ip_address());
$query = <<<EOD
CREATE TABLE IF NOT EXISTS table1 (id INTEGER NOT NULL UNIQUE, visits INTEGER, tstamp INTEGER, ip INTEGER);
INSERT OR REPLACE INTO table1(id, visits, tstamp, ip) VALUES('bar',COALESCE((SELECT visits FROM table1 WHERE id='bar')+1, 1),'$currTime', '$ip');
EOD;
$database->exec($query) or die("Error");

$stmt = $database->prepare('SELECT visits from table1 WHERE id=:id');
$stmt->bindValue(':id', 'bar');
$visit = $stmt->execute();
$stms = $database->prepare('SELECT tstamp from table1 WHERE id=:id');
$stms->bindValue(':id', 'bar');
$date = $stms->execute();
$stmm = $database->prepare('SELECT ip from table1 WHERE id=:id');
$stmm->bindValue(':id', 'bar');
$address = $stmm->execute();

$array1= $visit->fetchArray();

echo "Number of Page Visits: ".$array1[visits].'<br />';

$array2= $date->fetchArray();

echo "Current Time: ".$array2[tstamp].'<br />';

$array3= $address->fetchArray();

$ipaddress=$array3[ip];

echo "IP Address: ".long2ip($ipaddress);


function ip_address() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?> 