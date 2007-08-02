<?php 
	if (!isset( $_GET['template'] )) {
?>
<div class="wrap">
	<p><strong><?php _e('No template has been supplied!') ?></strong></p>
</div>
<?php
	} else {
		// Get the original template
		$id = $_GET['template'];		
		$template = post_templates_get_post($id);
		
		// Copy the post and insert it as a template
		if (isset($template) && $template!=null) {
			$new_id = post_templates_create_post_from_template($template);
		
			// Show the post edit
			echo '<meta content="0; URL=post.php?action=edit&post=' . $new_id . '" http-equiv="Refresh" />';
			exit;
		} else {
?>
<div class="wrap">
	<p><strong><?php _e('Post creation failed, could not find template: ') . $id ?></strong></p>
</div>
<?php
		}
	}
?>