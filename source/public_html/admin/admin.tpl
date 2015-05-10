<!-- // -- |ACPT-BE| -- //  -->
<template id="mass_email_page">

<form action="admin.php?act=mass_email-s" method="post">	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" width="100%">
			<tr>
				<th colspan="2">Bulk E-Mail Members</th>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1"><span>E-Mail Subject:</span></td> 
				<td valign="top" class="tdrow2"><input type="text" name="email_subject" style="width: 300px;" class="input_field" /></td>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Message:</span> <br /> <div class="explain">This message will be sent as plain text, so do not include any HTML.</div></td> 
				<td class="tdrow2"><textarea rows="25" cols="80" class="input_field" name="message_body"></textarea></td>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Security Image:</span> <br /> <div class="explain">Enter the text from the image on the right into the input box below it.</div></td> 
				<td valign="top" class="tdrow2"><img class="thumbnail" src="index.php?module=captcha&amp;sid=<# CAPTCHA_ID #>" alt="Security Image" /> <br /><br /> <input type="text" name="captcha_code" style="width: 300px;" class="input_field" /></td>
			</tr>
			<tr>
				<td class="table_footer" colspan="2"><input class="button1" type="submit" value="Send Message" /></td>
			</tr>
		</table>
	</div>
</form>

</template>
<!-- // -- |ACPT-BE| -- //  -->
<template id="mass_email_email">
The following is an email sent to you by an administrator of <# SITE_NAME #>. If this message is spam, contains abusive or other comments you find offensive please contact the webmaster of the site at the following address:

<# WEBMASTER_EMAIL #>

Include this full email (particularly the headers). 

Message sent to you follows:

----------------------------------

<# EMAIL_BODY #>
</template>
<!-- // -- |ACPT-BE| -- //  -->
<template id="ban_control_page">

<form action="admin.php?act=ban_control-u" method="post">
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" width="100%">
			<tr>
				<th colspan="2">Manage Banned Users</th>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Ban Username: </span> <br /> <div class="explain">In order to ban an username it must already exist and not be an administrator.</div></td>
				<td class="tdrow2" valign="top"><input type="text" name="banned[username]" class="input_field" style="width: 300px;" /><br /><input type="checkbox" name="delete_files[username]" value="1"> Delete ALL images uploaded by this username?</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1" valign="top"><span>Unban Username: </span> <br /> <div class="explain">Select one or more usernames from the list on the right to unban 'em.</div></td> 
				<td class="tdrow2" valign="top">
					<select multiple="multiple" name="unban[username][]" style="width: 300px; height: 150px;">
						<# BANNED_USER_LIST #>
					</select>
				</td>
			</tr>
			<tr>
				<th colspan="2">Manage Banned IP Addresses</th>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Ban IP Address: </span> <br /> <div class="explain">In order to ban an IP address it must be a valid IP address (e.g. 123.321.123.321).</div></td> 
				<td class="tdrow2" valign="top"><input type="text" name="banned[ip_address]" class="input_field" style="width: 300px;" /><br /><input type="checkbox" name="delete_files[ip_address]" value="1"> Delete ALL images uploaded by this IP address?</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1" valign="top"><span>Unban IP Address: </span> <br /> <div class="explain">Select one or more IP addresses from the list on the right to unban 'em.</div></td> 
				<td class="tdrow2" valign="top">
					<select multiple="multiple" name="unban[ip_address][]" style="width: 300px; height: 150px;">
						<# BANNED_IP_LIST #>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="table_footer"><input type="submit" value="Update Ban Filter" class="button1" /></td>
			</tr>
		</table>
		</div>
</form>

</template>
<!-- // -- |ACPT-BE| -- //  -->
<template id="delete_user_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Confirm Account Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="admin.php?act=users-d-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
					<b>Note</b>: Deleting a user will also delete any images that user uploaded.
					<br /><br >
					<input type="hidden" value="<# USER_TO_DELETE #>" name="user_id" />
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
<!-- // -- |ACPT-BE| -- //  -->
<template id="user_settings_page">

<form action="admin.php?act=users-s-s" method="post">
	<input type="hidden" name="user_id" value="<# USER_ID #>">
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
				<td class="tdrow1" style="width: 38%;"><span>Private Gallery</span>:</td>
				<td class="tdrow2"><input type="radio" name="private_gallery" value="1" <# PRIVATE_GALLERY_YES #> /> Yes <input type="radio" name="private_gallery" value="0" <# PRIVATE_GALLERY_NO #> /> No</td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>Time Joined</span>:</td>
				<td class="tdrow2"><# TIME_JOINED #></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>User Group</span>:</td>
				<td class="tdrow2">
					<if="$mmhclass->templ->templ_globals['user_data']['user_group'] == 'root_admin'">
						Root Administrator (Root administrator account is not allowed to be changed.)
					<else>
						<select name="user_group" style="width: 300px; ">
							<option value="1">Normal User</option>
							<option value="2" <# ADMIN_USER_GROUP #>>Administrator</option>
						</select>
					</endif>
				</td>
			</tr>
			<tr>
				<td class="table_footer" colspan="2"><input type="submit" value="Save Settings" class="button1" /></td>
			</tr>
		</table>
	</div>
</form> 

</template>
<!-- // -- |ACPT-BE| -- //  -->
<template id="robot_logs_page">

<div class="align_left">
	<a href="admin.php?act=robot_logs-de" class="button1">Empty Logs</a>
</div>
<# PAGINATION_LINKS #>
<br /><br />
<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" width="100%">
		<tr>
			<th>#</th>
			<th>Robot</th>
			<th>Date Indexed</th>
			<th>Page Indexed</th>
			<th>Referring Page</th>
		</tr>
		<while id="robot_logs_whileloop">
			<tr>				
				<td class="<# TDCLASS #>"><# LOG_ID #></td>			
				<td class="<# TDCLASS #>"><# ROBOT_NAME #></td>
				<td class="<# TDCLASS #>"><# DATE_INDEXED #></td>
				<td class="<# TDCLASS #>"><# PAGE_INDEXED #></td>
				<td class="<# TDCLASS #>"><# HTTP_REFERER #></td>
			</tr>
		</endwhile>
		<tr>
			<td colspan="5" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- // -- |ACPT-BE| -- //  -->
<template id="file_logs_page">

<# PAGINATION_LINKS #>
<br /><br />
<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" width="100%">
		<tr>
			<th>#</th>
			<th>Filename</th>
			<th>Status</th>
			<th>Filesie</th>
			<th>IP Address</th>
			<th>Date Uploaded</th>
			<th>Uploaded By</th>
		</tr>
		<while id="file_logs_whileloop">
			<tr>				
				<td class="<# TDCLASS #>"><# LOG_ID #></td>			
				<td class="<# TDCLASS #>"><a href="viewer.php?file=<# FILENAME #>"><# FILENAME #></a></td>
				<td class="<# TDCLASS #>"><# FILE_STATUS #></td>
				<td class="<# TDCLASS #>"><# FILESIZE #></td>
				<td class="<# TDCLASS #>"><# IP_ADDRESS #></td>
				<td class="<# TDCLASS #>"><# TIME_UPLOADED #></td>
				<td class="<# TDCLASS #>"><# UPLOADED_BY #></td>
			</tr>
		</endwhile>
		<tr>
			<td colspan="7" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- // -- |ACPT-BE| -- //  -->
<template id="admin_gallery_page">

<div class="align_left">
	<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['gal']) == true">
		<a href="admin.php?act=user_list" class="button1">User Galleries</a>
		<a href="admin.php?act=site_settings" class="button1">Site Configuration</a>
	</endif>
	<a onclick="javascript:gallery_action('delete', '<# GALLERY_ID #>');" class="button1">Delete Selected</a>
	<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['gal']) == false">
		<a onclick="javascript:gallery_action('move', '<# GALLERY_ID #>');" class="button1">Move Selected</a>
	</endif>
	<a onclick="javascript:gallery_action('select');" title="Select/Deselect All" class="button1">Select All</a> 
	<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['gal']) == false">
		<div class="pulldown_menu" onmouseover="javascript:position_pulldown(this, 'user_albums_menu');">
			<span class="button1"><# GALLERY_OWNER #>'s Albums</span>
			<ul id="user_albums_menu">
				<li class="header">Actions</li>
				<li><a href="javascript:void(0);" onclick="javascript:toggle_lightbox('users.php?act=albums-c&amp;return=<# RETURN_URL #>&amp;gal=<# GALLERY_ID #>', 'new_album_lightbox');">New Album</a></li>
				<li class="header">Albums</li>
				<li><a href="<# PAGE_URL #>">Root Gallery</a> (<# TOTAL_ROOT_UPLOADS #> of <# TOTAL_UPLOADS #>)</li>
				<while id="album_pulldown_link_whileloop">
					<li> 
						- <a href="<# PAGE_URL #>&amp;cat=<# ALBUM_ID #>"><# ALBUM_NAME #></a> (<# TOTAL_UPLOADS #>) 
						( <a href="javascript:void(0);" onclick="javascript:toggle_lightbox('users.php?act=albums-d&amp;album=<# ALBUM_ID #>&amp;return=<# RETURN_URL #>&amp;gal=<# GALLERY_ID #>', 'delete_album_lightbox');">Delete</a> |
						<a href="javascript:void(0);" onclick="javascript:toggle_lightbox('users.php?act=albums-r&amp;album=<# ALBUM_ID #>&amp;return=<# RETURN_URL #>&amp;gal=<# GALLERY_ID #>', 'rename_album_lightbox');">Rename</a> )
					</li>
				</endwhile>
			</ul>
		</div>
	</endif>
</div>

<# PAGINATION_LINKS #>
<br /><br />
<if="$mmhclass->templ->templ_globals['empty_gallery'] == true">
	<# EMPTY_GALLERY #>
<else>
	<form method="post" id="admin_gallery" action="#" onsubmit="javascript:void(0);">
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
<!-- // -- |ACPT-BE| -- //  -->
<template id="move_files_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Move Images</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="admin.php?act=move_files-d" method="post">
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
					<input type="hidden" value="<# GALLERY_ID #>" name="gallery" />
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
<!-- // -- |ACPT-BE| -- //  -->
<template id="delete_files_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Confirm Image Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="admin.php?act=delete_files-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
					<input type="hidden" value="<# FILES_TO_DELETE #>" name="files" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="hidden" value="<# GALLERY_ID #>" name="gallery" />
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
<!-- // -- |ACPT-BE| -- //  -->
<template id="new_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>New Album</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="admin.php?act=albums-c-d" method="post">
				<p>
					<b>Album Title</b>:
					<br /><br />
					<input type="text" name="album_title" maxlength="50" class="input_field" style="width: 250px;" />
					<br /><br />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="hidden" value="<# GALLERY_ID #>" name="gallery" />
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
<!-- // -- |ACPT-BE| -- //  -->
<template id="rename_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Rename Album</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="admin.php?act=albums-r-d" method="post">
				<p>
					<b>New Album Title</b>:
					<br /><br />
					<input type="text" name="album_title" maxlength="50" class="input_field" style="width: 250px;" />
					<br /><br />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="hidden" value="<# ALBUM_ID #>" name="album" />
					<input type="hidden" value="<# GALLERY_ID #>" name="gallery" />
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
<!-- // -- |ACPT-BE| -- //  -->
<template id="delete_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Confirm Album Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align: center;">
			<br />
			<form action="admin.php?act=albums-d-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
					<input type="hidden" value="<# ALBUM_TO_DELETE #>" name="album" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="hidden" value="<# GALLERY_ID #>" name="gallery" />
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
<!-- // -- |ACPT-BE| -- //  -->
<template id="user_list_page">

<# PAGINATION_LINKS #>
<br /><br />
<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" width="100%">
		<tr>
			<th>#</th>
			<th>Username</th>
			<th>IP Address</th>
			<th>E-Mail Address</th>
			<th>Date Joined</th>
			<th>Gallery Status</th>
			<th>Total Uploads</th>
			<th>&nbsp;</th>
		</tr>
		<while id="user_list_whileloop">
			<tr>				
				<td class="<# TDCLASS #>"><# USER_ID #></td>			
				<td class="<# TDCLASS #>"><a href="admin.php?gal=<# USER_ID #>"><# USERNAME #></a></td>
				<td class="<# TDCLASS #>"><# IP_ADDRESS #></td>
				<td class="<# TDCLASS #>"><# EMAIL_ADDRESS #></td>
				<td class="<# TDCLASS #>"><# TIME_JOINED #></td>
				<td class="<# TDCLASS #>"><# GALLERY_STATUS #></td>
				<td class="<# TDCLASS #>"><# TOTAL_UPLOADS #></td>
				<td class="<# TDCLASS #>"><a href="javascript:toggle_lightbox('admin.php?act=users-d&amp;id=<# USER_ID #>&amp;return=<# RETURN_URL #>', 'delete_user_lightbox');">Delete</a> | <a href="admin.php?act=users-s&amp;id=<# USER_ID #>">Settings</a></td>
			</tr>
		</endwhile>
		<tr>
			<td colspan="8" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- // -- |ACPT-BE| -- //  -->
<template id="site_settings_page">

<form action="admin.php?act=site_settings-s" method="post">
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" width="100%">
			<tr>
				<th colspan="2">Site Settings</th>
			</tr>
			<tr>
				<td class="tdrow2" colspan="2">
					<# DISK_USED_SPACE #> of <# DISK_TOTAL_SPACE #> disk space used.
				</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Website Name:</span> </td> 
				<td class="tdrow2"><input type="text" style="width: 300px;" class="input_field" name="site_name" value="<# SITE_NAME #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Allowed File Extensions:</span> <br /> <div class="explain">File extension allowed to be uploaded by guests. Seperate with commas, but don't use dots, 'and', or spaces.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="file_extensions" value="<# FILE_EXTENSIONS #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Allowed File Extensions (Users):</span> <br /> <div class="explain">File extension allowed to be uploaded by registered users. Seperate with commas, but don't use dots, 'and', or spaces.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="user_file_extensions" value="<# USER_FILE_EXTENSIONS #>" / ></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Max Filesize:</span> <br /> <div class="explain">The maximum allowed filesize in bytes per file for guests.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="max_filesize" value="<# MAX_FILESIZE #>" /> Bytes</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Max Filesize (Users):</span> <br /> <div class="explain">The maximum allowed filesize in bytes per file for registered users.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="user_max_filesize" value="<# USER_MAX_FILESIZE #>" /> Bytes</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Incoming 'n Outgoing E-Mail Address:</span> <br /> <div class="explain">This is the email address that all emails will be sent from and to. To be considered valid an email address can only contain the characters: -_A-Za-z0-9</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="email_out" value="<# EMAIL_OUT #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Public Gallery Viewing:</span> <br /> <div class="explain">Set this setting to 'No' to disable the ability of anyone except administrators to view the public gallery of this website. This setting does not apply to user galleries because users control their own privacy settings.</div></td> 
				<td class="tdrow2" valign="top"><input type="radio" value="1" name="gallery_viewing" <# GALLERY_VIEWING_YES #> /> Yes <input type="radio" value="0" name="gallery_viewing" <# GALLERY_VIEWING_NO #> /> No</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Date Format:</span> <br /> <div class="explain">For information on how to setup the date format go to <a href="http://www.php.net/date" target="_blank">php.net</a>.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="date_format" value="<# DATE_FORMAT #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Max Results:</span> <br /> <div class="explain">Max number of whatever to display on a single page.</div></td> 
				<td class="tdrow2" valign="top">
					<select name="max_results" style="width: 300px;">
						<while id="max_results_forloop">
							<option value="<# MAX_RESULTS_SUM #>" <# MAX_RESULTS_SELECTED #>><# MAX_RESULTS_SUM #></option>
						</endwhile>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Thumbnail Height:</span> <br /> <div class="explain">Maximum height of a generated thumbnail.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="thumbnail_height" value="<# THUMBNAIL_HEIGHT #>" /> Pixels</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Thumbnail Width:</span> <br /> <div class="explain">Maximum width of a generated thumbnail.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="thumbnail_width" value="<# THUMBNAIL_WIDTH #>" /> Pixels</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Advanced Thumbnails:</span> <br /> <div class="explain">For an example of advanced thumbnails click <a href="css/images/adv_thumb_ex.jpg">here</a>. The Imagick Image Library is required to generate advanced thumbnails. If this value is ever changed, only the thumbnails generated after the change took place would be effected.</div></td> 
				<td class="tdrow2" valign="top"><input type="radio" value="1" name="advanced_thumbnails" <# ADVANCED_THUMBNAILS_YES #> /> Yes <input type="radio" value="0" name="advanced_thumbnails" <# ADVANCED_THUMBNAILS_NO #> /> No</td>
			</tr>
			<tr>
				<td class="table_footer" colspan="2"><input type="submit" class="button1" value="Save Settings" /></td>
			</tr>
		</table>
	</div>
</form>

</template>
<!-- // -- |ACPT-BE| -- //  -->
