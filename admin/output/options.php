<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php echo $this->get_setting('head_title_prefix'); ?>Options</h2>
	<form method="post" action="options.php">
		<?php
		settings_fields($this->get_setting('options_prefix') . 'options');
		$options['icon'] = get_option($this->get_setting('options_prefix') . 'icon');
		$options['general'] = get_option($this->get_setting('options_prefix') . 'general');
		$options['icons'] = get_option($this->get_setting('options_prefix') . 'icons');
		?>
		<h3>Icons</h3>
		<p>The options listed below affect the appereance of the icons on the images in your posts.</p>
		<table class="form-table">
			<tr>
				<th>Icon set</th>
				<td>
					<select name="<?php echo $this->get_setting('options_prefix'); ?>icon[iconset]">
						<option value="0" <?php selected($options['icon']['iconset'], 0); ?>>Default</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Icon size</th>
				<td>
					<select name="<?php echo $this->get_setting('options_prefix'); ?>icon[iconsize]">
						<option value="1" <?php selected($options['icon']['iconsize'], 1); ?>>16 x 16</option>
						<option value="2" <?php selected($options['icon']['iconsize'], 2); ?>>24 x 24</option>
						<option value="3" <?php selected($options['icon']['iconsize'], 3); ?>>48 x 48</option>
						<option value="4" <?php selected($options['icon']['iconsize'], 4); ?>>60 x 60</option>
					</select> px
				</td>
			</tr>
		</table>
		<h3>General</h3>
		<p>Below are the general options for this plug-in.</p>
		<table class="form-table">
			<tr>
				<th>Show icons on</th>
				<td>
					<select name="<?php echo $this->get_setting('options_prefix'); ?>general[showon]">
						<option value="1" <?php selected($options['general']['showon'], 1); ?>>1st image</option>
						<option value="2" <?php selected($options['general']['showon'], 2); ?>>Every image</option>
						<option value="3" <?php selected($options['general']['showon'], 3); ?>>Last image</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Show in categories:</th>
				<td>
					<input type="text" name="<?php echo $this->get_setting('options_prefix'); ?>general[show_categories]" value="<?php echo $options['general']['show_categories']; ?>" />
					<span class="description">Category ID's, seperated by comma's (example: <code>2,5,12</code>). Leave blank for all</span>
				</td>
			</tr>
			<tr>
				<th>Hide in posts/pages:</th>
				<td>
					<input type="text" name="<?php echo $this->get_setting('options_prefix'); ?>general[hide_posts]" value="<?php echo $options['general']['hide_posts']; ?>" />
					<span class="description">Post/page ID's, seperated by comma's (example: <code>3,8,22,18</code>). Leave blank for none</span>
				</td>
			</tr>
		</table>
		<p>For making the buttons and their targets more clear, it is possible to put a color overlay over an image when the mouse hovers over it. It is, for the same reason, possible to enable a smaller overlay at the bottom of the screen which shows the text belonging to the hovered button.</p>
		<table class="form-table">
			<tr>
				<th>Color overlay</th>
				<td>
					<p><label for="wpis-coloroverlay-enabled"><input type="checkbox" name="<?php echo $this->get_setting('options_prefix'); ?>general[coloroverlay_enabled]" id="wpis-coloroverlay-enabled" value="1" <?php checked($options['general']['coloroverlay_enabled']); ?> /> Enabled</label></p>
					<p>Color: #<input type="text" name="<?php echo $this->get_setting('options_prefix'); ?>general[coloroverlay_color]" id="wpis-coloroverlay-color" class="wpis-colorpicker" value="<?php echo ($options['general']['coloroverlay_color'] ? $options['general']['coloroverlay_color'] : '000000'); ?>" /><p>
					<p>Opacity: </p><input type="text" id="wpis-coloroverlay-opacity" name="<?php echo $this->get_setting('options_prefix'); ?>general[coloroverlay_opacity]" value="<?php echo ($options['general']['coloroverlay_color'] ? $options['general']['coloroverlay_opacity'] : '0'); ?>" style="background: none; width: 32px;" />%</p>
					<p><div id="wpis-coloroverlay-opacity-slider" class="wpis-slider"></div></p>
				</td>
			</tr>
			<tr>
				<th>Text overlay</th>
				<td>
					<p><label for="wpis-textoverlay-enabled"><input type="checkbox" name="<?php echo $this->get_setting('options_prefix'); ?>general[textoverlay_enabled]" id="wpis-textoverlay-enabled" value="1" <?php checked($options['general']['textoverlay_enabled']); ?> /> Enabled</label></p>
					<p>Color: #<input type="text" name="<?php echo $this->get_setting('options_prefix'); ?>general[textoverlay_color]" id="wpis-textoverlay-color" class="wpis-colorpicker" value="<?php echo ($options['general']['textoverlay_color'] ? $options['general']['textoverlay_color'] : '000000'); ?>" /><p>
					<p>Opacity: </p><input type="text" id="wpis-textoverlay-opacity" name="<?php echo $this->get_setting('options_prefix'); ?>general[textoverlay_opacity]" value="<?php echo ($options['general']['textoverlay_color'] ? $options['general']['textoverlay_opacity'] : '0'); ?>" style="background: none; width: 32px;" />%</p>
					<p><div id="wpis-textoverlay-opacity-slider" class="wpis-slider"></div></p>
					<p>Text color: #<input type="text" name="<?php echo $this->get_setting('options_prefix'); ?>general[textoverlay_textcolor]" id="wpis-textoverlay-textcolor" class="wpis-colorpicker" value="<?php echo ($options['general']['textoverlay_color'] ? $options['general']['textoverlay_textcolor'] : '000000'); ?>" /><p>
				</td>
			</tr>
		</table>
		<table class="widefat">
			<thead>
				<tr>
					<th>Enabled</th>
					<th>Name</th>
					<th>Order</th>
					<th>Text</th>
					<th>URL</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($this->get_icons() as $index => $icon) {
				?>
					<tr>
						<td>
							<input type="checkbox" name="<?php echo $this->get_setting('options_prefix'); ?>icons[<?php echo $index; ?>_enabled]" class="checkbox" value="1" <?php checked($options['icons'][$index . '_enabled']); ?> />
						</td>
						<td>
							<img src="<?php echo $this->get_setting('plugin_url'); ?>/public/img/icons/16x16/<?php echo $index; ?>.png" alt="" /> <?php echo $icon->name; ?>
						</td>
						<td>
							<select name="<?php echo $this->get_setting('options_prefix'); ?>icons[<?php echo $index; ?>_order]">
								<?php
								for ($i = 0; $i < 20; $i++) {
									$istring = strval($i + 1);
									
									echo '<option value="' . $istring . '" ' . selected($options['icons'][$index . '_order'], $istring) . '>' . $istring . '</option>';
								}
								?>
							</select>
						</td>
						<td>
							<input type="text" name="<?php echo $this->get_setting('options_prefix'); ?>icons[<?php echo $index; ?>_text]" value="<?php echo ($options['icons'][$index . '_text'] ? $options['icons'][$index . '_text'] : $icon->text_default); ?>" /> 
						</td>
						<td>
							<input type="text" name="<?php echo $this->get_setting('options_prefix'); ?>icons[<?php echo $index; ?>_url]" value="<?php echo ($options['icons'][$index . '_url'] ? $options['icons'][$index . '_url'] : $icon->url_default); ?>" class="regular-text" /> 
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Enabled</th>
					<th>Name</th>
					<th>Order</th>
					<th>Text</th>
					<th>URL</th>
				</tr>
			</tfoot>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save changes'); ?>" />
		</p>
	</form>
</div>