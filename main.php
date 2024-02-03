<?php

	include("include/config.php");

	// Einträge aus der SQL auslesen und ausgeben

	$list_time = '';
	$list_groupname = '';
	
	$ct = $_GET['time'];
	$isadm = $_GET['isadm'];
	if($isadm == true) {
		$colspan = '3';
		$query = "SELECT `id`, DATE_FORMAT(time, \"%H:%i\") as `time`, groupname FROM `list` ORDER BY `time` ASC";
	}
	else {
		$colspan = '2';
		$query = "SELECT `id`, DATE_FORMAT(time, \"%H:%i\") as `time`, groupname FROM `list` WHERE `time`>='$ct' ORDER BY `time` ASC";
	}
	
	$x = '1';
	
	echo '
		<div class="row">
		<h'.$settings_table_font_size.'>
		<table class="striped centered">
			<thead>
			  <tr>
				<th>Auftrittszeit</th>
				<th>Tanzgruppe</th>
	';
	if($isadm == true) { echo '<th>&nbsp;</th>'; }
	echo '
			  </tr>
			</thead>
			<tbody>
	';

	// Auftritte auslesen
	if($result = mysqli_query($mysqli, $query)) {
		while($row = $result->fetch_array(MYSQLI_BOTH)) {
			
			$list_id = $row['id'];
			$list_time = $row['time'];
			$list_groupname = $row['groupname'];
			
			// Ausgabe
			echo '
				<tr>
					<td>'; if($x == '1') { echo '<strong>'; } echo $list_time .' Uhr'; if($x == '1') { echo '</strong>'; } echo '</td>
					<td>'; if($x == '1') { echo '<strong>'; } echo $list_groupname; if($x == '1') { echo '</strong>'; } echo '</td>
			';
			
			if($isadm == true) {
				echo '
					<td>
						<form class="col s12 center" method="POST" action="index.php?id='.$list_id.'">
							<button class="btn waves-effect waves-light" type="submit" name="delete" onclick="return window.confirm(\'Soll dieser Datensatz wirklich gelöscht werden?\');">
								<i class="material-icons center">delete</i>
							</button>
						</form>
					</td>
				';
			}
			
			if($x == '1') { echo '</strong>'; }
			
			echo '
				</tr>
			';
			
			$x++;
		}
	}
	
	// Letztes Update
	echo '
				</tbody>
			</table>
			</h'.$settings_table_font_size.'>
		</div>
		
		<div class="row">
			<div class="col s12 center">
				<h6>Letztes Update: '.date("H:i:s", time()).' Uhr</h6>
			</div>
		</div>
	';
	
	// Verzögerung anzeigen
	if($settings_delay != '0') {
		echo '
			<div class="row">
				<div class="col s12 center">
					<h'.$settings_table_font_size.'><strong>Verzögerung: '.$settings_delay.' Minute(n)</strong><br />&nbsp;</h'.$settings_table_font_size.'>
				</div>
			</div>
		';
	}

?>