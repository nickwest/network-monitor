<pre><?php

// Query the Time Capsule for current connection data
$cmd = 'snmpwalk -m AIRPORT-BASESTATION-3-MIB -Os -v 2c -c public 10.0.1.1 atPhysAddress';
exec ($cmd, $raw_output);
$ips = array();

// Step through returned lines and create an array: $ips[ MAC_ADDRESS ] = IP_ADDRESS
foreach($raw_output as $line){
	if(strpos($line, '16.1.') !== false){
		$a = strpos($line, '1.');
		$b = strpos($line, '=');
		$ip = substr($line, $a+2, $b-$a-2);
		
		$a = strpos($line, 'STRING:');
		$mac = str_replace(' ',':',substr($line, $a+8));
		
		$ips[$mac] = $ip;
	}
}

print_r($ips);

?></pre>