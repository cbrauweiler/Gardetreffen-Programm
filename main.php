<?php

	include("include/config.php");

	// Einträge aus der SQL auslesen und ausgeben

	$list_time = '';
	$list_groupname = '';
	
	$ct = $_GET['time'];
	$isadm = $_GET['isadm'];
	if($isadm == true) { $colspan = '3'; }else { $colspan = '2'; }
	
	$x = '1';

	// Auftritte auslesen
	$query = "SELECT `id`, DATE_FORMAT(time, \"%H:%i\") as `time`, groupname FROM `list` WHERE `time`>='$ct' ORDER BY `time` ASC";
	//echo $query;
	if($result = mysqli_query($mysqli, $query)) {
		while($row = $result->fetch_array(MYSQLI_BOTH)) {
			
			$list_id = $row['id'];
			$list_time = $row['time'];
			$list_groupname = $row['groupname'];
			
			// Ausgabe
			echo '
				<form class="col s12 center" method="POST" action="'.$_SERVER['PHP_SELF'].'?id='.$list_id.'">
				<tr>
					<td>'; if($x == '1') { echo '<strong>'; } echo $list_time .' Uhr'; if($x == '1') { echo '</strong>'; } echo '</td>
					<td>'; if($x == '1') { echo '<strong>'; } echo $list_groupname; if($x == '1') { echo '</strong>'; } echo '</td>
			';
			
			if($isadm == true) {
				echo '
					<td>
						<div class="input-field col s3">
							<button class="btn waves-effect waves-light" type="submit" name="delete">
								<i class="material-icons center">delete</i>
							</button>
						</div>
					</td>
				';
			}
			
			if($x == '1') { echo '</strong>'; }
			
			echo '
				</tr>
				</form>
			';
			
			$x++;
		}
	}
	
	// Letztes Update
	echo '
		<tr>
			<td colspan="'.$colspan.'"><h6>Letztes Update: '.date("H:i:s", time()).' Uhr</h6></td>
		</tr>
	';
	
	// Verzögerung anzeigen
	if($settings_delay != '0') {
		echo '
			<tr>
				<td colspan="'.$colspan.'"><br /><strong>Verzögerung: '.$settings_delay.' Minute(n)</strong><br />&nbsp;</td>
			</tr>
		';
	}

?>