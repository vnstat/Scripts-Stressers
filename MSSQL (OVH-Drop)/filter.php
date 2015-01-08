<?php
//MSSQL Filter coded by AncientMidgets
set_time_limit(0);
ignore_user_abort(true); 
print("AncientMidgets MSSQL Filter\n");
	if(count($argv) > 4 || count($argv) < 4 || !strstr($argv[1], '.txt') || !strstr($argv[2], '.txt') || !is_numeric($argv[3])){
	die("Usage: php ".basename($_SERVER["SCRIPT_FILENAME"], ".php").".php [Input.txt] [Output.txt] [Response Size]\n");
	} else {
	if(!file_exists($argv[1])){
	die('File: "'.$argv[1].'" does not exist!');
	}
	print("Filtering by response length...\n");
	$input = $argv[1];
	$output = $argv[2];
	$responsesize = (int)$argv[3];
	$listarray = array();
	$handle = fopen($input, "r");
		while(!feof($handle)){
		$entry = fgets($handle, 4096);
			if(strlen($entry)>=5){
			$ex = explode(' ',$entry);
				if($ex[1]>=$responsesize){
				$listarray[] = $ex[0];
				}
			}
		}
	fclose($handle);
	print("Writing array to file...\n");
	$listarray = array_unique($listarray);
		if(!file_exists($output)){
		touch($output);
		chmod($output, 0777);
		}
		$fh = fopen($output, 'a') or die('Cant open file: "'.$output.'"');
		foreach($listarray as $ip){
		fwrite($fh, $ip."\n");
		}
		fclose($fh);
	}
?>
