<br />

<div class="row">

	<form class="col s12 m8 l6 offset-m2 offset-l3 z-depth-2" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	
		<h4 class="center-align">Administration</h4>
		
		<div class="input-field center-align">
			<input id="passwort" name="login_pass" type="password" class="validate" required>
			<label for="passwort">Passwort</label>
		</div>
		<div class="input-field center-align">
			<button class="btn waves-effect waves-light <?php echo $colorclass; ?>" type="submit" name="login">Anmelden
				<i class="material-icons right">send</i>
			</button>
		</div>
		
		<?php if(!empty($error)) { echo '<span class="center-align">'.$error.'</span>'; } ?>
	
	</form>
</div>