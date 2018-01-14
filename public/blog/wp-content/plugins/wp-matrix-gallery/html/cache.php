<?php
global $gmtr; 
?>
<div class="wrap">
	<h2><?php _e('Delete Cache'); ?></h2>
	<?php if(isset($gmtr->messages['cache']) && !empty($gmtr->messages['cache'])):?>
	<div class="info"><p><?php print implode($gmtr->messages['cache'], '<br/>')?></p></div>
	<?php endif;?>
	<form action="" method="post">
		<input type="hidden" name="task" value="mtr_delete_cache" />
		<p><input type="checkbox" name="delete_cache" value="1" /><label><?php _e('Delete Cache');?></label></p>
		<p><button type="submit" class="button-primary"><?php _e('Submit'); ?></button></p>
	</form>
</div>