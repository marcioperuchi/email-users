<?php
/*  Copyright 2006 Vincent Prat

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
?>

<?php 
	if (!current_user_can('manage_options')) {
		wp_die(__("You are not allowed to change the options of this plugin.", MAILUSERS_I18N_DOMAIN));
	} 
	
	if ( mailusers_get_installed_version() != mailusers_get_current_version() ) {
?>
<div class="wrap">
	<p style="text-color:red;">
		<?php _e('It looks like you have an old version of the plugin activated. Please deactivate the plugin and activate it again to complete the installation of the new version.', MAILUSERS_I18N_DOMAIN); ?>
	</p>		
	<p>
		<?php _e('Installed version:', MAILUSERS_I18N_DOMAIN); ?> <?php echo mailusers_get_installed_version(); ?> <br/>
		<?php _e('Current version:', MAILUSERS_I18N_DOMAIN); ?> <?php echo mailusers_get_current_version(); ?>
	</p>
</div>
<?php
	}
?>

<div class="wrap">

<h2><?php _e('Email Users', MAILUSERS_I18N_DOMAIN); ?> <?php echo mailusers_get_installed_version(); ?></h2>

<div align="center">
	<br class="clear"/>
	<a href="http://email-users.vincentprat.info" target="_blank"><?php _e('Plugin\'s home page', MAILUSERS_I18N_DOMAIN); ?></a>
	<br class="clear"/>
	<br class="clear"/>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="vpratfr@yahoo.fr">
		<input type="hidden" name="item_name" value="Email Users - Wordpress Plugin">
		<input type="hidden" name="no_shipping" value="1">
		<input type="hidden" name="no_note" value="1">
		<input type="hidden" name="currency_code" value="EUR">
		<input type="hidden" name="tax" value="0">
		<input type="hidden" name="lc" value="<?php _e('EN', MAILUSERS_I18N_DOMAIN); ?>">
		<input type="hidden" name="bn" value="PP-DonationsBF">
		<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="PayPal">
		<img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>

<br class="clear"/>

<?php 	
	if (isset($err_msg) && $err_msg!='') { ?>
		<p class="error"><?php echo $err_msg; ?></p>
		<p><?php _e('Please correct the errors displayed above and try again.', MAILUSERS_I18N_DOMAIN); ?></p>
<?php	
	} ?>

<form name="SendEmail" action="options-general.php?page=email-users/email_users_set_options.php" method="post">		
	<input type="hidden" name="send" value="true" />
	<table class="form-table" width="100%" cellspacing="2" cellpadding="5">
	<tr>
		<th scope="row" valign="top">
			<label for="mail_format"><?php _e('Mail format', MAILUSERS_I18N_DOMAIN); ?></th>
		<td>
			<select name="default_mail_format" style="width: 158px;">
				<option value="html" <?php if (mailusers_get_default_mail_format()=='html') echo 'selected="true"'; ?>><?php _e('HTML', MAILUSERS_I18N_DOMAIN); ?></option>
				<option value="plaintext" <?php if (mailusers_get_default_mail_format()=='plaintext') echo 'selected="true"'; ?>><?php _e('Plain text', MAILUSERS_I18N_DOMAIN); ?></option>
			</select> <?php _e('Send mails as plain text or HTML by default?', MAILUSERS_I18N_DOMAIN); ?></td>
	</tr>
	<tr>
		<th scope="row" valign="top">
			<label for="max_bcc_recipients"><?php _e('BCC limit', MAILUSERS_I18N_DOMAIN); ?></th>
		<td>
			<select name="max_bcc_recipients" style="width: 158px;">
				<option value="0" <?php if (mailusers_get_max_bcc_recipients()=='0') echo 'selected="true"'; ?>><?php _e('None', MAILUSERS_I18N_DOMAIN); ?></option>
				<option value="30" <?php if (mailusers_get_max_bcc_recipients()=='30') echo 'selected="true"'; ?>>30</option>
			</select> <?php _e('Try 30 if you have problems sending emails to many users (some providers forbid too many recipients in BCC field).', MAILUSERS_I18N_DOMAIN); ?>
		</td>
	</tr>
	<tr>
		<th scope="row" valign="top">
			<label for="default_subject"><?php _e('Default notification subject', MAILUSERS_I18N_DOMAIN); ?></th>
		<td>
			<input type="text" name="default_subject" style="width: 550px;" 
				value="<?php echo format_to_edit(mailusers_get_default_subject()); ?>" 
				size="80" /></td>
	</tr>
	<tr>
		<th scope="row" valign="top">
			<label for="default_body"><?php _e('Default notification body', MAILUSERS_I18N_DOMAIN); ?></th>
		<td>
			<textarea rows="10" cols="80" name="default_body" id="default_body" style="width: 550px;"><?php echo mailusers_get_default_body(); ?></textarea>
		</td>
	</tr>
	</table>

<p>
	<?php _e('The various variables you can include in the subject or body templates are:', MAILUSERS_I18N_DOMAIN); ?><br/>
	<ul>
		<li><strong>%BLOG_URL%</strong>: <?php _e('the link to the blog', MAILUSERS_I18N_DOMAIN); ?></li>
		<li><strong>%BLOG_NAME%</strong>: <?php _e('the blog\'s name', MAILUSERS_I18N_DOMAIN); ?></li>
		<li><strong>%FROM_NAME%</strong>: <?php _e('the wordpress user name of the person sending the mail', MAILUSERS_I18N_DOMAIN); ?></li>
		<li><strong>%POST_TITLE%</strong>: <?php _e('the title of the post you want to highlight', MAILUSERS_I18N_DOMAIN); ?></li>
		<li><strong>%POST_EXCERPT%</strong>: <?php _e('the excerpt of the post you want to highlight', MAILUSERS_I18N_DOMAIN); ?></li>
		<li><strong>%POST_URL%</strong>: <?php _e('the link to the post you want to highlight', MAILUSERS_I18N_DOMAIN); ?></li>
	</ul>
</p>

	<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Save changes', MAILUSERS_I18N_DOMAIN); ?> &raquo;" />
	</p>
</form>	

<br class="clear"/>

<p><?php _e('Email Users uses capabilities to define what users are allowed to do. Below is a list of the capabilities used by the plugin and the default user role allowed to make these actions.', MAILUSERS_I18N_DOMAIN); ?> <?php _e('If you want to change the roles having those capabilities, you should use the plugin:', MAILUSERS_I18N_DOMAIN); ?> <a href="http://www.im-web-gefunden.de/wordpress-plugins/role-manager/" target="_blank">Role Manager</a></p>

<table class="widefat">
	<thead>
	<tr>
		<th><?php _e('Capability', MAILUSERS_I18N_DOMAIN); ?></th>
		<th><?php _e('Description', MAILUSERS_I18N_DOMAIN); ?></th>
		<th><?php _e('Default roles', MAILUSERS_I18N_DOMAIN); ?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><b>manage-options</b></td>
		<td><?php _e('Access this options page.', MAILUSERS_I18N_DOMAIN); ?></td>
		<td><?php _e('Administrators only.', MAILUSERS_I18N_DOMAIN); ?></td>
	</tr>
	<tr>
		<td><b><?php echo MAILUSERS_EMAIL_SINGLE_USER_CAP; ?></b></td>
		<td><?php _e('Send an email to a single user.', MAILUSERS_I18N_DOMAIN); ?></td>
		<td><?php _e('Administrators, editors, authors and contributors.', MAILUSERS_I18N_DOMAIN); ?></td>
	</tr>
	<tr>
		<td><b><?php echo MAILUSERS_EMAIL_MULTIPLE_USERS_CAP; ?></b></td>
		<td><?php _e('Send an email to various users at the same time.', MAILUSERS_I18N_DOMAIN); ?></td>
		<td><?php _e('Administrators, editors and authors.', MAILUSERS_I18N_DOMAIN); ?></td>
	</tr>
	<tr>
		<td><b><?php echo MAILUSERS_NOTIFY_USERS_CAP; ?></b></td>
		<td><?php _e('Notify users of new posts.', MAILUSERS_I18N_DOMAIN); ?></td>
		<td><?php _e('Administrators and editors.', MAILUSERS_I18N_DOMAIN); ?></td>
	</tr>
	<tr>
		<td><b><?php echo MAILUSERS_EMAIL_USER_GROUPS_CAP; ?></b></td>
		<td><?php _e('Send an email to user groups.', MAILUSERS_I18N_DOMAIN); ?></td>
		<td><?php _e('Administrators and editors.', MAILUSERS_I18N_DOMAIN); ?></td>
	</tr>
	</tbody>
</table>

<br/>
</div>
