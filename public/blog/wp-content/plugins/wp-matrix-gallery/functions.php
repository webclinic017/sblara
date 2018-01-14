<?php
function mtr_get_def_settings()
{
	$mtr_settings = array('slideshow_width' => '750',
			'slideshow_height' => '470',
			'slideshow_bgcolor' => '333333',
			'thumb_align' => 'left',
			'thumb_coloumn' => '3',
			'thumb_rows' => '5',
			'pagination_butcolor' => '666666',
			'pagination_selbutcolor' => 'FFFFFF',
			'imageshow_textcolor' => 'FFFFFF',
			'thumb_width' => '80',
			'thumb_height' => '60',
			'thumb_margin' => '12',
			'thumb_border' => '2',
			'thumbborder_color' => 'FFFFFF',
			'mainslide_width' => '400',
			'mainslide_height' => '400',
			'image_scaling' => 'yes',
			'show_desc' => 'yes',
			'use_link' => 'yes',
			'target' => '_blank',
			'wmode' => 'transparent'	
			);
	return $mtr_settings;
}
function __get_mtr_xml_settings()
{
	$ops = get_option('mtr_settings', array());

	$xml_settings = '<gallery
	align="'.$ops['thumb_align'].'"
	columns="'.$ops['thumb_coloumn'].'"
	rows="'.$ops['thumb_rows'].'"
	backgroundColor="0x'.$ops['slideshow_bgcolor'].'"
	circleButtonColor="0x'.$ops['pagination_butcolor'].'"
	currentCircleButtonColor="0x'.$ops['pagination_selbutcolor'].'"	
	textColor="0x'.$ops['imageshow_textcolor'].'"
	thumbWidth="'.$ops['thumb_width'].'"
	thumbHeight="'.$ops['thumb_height'].'"   
	thumbPadding="'.$ops['thumb_margin'].'" 
	thumbBorder="'.$ops['thumb_border'].'"
	thumbBorderColor="0x'.$ops['thumbborder_color'].'"
	assetWidth="'.$ops['mainslide_width'].'"
	assetHeight="'.$ops['mainslide_height'].'"
	showImageShadow="'.$ops['showimg_shadow'].'"
	target="'.$ops['target'].'">';
	return $xml_settings;
}
function mtr_get_album_dir($album_id)
{
	global $gmtr;
	$album_dir = MTR_PLUGIN_UPLOADS_DIR . "/{$album_id}_uploadfolder";
	return $album_dir;
}
/**
 * Get album url
 * @param $album_id
 * @return unknown_type
 */
function mtr_get_album_url($album_id)
{
	global $gmtr;
	$album_url = MTR_PLUGIN_UPLOADS_URL . "/{$album_id}_uploadfolder";
	return $album_url;
}
function mtr_get_table_actions(array $tasks)
{
	?>
	<div class="bulk_actions">
		<form action="" method="post" class="bulk_form">Bulk action
			<select name="task">
				<?php foreach($tasks as $t => $label): ?>
				<option value="<?php print $t; ?>"><?php print $label; ?></option>
				<?php endforeach; ?>
			</select>
			<button class="button-secondary do_bulk_actions" type="submit">Do</button>
		</form>
	</div>
	<?php 
}
function shortcode_display_mtr_gallery($atts)
{
	$vars = shortcode_atts( array(
									'cats' => '',
									'imgs' => '',
								), 
							$atts );
	//extract( $vars );
	
	$ret = display_mtr_gallery($vars);
	return $ret;
}
function display_mtr_gallery($vars)
{
	global $wpdb, $gmtr;
	$ops = get_option('mtr_settings', array());
	//print_r($ops);
	$albums = null;
	$images = null;
	$cids = trim($vars['cats']);
	if (strlen($cids) != strspn($cids, "0123456789,")) {
		$cids = '';
		$vars['cats'] = '';
	}
	$imgs = trim($vars['imgs']);
	if (strlen($imgs) != strspn($imgs, "0123456789,")) {
		$imgs = '';
		$vars['imgs'] = '';
	}
	$categories = '';
	$xml_filename = '';
	if( !empty($cids) && $cids{strlen($cids)-1} == ',')
	{
		$cids = substr($cids, 0, -1);
	}
	if( !empty($imgs) && $imgs{strlen($imgs)-1} == ',')
	{
		$imgs = substr($imgs, 0, -1);
	}
	//check for xml file
	if( !empty($vars['cats']) )
	{
		$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';	
	}
	elseif( !empty($vars['imgs']))
	{
		$xml_filename = "image_".str_replace(',', '', $imgs) . '.xml';
	}
	else
	{
		$xml_filename = "mtr_all.xml";
	}
	//die(MTR_PLUGIN_XML_DIR . '/' . $xml_filename);


	
	if( !empty($vars['cats']) )
	{
		$query = "SELECT * FROM {$wpdb->prefix}mtr_albums WHERE album_id IN($cids) AND status = 1 ORDER BY `order` ASC";
		//print $query;
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $gmtr->mtr_get_album_images($album['album_id']);
			if ($images && !empty($images) && is_array($images)) {
				$album_dir = mtr_get_album_url($album['album_id']);//MTR_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				foreach($images as $key => $img)
				{
					if( $img['status'] == 0 ) continue;
													
					$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $img['image']);
					if(trim($ext)=='flv'){
						$type="video";
					}else{
						 $type="image";
					}
					$categories .= '<asset 
					
					thumbnail="'.$album_dir."/thumb/".$img['thumb'].'" 
					url="'.$album_dir."/big/".$img['image'].'" 
					type="'.$type.'"
					scale="'.(($ops['image_scaling'] == 'yes') ? 'true' : 'false').'"';

					$categories .= ' label=""';

					if (trim($ops['show_desc']) == 'yes') {
						$categories .= ' description="'.trim($img['description']).'"';
					}else{
						$categories .= ' description=""';
					}

					if (trim($ops['use_link']) == 'yes') {
						$categories .= ' link="'.trim($img['link']).'">';
					}else{
						$categories .= ' link="">';
					}

					$categories .= '</asset>';
				}
			}
		}
		//$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';
	}
	elseif( !empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}mtr_images WHERE image_id IN($imgs) AND status = 1 ORDER BY `order` ASC";
		$images = $wpdb->get_results($query, ARRAY_A);
		if ($images && !empty($images) && is_array($images)) {
			foreach($images as $key => $img)
			{
				$album = $gmtr->mtr_get_album($img['category_id']);
				$album_dir = mtr_get_album_url($album['album_id']);//MTR_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				if( $img['status'] == 0 ) continue;
				
				$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $img['image']);
					if(trim($ext)=='flv'){
						$type="video";
					}else{
						 $type="image";
					}
					$categories .= '<asset 
					
					thumbnail="'.$album_dir."/thumb/".$img['thumb'].'" 
					url="'.$album_dir."/big/".$img['image'].'" 
					type="'.$type.'"
					scale="'.(($ops['image_scaling'] == 'yes') ? 'true' : 'false').'"';

					$categories .= ' label=""';

					if (trim($ops['show_desc']) == 'yes') {
						$categories .= ' description="'.trim($img['description']).'"';
					}else{
						$categories .= ' description=""';
					}

					if (trim($ops['use_link']) == 'yes') {
						$categories .= ' link="'.trim($img['link']).'">';
					}else{
						$categories .= ' link="">';
					}

					$categories .= '</asset>';
			}
		}
	}
	//no values paremeters setted
	else//( empty($vars['cats']) && empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}mtr_albums WHERE status = 1 ORDER BY `order` ASC";
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $gmtr->mtr_get_album_images($album['album_id']);
			$album_dir = mtr_get_album_url($album['album_id']);//MTR_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
			if ($images && !empty($images) && is_array($images)) {
				foreach($images as $key => $img)
				{
					if($img['status'] == 0 ) continue;
					
					$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $img['image']);
					if(trim($ext)=='flv'){
						$type="video";
					}else{
						 $type="image";
					}
					$categories .= '<asset 
					
					thumbnail="'.$album_dir."/thumb/".$img['thumb'].'" 
					url="'.$album_dir."/big/".$img['image'].'" 
					type="'.$type.'"
					scale="'.(($ops['image_scaling'] == 'yes') ? 'true' : 'false').'"';

					$categories .= ' label=""';

					if (trim($ops['show_desc']) == 'yes') {
						$categories .= ' description="'.trim($img['description']).'"';
					}else{
						$categories .= ' description=""';
					}

					if (trim($ops['use_link']) == 'yes') {
						$categories .= ' link="'.trim($img['link']).'">';
					}else{
						$categories .= ' link="">';
					}

					$categories .= '</asset>';
				}
			}
		}
		//$xml_filename = "mtr_all.xml";
	}
	
	$xml_tpl = __get_mtr_xml_template();
	$settings = __get_mtr_xml_settings();
	$xml = str_replace(array('{settings}', '{categories}'), 
						array($settings, $categories), $xml_tpl);
	//write new xml file
	$fh = fopen(MTR_PLUGIN_XML_DIR . '/' . $xml_filename, 'w+');
	fwrite($fh, $xml);
	fclose($fh);
	//print "<h3>Generated filename: $xml_filename</h3>";
	//print $xml;
	if( file_exists(MTR_PLUGIN_XML_DIR . '/' . $xml_filename ) )
	{
		$fh = fopen(MTR_PLUGIN_XML_DIR . '/' . $xml_filename, 'r');
		$xml = fread($fh, filesize(MTR_PLUGIN_XML_DIR . '/' . $xml_filename));
		fclose($fh);
		//print "<h3>Getting xml file from cache: $xml_filename</h3>";
		$ret_str =  "
		<script language=\"javascript\">AC_FL_RunContent = 0;</script>
<script src=\"".MTR_PLUGIN_URL."/js/AC_RunActiveContent.js\" language=\"javascript\"></script>

		<script language=\"javascript\"> 
	if (AC_FL_RunContent == 0) {
		alert(\"This page requires AC_RunActiveContent.js.\");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '".$ops['slideshow_width']."',
			'height', '".$ops['slideshow_height']."',
			'src', '".MTR_PLUGIN_URL."/js/wp_matrix',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', '".$ops['wmode']."',
			'devicefont', 'false',
			'id', 'xmlswf_vmmtr',
			'bgcolor', '".$ops['slideshow_bgcolor']."',
			'name', 'xmlswf_vmmtr',
			'menu', 'true',
			'allowFullScreen', 'true',
			'allowScriptAccess','sameDomain',
			'movie', '".MTR_PLUGIN_URL."/js/wp_matrix',
			'salign', '',
			'flashVars','xmlURL=".MTR_PLUGIN_URL."/xml/$xml_filename'
			); //end AC code
	}
</script>
";
//echo MTR_PLUGIN_UPLOADS_URL."<hr>";
//		print $xml;
		return $ret_str;
	}
	return true;
}
function __get_mtr_xml_template()
{
	$xml_tpl = '<?xml version="1.0" encoding="utf-8"?>
	{settings}
	{categories}
	</gallery>';
	return $xml_tpl;
}
?>