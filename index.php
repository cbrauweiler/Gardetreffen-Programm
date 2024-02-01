<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
session_start();

# Config
include('./include/config.php');

# Uhrzeit
if(isset($_GET['devtime'])) {
	$ct = $_GET['devtime'];
}
else {
	$ct = date("H:i", time());
}

# Logout
if(isset($_GET['a']) && $_GET['a'] == 'logout') {
	session_destroy();
	session_start();
}

# Verzögerungszeit ändern
if(isset($_POST['m10'])) {	
	$query = "UPDATE `settings` SET `delay`=(delay - 10) WHERE `id`='1'";
	mysqli_query($mysqli, $query);
}
if(isset($_POST['m5'])) {	
	$query = "UPDATE `settings` SET `delay`=(delay - 5) WHERE `id`='1'";
	mysqli_query($mysqli, $query);
}
if(isset($_POST['p5'])) {	
	$query = "UPDATE `settings` SET `delay`=(delay + 5) WHERE `id`='1'";
	mysqli_query($mysqli, $query);
}
if(isset($_POST['p10'])) {	
	$query = "UPDATE `settings` SET `delay`=(delay + 10) WHERE `id`='1'";
	mysqli_query($mysqli, $query);
}

# Neuen Auftritt speichern
if(isset($_POST['save'])) {	
	$auftrittszeit = $_POST['auftrittszeit'];
	$tanzgruppe = $_POST['tanzgruppe'];
	
	$query = "INSERT INTO `list` (`time`, `groupname`) VALUES ('$auftrittszeit', '$tanzgruppe')";
	mysqli_query($mysqli, $query);
}
?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<title><?php echo $settings_title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		
		<!--Import Google Icon Font-->
		<link href="./include/css/material-icons.css" rel="stylesheet">
		
		<!--Import materialize.css-->
		<link rel="stylesheet" href="./include/css/materialize.min.css">

		<!--jQuery-->
		<script src="./include/js/jquery-3.7.1.min.js"></script>

		<!--Custom JS-->
		<script>
		
			// Uhrzeit
			function showTime(){
				var date = new Date();
				var h = date.getHours(); // 0 - 23
				var m = date.getMinutes(); // 0 - 59
				var s = date.getSeconds(); // 0 - 59				

				h = (h < 10) ? "0" + h : h;
				m = (m < 10) ? "0" + m : m;
				s = (s < 10) ? "0" + s : s;

				var time = h + ":" + m + ":" + s;
				document.getElementById("MyClockDisplay").innerText = time;
				document.getElementById("MyClockDisplay").textContent = time;

				setTimeout(showTime, 1000);

			}
			
			// Daten aus mySQL abrufen
			function mySQLData(){
				
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET", "main.php?time=" + "<?php echo $ct; ?>", true);
				xmlhttp.onreadystatechange=function() {
					
					if (xmlhttp.readyState==4) {
					
						document.getElementById("sqloutput").innerHTML=xmlhttp.responseText;
					
					}
					
				}
				
				xmlhttp.send(null);
				
				setTimeout(mySQLData, 10000);
				
			}
			
		</script>

		<!-- Custom CSS -->
		<style>
			:root {
				--primary-color: #<?php echo $settings_primary_color; ?>;
				--secondary-color: #<?php echo $settings_secondary_color; ?>;
				--background-color: #<?php echo $settings_background_color; ?>;
			}
		</style>
		<link rel="stylesheet" href="./include/css/custom.css">

	</head>
	<body onload="mySQLData();<?php if(!isset($_GET['devtime'])) { echo 'showTime();'; } ?>">
	
		<!-- Navbar -->
		<div class="navbar-fixed">
			<nav class="<?php echo $settings_color_palette; ?>">
				<div class="nav-wrapper">
					<a href="./" class="brand-logo center"><?php echo $settings_title; ?></a>
					<ul class="right hide-on-med-and-down">
						<?php
							if(!empty($_SESSION['id'])) {
								echo '
									<li><a href="./"><i class="material-icons">home</i></a></li>
									<li><a href="./admin/"><i class="material-icons">settings</i></a></li>
									<li><a href="?a=logout"><i class="material-icons">logout</i></a></li>
								';
							}
							else {
								echo '
									<li><a href="./"><i class="material-icons">home</i></a></li>
									<li><a href="./admin/"><i class="material-icons">settings</i></a></li>
								';
							}
						?>
					</ul>
				</div>
			</nav>
		</div>
		
		<main>
			<div class="container">
			
				<br />
			
				<!-- Header -->
				<div class="row">
					<h3><strong>
						<div class="col s4 center"><?php echo date("d. M Y", strtotime($settings_date)); ?></div>
						<div class="col s4 center" id="MyClockDisplay"><?php if(isset($_GET['devtime'])) { echo $_GET['devtime']; } ?></div>
						<div class="col s4 center"><?php echo $settings_location; ?></div>
					</strong></h3>
				</div>

				<br />

				<!-- Tabelle -->
				<h<?php echo $settings_table_font_size;?>>
				<table class="striped centered">
					<thead>
					  <tr>
						<th>Auftrittszeit</th>
						<th>Tanzgruppe</th>
					  </tr>
					</thead>
					<tbody id="sqloutput">
						
					</tbody>
				</table>
				</h<?php echo $settings_table_font_size;?>>

				<?php
				// Formular für neuen Auftritt & Verzögerung
				if(!empty($_SESSION['id'])) {
					echo '
						<br /><br />
					
						<div class="row">
							<form class="col s12 center" method="POST" action="'.$_SERVER['PHP_SELF'].'">
								<h5>Verzögerungszeit ändern</h5>
								<div class="row">
									<div class="input-field col s3">
										<button class="btn waves-effect waves-light" type="submit" name="m10">10 Minuten
											<i class="material-icons left">remove</i>
										</button>
									</div>
									<div class="input-field col s3">
										<button class="btn waves-effect waves-light" type="submit" name="m5">5 Minuten
											<i class="material-icons left">remove</i>
										</button>
									</div>
									<div class="input-field col s3">
										<button class="btn waves-effect waves-light" type="submit" name="p5">5 Minuten
											<i class="material-icons left">add</i>
										</button>
									</div>
									<div class="input-field col s3">
										<button class="btn waves-effect waves-light" type="submit" name="p10">10 Minuten
											<i class="material-icons left">add</i>
										</button>
									</div>
								</div>
							</form>
						</div>
						
						<br />
						
						<div class="row">
							<form class="col s12 center" method="POST" action="'.$_SERVER['PHP_SELF'].'">								
								<h5>Neue Tanzgruppe hinzufügen</h5>
								<div class="row">
									<div class="input-field col s3">
										<input id="auftrittszeit" name="auftrittszeit" type="text" placeholder="hh:mm" class="validate" required>
										<label for="auftrittszeit">Auftrittszeit</label>
									</div>
									<div class="input-field col s6">
										<input id="tanzgruppe" name="tanzgruppe" type="text" class="validate" required>
										<label for="tanzgruppe">Tanzgruppe</label>
									</div>
									<div class="input-field col s3">
										<button class="btn waves-effect waves-light" type="submit" name="save">Hinzufügen
											<i class="material-icons right">send</i>
										</button>
									</div>
								</div>
							</form>
						</div>
					';
				}
				?>
				
				
			</div>
		</main>

		<footer class="page-footer <?php echo $settings_color_palette; ?>">
			<div class="container">
				
			</div>
		</footer>
		
		<!--JavaScript at end of body for optimized loading-->
		<script src="./include/js/materialize.min.js"></script>
	</body>		
</html>