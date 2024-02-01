<?php

	include("include/config.php");

	// Einträge aus der SQL auslesen und ausgeben

	$list_time = '';
	$list_groupname = '';
	
	$ct = $_GET['time'];
	
	$x = '1';

	// Auftritte auslesen
	$query = "SELECT DATE_FORMAT(time, \"%H:%i\") as `time`, groupname FROM `list` WHERE `time`>='$ct' ORDER BY `time` ASC";
	//echo $query;
	if($result = mysqli_query($mysqli, $query)) {
		while($row = $result->fetch_array(MYSQLI_BOTH)) {
			
			$list_time = $row['time'];
			$list_groupname = $row['groupname'];
			
			// Ausgabe
			if($x == '1') {
				echo '
					<tr>
						<td><strong>'. $list_time .' Uhr</strong></td>
						<td><strong>'. $list_groupname .'</strong></td>
					</tr>
				';
			}
			else {
				echo '
					<tr>
						<td>'. $list_time .' Uhr</td>
						<td>'. $list_groupname .'</td>
					</tr>
				';
			}
			
			$x++;
		}
	}
	
	// Verzögerung anzeigen
	if($settings_delay != '0') {
		echo '
			<tr>
				<td colspan="2"><br /><strong>Verzögerung: '.$settings_delay.'Minute(n)</strong></td>
			</tr>
		';
	}

?>