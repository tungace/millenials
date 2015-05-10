<!-- BEGIN: USER REGISTRATION LIGHTBOX -->
<template id="registration_lightbox">

<form action="users.php?act=register-d" method="post">
	<input type="hidden" name="return" value="<# RETURN_URL #>" />
	<table cellpadding="4" cellspacing="1" border="0" width="100%">
		<tr>
			<th colspan="2">Register at <# SITE_NAME #></th>
		</tr>
		<tr>
			<td style="width: 55%;" class="tdrow1"><span>Username: </span> <br /> <div class="explain">Must be between 3 and 30 characters in length and only contain the characters: -_A-Za-z0-9</div></td> 
			<td class="tdrow2" valign="top"><input type="text" name="username" class="input_field" style="width: 200px;" /></td>
		</tr>
		<tr>
			<td style="width: 55%;" class="tdrow1"><span>Password: </span> <br /> <div class="explain">Must be between 6 and 30 characters in length. For more security we recommend that the password entered contains at least one numerical character.</div></td> 
			<td class="tdrow2" valign="top"><input type="password" name="password" class="input_field" style="width: 200px;" /></td>
		</tr>
		<tr>
			<td style="width: 55%;" class="tdrow1"><span>Password (confirm): </span> </td> 
			<td class="tdrow2"><input type="password" name="password-c" class="input_field" style="width: 200px;" /></td>
		</tr>
		<tr>
			<td style="width: 55%;" class="tdrow1"><span>E-Mail Address: </span> <br /> <div class="explain">To be considered valid an email address can only contain the characters: -_A-Za-z0-9</div></td> 
			<td class="tdrow2" valign="top"><input type="text" class="input_field" name="email_address" style="width: 200px;" /></td>
		</tr>
		<tr>
			<td class="tdrow2" colspan="2"><center><input type="checkbox" name="iagree" value="1" /> By clicking "Register" I understand the <a href="info.php?act=privacy_policy">Privacy Policy</a> and <a href="info.php?act=rules">Terms of Service</a>. <br /><br /> <input type="submit" value="Finish Registration" class="button1" /></center></td>
		</tr>
		<tr>
			<td colspan="2" class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
		</tr>
	</table>
</form>

</template>
<!-- END: USER REGISTRATION LIGHTBOX -->

<!-- BEGIN: USER LOGIN LIGHTBOX -->
<template id="login_lightbox">

<form action="users.php?act=login-d" method="post">
	<input type="hidden" name="return" value="<# RETURN_URL #>" />
	<table style="margin: 1px;" cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<th colspan="2">Please enter your username and password to log in.</th>
		</tr>
		<tr class="tdrow1">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr class="tdrow1">
			<td style="width: 45;%" align="right"><span>Username</span>:</td> 
			<td>&nbsp;<input type="text" class="input_field" name="username" style="width: 200px;" /></td>
		</tr>
		<tr class="tdrow1">
			<td style="width: 45%;" align="right"><span>Password</span>:</td> 
			<td>&nbsp;<input type="password" name="password" class="input_field" style="width: 200px;" /></td>
		</tr>
		<tr class="tdrow1">
			<td colspan="2" align="center"><br /><input type="submit" value="Log In" class="button1" /></td>
		</tr>
		<tr class="tdrow1">
			<td align="center" colspan="2" style="font-size: 10px;"><br /><a href="javascript:void(0);" onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>'); javascript:toggle_lightbox('users.php?act=lost_password', 'lost_password_lightbox');">I Forgot My Password</a></td>
		</tr>
		<tr class="tdrow1">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
		</tr>
	</table>
</form>

</template>
<!-- END: USER LOGIN LIGHTBOX -->

<!-- BEGIN: FORGOTTEN PASSWORD LIGHTBOX -->
<template id="forgotten_password_lightbox">

<form action="users.php?act=lost_password-d" method="post">
	<table style="margin: 1px;" cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<th colspan="2">Send me a new password</th>
		</tr>
		<tr class="tdrow1">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr class="tdrow1">
			<td style="width: 45%;" align="right"><span>Username</span>:</td> 
			<td>&nbsp;<input type="text" class="input_field" name="username" style="width: 200px;" /></td>
		</tr>
		<tr class="tdrow1">
			<td style="width: 45%;" align="right"><span>E-Mail Address</span>:</td> 
			<td>&nbsp;<input type="text" name="email_address" class="input_field" style="width: 200px;" /></td>
		</tr>
		<tr class="tdrow1">
			<td colspan="2" align="center"><br /><input type="submit" value="Send Password" class="button1" /></td>
		</tr>
		<tr class="tdrow1">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
		</tr>
	</table>
</form>

</template>
<!-- END: FORGOTTEN PASSWORD LIGHTBOX -->

<!-- BEGIN: FORGOTTEN PASSWORD EMAIL -->
<template id="forgotten_password_email">
Hello <# USERNAME #>,

You are receiving this email because you have (or someone pretending to be you has) requested a new password be sent for your account on <# SITE_SITE #>. If you did not request this email then please ignore it, if you keep receiving it please contact the site administrator.

To use the new password you need to activate it. To do this click the link provided below.

<# BASE_URL #>users.php?act=lost_password-a&id=<# AUTH_KEY #>

If successful you will be able to log in using the following password:

Password: <# NEW_PASSWORD #>

You can of course change this password yourself via the settings page. If you have any difficulties please contact the site administrator.
</template>
<!-- END FORGOTTEN PASSWORD EMAIL -->

<!-- BEGIN: USER LIST PAGE -->
<template id="user_list_page">

<# PAGINATION_LINKS #>
<br /><br />
<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" width="100%">
		<tr>
			<th>Username</th>
			<th>Date Joined</th>
			<th>Gallery Status</th>
			<th>Total Uploads</th>
			<th>&nbsp;</th>
		</tr>
		<while id="user_list_whileloop">
			<tr>
				<td class="<# TDCLASS #>"><a href="users.php?act=gallery&amp;gal=<# USER_ID #>"><# USERNAME #></a></td>
				<td class="<# TDCLASS #>"><# TIME_JOINED #></td>
				<td class="<# TDCLASS #>"><# GALLERY_STATUS #></td>
				<td class="<# TDCLASS #>"><# TOTAL_UPLOADS #></td>
				<td class="<# TDCLASS #>"><a href="users.php?act=gallery&amp;gal=<# USER_ID #>">View Gallery</a></td>
			</tr>
		</endwhile>
		<tr>
			<td colspan="5" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- END: USER LIST PAGE -->

<!-- BEGIN: MY GALLERY PAGE -->
<template id="my_gallery_page">

<script type="text/javascript">
if (navigator.userAgent.toLowerCase().indexOf("msie") != -1 && navigator.userAgent.toLowerCase().indexOf("opera") == -1 && parseInt(navigator.appVersion) < 7 && get_cookie("in_explorer_uphpg") == false) {
	set_cookie("in_explorer_uphpg", "true", 365);
	alert("Hmm... your browser is not officialy supported.\n\nWe recommened you download a supported browser (e.g. Firefox, Opera, or Safari) or some parts of this page may not function as they should.\n\nContinue at your own risk.");
}
</script>

<div class="align_left">
	<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['gal']) == true">
		<a onclick="javascript:gallery_action('delete');" class="button1">Delete Selected</a>
		<a onclick="javascript:gallery_action('move');" class="button1">Move Selected</a>
		<a onclick="javascript:gallery_action('select');" title="Select/Deselect All" class="button1">Select All</a> 
	</endif>
	<div class="pulldown_menu" onmouseover="javascript:position_pulldown(this, 'user_albums_menu');">
		<span class="button1"><# GALLERY_OWNER #>'s Albums</span>
		<ul id="user_albums_menu">
			<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['gal']) == true">
				<li class="header">Actions</li>
				<li><a href="javascript:void(0);" onclick="javascript:toggle_lightbox('users.php?act=albums-c&amp;return=<# RETURN_URL #>', 'new_album_lightbox');">New Album</a></li>
			</endif>
			<li class="header">Albums</li>
			<li><a href="<# PAGE_URL #>">Root Gallery</a> (<# TOTAL_ROOT_UPLOADS #> of <# TOTAL_UPLOADS #>)</li>
			<while id="album_pulldown_link_whileloop">
				<li> 
					- <a href="<# PAGE_URL #>&amp;cat=<# ALBUM_ID #>"><# ALBUM_NAME #></a> (<# TOTAL_UPLOADS #>) 
					<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['gal']) == true">
						( <a href="javascript:void(0);" onclick="javascript:toggle_lightbox('users.php?act=albums-d&amp;album=<# ALBUM_ID #>&amp;return=<# RETURN_URL #>', 'delete_album_lightbox');">Delete</a> |
						<a href="javascript:void(0);" onclick="javascript:toggle_lightbox('users.php?act=albums-r&amp;album=<# ALBUM_ID #>&amp;return=<# RETURN_URL #>', 'rename_album_lightbox');">Rename</a> )
					</endif>
				</li>
			</endwhile>
		</ul>
	</div>
</div>

<# PAGINATION_LINKS #>
<br /><br />
<if="$mmhclass->templ->templ_globals['empty_gallery'] == true">
	<# EMPTY_GALLERY #>
<else>
	<form name="user_gallery" action="<# PAGE_URL #>">
		<div class="table_border">
			<table cellpadding="4" cellspacing="1" border="0" width="100%">
				<tr>
					<th colspan="4"><# GALLERY_OWNER #>'s Public Gallery</th>
				</tr>
				<tr>
					<# GALLERY_HTML #>
				</tr>
				<tr>
					<td colspan="4" class="table_footer">&nbsp;</td>
				</tr>
			</table>
		</div>
	</form>
</endif>

</template>
<!-- END: MY GALLERY PAGE -->

<!-- BEGIN: MOVE FILES LIGHTBOX -->
<template id="move_files_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Move Images</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="users.php?act=move_files-d" method="post">
				<p>
					<b>Move To:</b>
					<br /><br />
					<select name="move_to" style="width: 200px; ">
						<option value="0">Root Gallery</option>
						<while id="album_options_whileloop">
							<option value="<# ALBUM_ID #>">- <# ALBUM_NAME #></option>
						</endwhile>
					</select>
					<br /><br />
					<input type="hidden" value="<# FILES_TO_MOVE #>" name="files" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="submit" value="Finish Move" class="button1" />
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: MOVE FILES LIGHTBOX -->

<!-- BEGIN: DELETE FILES LIGHTBOX -->
<template id="delete_files_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Confirm Image Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="users.php?act=delete_files-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
					<input type="hidden" value="<# FILES_TO_DELETE #>" name="files" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="submit" value="Yes" class="button1" />
					<input type="button" onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" value="No" class="button1" />
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: DELETE FILES LIGHTBOX -->

<!-- BEGIN: NEW ALBUM LIGHTBOX -->
<template id="new_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>New Album</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="users.php?act=albums-c-d" method="post">
				<p>
					<b>Album Title</b>:
					<br /><br />
					<input type="text" name="album_title" maxlength="50" class="input_field" style="width: 250px;" />
					<br /><br />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="submit" value="Create Album" class="button1" />
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: NEW ALBUM LIGHTBOX -->

<!-- BEGIN: RENAME ALBUM LIGHTBOX -->
<template id="rename_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Rename Album</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="users.php?act=albums-r-d" method="post">
				<p>
					<b>New Album Title</b>:
					<br /><br />
					<input type="text" name="album_title" maxlength="50" class="input_field" style="width: 250px;" />
					<br /><br />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="hidden" value="<# ALBUM_ID #>" name="album" />
					<input type="submit" value="Update Album" class="button1" />
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: RENAME ALBUM LIGHTBOX -->

<!-- BEGIN: DELETE ALBUM LIGHTBOX -->
<template id="delete_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Confirm Album Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="users.php?act=albums-d-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
					<input type="hidden" value="<# ALBUM_TO_DELETE #>" name="album" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="submit" value="Yes" class="button1" />
					<input type="button" onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" value="No" class="button1" />
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: DELETE ALBUM LIGHTBOX -->

<!-- BEGIN: USER SETTINGS PAGE -->
<template id="user_settings_page">

<form action="users.php?act=settings-s" method="post">
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" width="100%">
			<tr>
				<th colspan="2">User Settings</th>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>User ID</span>:</td>
				<td class="tdrow2"><# USER_ID #></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>Username</span>:</td>
				<td class="tdrow2"><# USERNAME #></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>Password</span>: <br /> <div class="explain">Leave blank to unchange. If changing, must be between 6 and 30 characters in length. For more security we recommend that the password entered contains at least one numerical character.</div></td>
				<td class="tdrow2" valign="top"><input type="password" value="" style="width: 300px;" class="input_field" name="password" /></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>IP Address</span>:</td>
				<td class="tdrow2"><# IP_ADDRESS #></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>E-Mail Address</span>: <br /> <div class="explain">To be considered valid an email address can only contain the characters: -_A-Za-z0-9</div></td>
				<td class="tdrow2" valign="top"><input type="text" style="width: 300px;" name="email_address" class="input_field" value="<# EMAIL_ADDRESS #>" /></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%"><span>Private Gallery</span>:</td>
				<td class="tdrow2"><input type="radio" name="private_gallery" value="1" <# PRIVATE_GALLERY_YES #> /> Yes <input type="radio" name="private_gallery" value="0" <# PRIVATE_GALLERY_NO #> /> No</td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>Time Joined</span>:</td>
				<td class="tdrow2"><# TIME_JOINED #></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>User Group</span>:</td>
				<td class="tdrow2"><# USER_GROUP #></td>
			</tr>
			<tr>
				<td class="table_footer" colspan="2"><input type="submit" value="Save Settings" class="button1" /></td>
			</tr>
		</table>
	</div>
</form> 

</template>
<!-- END: USER SETTINGS PAGE -->
