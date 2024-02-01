<div class="row">
	<h3>Einstellungen</h3>
</div>

<div class="row">
	<form class="col s12" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="row">
			<div class="input-field col s12">
				<input id="title" name="title" type="text" class="validate" value="<?php echo $settings_title; ?>">
				<label for="title">Seitentitel</label>
			</div>
			<div class="input-field col s12">
				<input id="location" name="location" type="text" class="validate" value="<?php echo $settings_location; ?>">
				<label for="location">Austragungsort</label>
			</div>
			<div class="input-field col s12">
				<input id="date" name="date" type="text" class="datepicker" value="<?php echo $settings_date; ?>">
				<label for="date">Datum</label>
			</div>
			<div class="input-field col s12">
				<input id="color_palette" name="color_palette" type="text" class="validate" value="<?php echo $settings_color_palette; ?>">
				<label for="color_palette">Farbpalette</label>
			</div>
			<div class="input-field col s12">
				<input id="background_color" name="background_color" type="text" class="validate" value="<?php echo $settings_background_color; ?>">
				<label for="background_color">Hintergrundfarbe</label>
			</div>
			<div class="input-field col s12">
				<input id="primary_color" name="primary_color" type="text" class="validate" value="<?php echo $settings_primary_color; ?>">
				<label for="primary_color">Primärfarbe</label>
			</div>
			<div class="input-field col s12">
				<input id="secondary_color" name="secondary_color" type="text" class="validate" value="<?php echo $settings_secondary_color; ?>">
				<label for="secondary_color">Sekundärfarbe</label>
			</div>
			<div class="input-field col s12">
				<select name="table_font_size">
					<option value="1"<?php if($settings_table_font_size == '1') { echo ' selected'; } ?>>H1</option>
					<option value="2"<?php if($settings_table_font_size == '2') { echo ' selected'; } ?>>H2</option>
					<option value="3"<?php if($settings_table_font_size == '3') { echo ' selected'; } ?>>H3</option>
					<option value="4"<?php if($settings_table_font_size == '4') { echo ' selected'; } ?>>H4</option>
					<option value="5"<?php if($settings_table_font_size == '5') { echo ' selected'; } ?>>H5</option>
					<option value="6"<?php if($settings_table_font_size == '6') { echo ' selected'; } ?>>H6</option>
				</select>
				<label>Schriftgröße</label>
			</div>
			<div class="input-field col s12">
				<button class="btn waves-effect waves-light" type="submit" name="save">Speichern
					<i class="material-icons right">save</i>
				</button>
			</div>
		</div>
	</form>
</div>