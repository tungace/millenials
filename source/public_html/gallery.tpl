<!-- BEGIN: PUBLIC GALLERY PAGE -->

<div class="align_left">
	<a href="users.php?act=user_list" class="button1">User Galleries</a>
</div>
<# PAGINATION_LINKS #>
<br /><br />
<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" width="100%">
		<tr>
			<th colspan="4"><# SITE_NAME #>'s Public Gallery</th>
		</tr>
		<tr>
			<td class="tdrow1" colspan="4" align="center">
			The images shown below are images that were uploaded by Guests. For
			a list of user galleries click the "User Galleries" button shown above.</td>
		</tr>
		<tr>
			<# GALLERY_HTML #>
		</tr>
		<tr>
			<td colspan="4" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

<!-- END: PUBLIC GALLERY PAGE -->
