<?php

	header('Cache-Control: no-cache, no-store, must-revalidate');

	session_start();

	# Config
	include('../include/config.php');
	
	# Logout
	if(isset($_GET['a']) && $_GET['a'] == 'logout') {
		
		session_destroy();
		session_start();
		
	}
	
	# Benutzersitzung
	if(!empty($_SESSION['id'])) { 

		$session_id = $_SESSION['id'];

	}
	
	# Login
	if(isset($_POST['login'])) {

		$login_pass = htmlspecialchars($_POST['login_pass']);
		#$login_pass = md5($login_pass);
		
		if(password_verify($login_pass, $adminpasswd)) {
			
			$_SESSION['id'] = session_id();
			$session_id = $_SESSION['id'];
			
		}
		else $error = '<ul class="fehler">Fehler! Das Passwort ist falsch.</ul><br><br>';
		
	}
	
	# Einstellungen speichern
	if(isset($_POST['save'])) {
		
		$save_title = $_POST['title'];
		$save_date = $_POST['date'];
		#$save_time = $_POST['time'];
		$save_location = $_POST['location'];
		$save_color_palette = $_POST['color_palette'];
		$save_primary_color = $_POST['primary_color'];
		$save_secondary_color = $_POST['secondary_color'];
		$save_background_color = $_POST['background_color'];
		$save_table_font_size = $_POST['table_font_size'];
		
		$query = "UPDATE `settings` SET `title`='$save_title', `date`='$save_date', `location`='$save_location', `color_palette`='$save_color_palette', `primary_color`='$save_primary_color', `secondary_color`='$save_secondary_color', `background_color`='$save_background_color', `table_font_size`='$save_table_font_size' WHERE `id`='1'";
		$result = mysqli_query($mysqli, $query);
		
		$settings_title = $save_title;
		$settings_date = $save_date;
		#$settings_time = $save_time;
		#$settings_delay = $save_delay;
		$settings_location = $save_location;
		$settings_color_palette = $save_color_palette;
		$settings_primary_color = $save_primary_color;
		$settings_secondary_color = $save_secondary_color;
		$settings_background_color = $save_background_color;
		$settings_table_font_size = $save_table_font_size;
		
	}

?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<title>Administration</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		
		<!--Import Google Icon Font-->
		<link href="../include/css/material-icons.css" rel="stylesheet">
		
		<!--Import materialize.css-->
		<link rel="stylesheet" href="../include/css/materialize.min.css">

		<!--jQuery-->
		<script src="../include/js/jquery-3.7.1.min.js"></script>
		
		<!--Custom JS-->
		<script>
			$(document).ready(function(){
				$('.datepicker').datepicker();
				$('.timepicker').timepicker();
				$('select').formSelect();
			});
		</script>

		<!-- Custom CSS -->
		<style>
			:root {
				--primary-color: #<?php echo $settings_primary_color; ?>;
				--secondary-color: #<?php echo $settings_secondary_color; ?>;
				--background-color: #<?php echo $settings_background_color; ?>;
			}
		</style>
		<link rel="stylesheet" href="../include/css/custom.css">

	</head>
	<body>

		<!-- Navbar -->
		<div class="navbar-fixed">
			<nav class="<?php echo $settings_color_palette; ?>">
				<div class="nav-wrapper">
					<a href="./" class="brand-logo center">Administration</a>
					<ul class="right hide-on-med-and-down">
						<?php
							if(!empty($_SESSION['id'])) {
								echo '
									<li><a href="../"><i class="material-icons">home</i></a></li>
									<li><a href="./"><i class="material-icons">settings</i></a></li>
									<li><a href="./?a=logout"><i class="material-icons">logout</i></a></li>
								';
							}
							else {
								echo '
									<li><a href="../"><i class="material-icons">home</i></a></li>
									<li><a href="./"><i class="material-icons">settings</i></a></li>
								';
							}
						?>
					</ul>
				</div>
			</nav>
		</div>
		
		<main>
			<div class="container">
			
				<!-- Include Content -->
				<?php
				
					if(empty($_SESSION['id'])) {
						include('login.php');
					}else include('settings.php');
					
				?>
				
				
			</div>
		</main>

		<footer class="page-footer <?php echo $settings_color_palette; ?>">
			<div class="container">
				
			</div>
		</footer>
		
		<!--JavaScript at end of body for optimized loading-->
		<script src="../include/js/materialize.min.js"></script>
	</body>		
</html>