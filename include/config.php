<?php
# Error Reporting
error_reporting(E_ALL);

include("mysql.php");

# Admin Password
$adminpasswd = 'Test2024!';
$adminpasswd = password_hash($adminpasswd, PASSWORD_DEFAULT);

# Timezone & Timestamp
date_default_timezone_set('Europe/Berlin');
$timezone = new DateTimeZone("Europe/Berlin");
$now = new DateTime();

# Settings
$query = "SELECT * FROM `settings` WHERE `id`='1'";
if($result = mysqli_query($mysqli, $query)) {
	if($row = $result->fetch_array(MYSQLI_BOTH)) {
		
		$settings_title = $row['title'];
		$settings_date = $row['date'];
		#$settings_time = $row['time'];
		$settings_delay = $row['delay'];
		$settings_location = $row['location'];
		$settings_color_palette = $row['color_palette'];
		$settings_primary_color = $row['primary_color'];
		$settings_secondary_color = $row['secondary_color'];
		$settings_background_color = $row['background_color'];
		$settings_table_font_size = $row['table_font_size'];
		
	}
}
?>