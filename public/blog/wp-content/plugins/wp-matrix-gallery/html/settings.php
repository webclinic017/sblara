<?php
global $wpdb, $gmtr;
$ops = get_option('mtr_settings', array());
//$ops = array_merge($mtr_settings, $ops);
?>
<div class="wrap">
	<h2><?php _e('Create XML File'); ?></h2>
	<form action="" method="post">
		<input type="hidden" name="task" value="save_mtr_settings" />
		<table>
				<tr>
			<td title="<?php _e('Width of Slideshow.'); ?>"><?php _e('Slideshow Width'); ?></td>
			<td><input type="text" name="settings[slideshow_width]"  value="<?php print @$ops['slideshow_width']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Height of Slideshow '); ?>"><?php _e('Slideshow Height'); ?></td>
			<td><input type="text" name="settings[slideshow_height]"  value="<?php print @$ops['slideshow_height']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Slideshow Background Color '); ?>"><?php _e('Slideshow Background Color'); ?></td>
			<td><input type="text" name="settings[slideshow_bgcolor]" class="color {hash:false,caps:false}" value="<?php print @$ops['slideshow_bgcolor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumbnail display Position Left/Right.'); ?>"><?php _e('Thumbnail Position'); ?></td>
			<td>
				<input type="radio" name="settings[thumb_align]" value="left" <?php print (@$ops['thumb_align'] == 'left') ? 'checked' : ''; ?>><span><?php _e('Left'); ?></span>
				<input type="radio" name="settings[thumb_align]" value="right" <?php print (@$ops['thumb_align'] == 'right') ? 'checked' : ''; ?>><span><?php _e('Right'); ?></span>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Number of columns for the thumbnails '); ?>"><?php _e('Number of columns for the thumbnails'); ?></td>
			<td><input type="text" name="settings[thumb_coloumn]"  value="<?php print @$ops['thumb_coloumn']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Number of rows for the thumbnails '); ?>"><?php _e('Number of rows for the thumbnails'); ?></td>
			<td><input type="text" name="settings[thumb_rows]"  value="<?php print @$ops['thumb_rows']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Pagination circle button color '); ?>"><?php _e('Pagination circle button color'); ?></td>
			<td><input type="text" name="settings[pagination_butcolor]" class="color {hash:false,caps:false}" value="<?php print @$ops['pagination_butcolor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Pagination circle selected button color '); ?>"><?php _e('Pagination circle selected button color'); ?></td>
			<td><input type="text" name="settings[pagination_selbutcolor]" class="color {hash:false,caps:false}" value="<?php print @$ops['pagination_selbutcolor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Description text color '); ?>"><?php _e('imageshow Text Color'); ?></td>
			<td><input type="text" name="settings[imageshow_textcolor]" class="color {hash:false,caps:false}" value="<?php print @$ops['imageshow_textcolor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumbnail Image width '); ?>"><?php _e('Thumb Width'); ?></td>
			<td><input type="text" name="settings[thumb_width]"  value="<?php print @$ops['thumb_width']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumbnail Image height '); ?>"><?php _e('Thumb Height'); ?></td>
			<td><input type="text" name="settings[thumb_height]"  value="<?php print @$ops['thumb_height']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumbnail Image margin '); ?>"><?php _e('Thumb Margin'); ?></td>
			<td><input type="text" name="settings[thumb_margin]"  value="<?php print @$ops['thumb_margin']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumbnail Image border '); ?>"><?php _e('Thumb Border'); ?></td>
			<td><input type="text" name="settings[thumb_border]"  value="<?php print @$ops['thumb_border']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumbnail Image border color'); ?>"><?php _e('Thumb Border Color'); ?></td>
			<td><input type="text" name="settings[thumbborder_color]" class="color {hash:false,caps:false}" value="<?php print @$ops['thumbborder_color']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Full Image Area Width'); ?>"><?php _e('Full Image Area Width'); ?></td>
			<td><input type="text" name="settings[mainslide_width]"  value="<?php print @$ops['mainslide_width']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Full Image Area Height'); ?>"><?php _e('Full Image Area Height'); ?></td>
			<td><input type="text" name="settings[mainslide_height]"  value="<?php print @$ops['mainslide_height']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Image Scaling for thumb and Main image.'); ?>"><?php _e('Image Scaling'); ?></td>
			<td>
				<input type="radio" name="settings[image_scaling]" value="yes" <?php print (@$ops['image_scaling'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[image_scaling]" value="no" <?php print (@$ops['image_scaling'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Show Description.'); ?>"><?php _e('Show Description'); ?></td>
			<td>
				<input type="radio" name="settings[show_desc]" value="yes" <?php print (@$ops['show_desc'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[show_desc]" value="no" <?php print (@$ops['show_desc'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Image clickable.'); ?>"><?php _e('Image Clickable'); ?></td>
			<td>
				<input type="radio" name="settings[use_link]" value="yes" <?php print (@$ops['use_link'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[use_link]" value="no" <?php print (@$ops['use_link'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Open Targetlink in samewindow/new window.'); ?>"><?php _e('Target Link'); ?></td>
			<td>
				<select name="settings[target]">
					<option value="_self" <?php print (@$ops['target'] == '_self') ? 'selected' : ''; ?>><?php _e('Same Window'); ?></option>
					<option value="_blank" <?php print (@$ops['target'] == '_blank') ? 'selected' : ''; ?>><?php _e('New Window'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Select the wmode of flash'); ?>"><?php _e('wmode'); ?></td>
			<td>
				<select name="settings[wmode]">
					<option value="opaque" <?php print (@$ops['wmode'] == 'opaque') ? 'selected' : ''; ?>><?php _e('opaque'); ?></option>
					<option value="transparent" <?php print (@$ops['wmode'] == 'transparent') ? 'selected' : ''; ?>><?php _e('transparent'); ?></option>
					<option value="window" <?php print (@$ops['wmode'] == 'window') ? 'selected' : ''; ?>><?php _e('window'); ?></option>
				</select>
			</td>
		</tr>
		</table>
	<p><button type="submit" class="button-primary"><?php _e('Save Config'); ?></button></p>
	</form>
</div>