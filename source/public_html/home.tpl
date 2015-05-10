<!-- BEGIN: NORMAL UPLOAD PAGE -->
<template id="normal_upload_page">

Welcome to <# SITE_NAME #>, a free image upload solution. Simply browse, select, and upload!
<br /><br />	
Select an image file to upload - <a href="index.php?url=1">URL Upload</a><br />
Max filesize is set at: <# MAX_FILESIZE #> per image file.
<br /><br />
<form method="post" id="upload_form" enctype="multipart/form-data" action="upload.php">
	<p>
		<input name="userfile[]" type="file" size="50" /> <br />
		<input name="userfile[]" type="file" size="50" /> <br />
		<input name="userfile[]" type="file" size="50" /> <br />
		<input name="userfile[]" type="file" size="50" /> <br />
		<input name="userfile[]" type="file" size="50" /> <br />
		<span id="more_file_inputs"></span> <br />
		<if="$mmhclass->info->is_user == false || $mmhclass->info->is_user == true && $mmhclass->info->user_data['private_gallery'] == false">
			Upload Type: <input type="radio" name="private_upload" value="0" checked="checked" /> Public <input type="radio" name="private_upload" value="1" /> Private <br /><br />
		</endif>
		<input class="button1"  type="button" onclick="javascript:new_file_input();" value="Add More Files" /> <input class="button1"  type="button" value="Start Uploading" onclick="javascript:toggle_lightbox('index.php?act=upload_in_progress', 'progress_bar_lightbox'); javascript:document.forms['upload_form'].submit();" />
	</p>
</form>
<br /><br />
Allowed File Extensions: <# FILE_EXTENSIONS #>

</template>
<!-- END: NORMAL UPLOAD PAGE -->

<!-- BEGIN: URL UPLOAD PAGE -->
<template id="url_upload_page">

Welcome to <# SITE_NAME #>, a free image upload solution. Simply browse, select, and upload!
<br /><br />	
Enter an image file URL to upload - <a href="index.php">Normal Upload</a><br />
Max filesize is set at: <# MAX_FILESIZE #> per image file.
<br /><br />
<form method="post" id="upload_form" enctype="multipart/form-data" action="upload.php?url=1">
	<p>
		<input name="userfile[]" type="text" class="url_upload" size="50" /> <br />
		<input name="userfile[]" type="text" class="url_upload" size="50" /> <br />
		<input name="userfile[]" type="text" class="url_upload" size="50" /> <br />
		<input name="userfile[]" type="text" class="url_upload" size="50" /> <br />
		<input name="userfile[]" type="text" class="url_upload" size="50" /> <br />
		<span id="more_file_inputs"></span> <br />
		<if="$mmhclass->info->is_user == false || $mmhclass->info->is_user == true && $mmhclass->info->user_data['private_gallery'] == false">
			Upload Type: <input type="radio" name="private_upload" value="0" checked="checked" /> Public <input type="radio" name="private_upload" value="1" /> Private <br /><br />
		</endif>
		<input class="button1"  type="button" onclick="javascript:new_file_input('url');" value="Add More Files" /> <input class="button1"  type="button" value="Start Uploading" onclick="javascript:toggle_lightbox('index.php?act=upload_in_progress', 'progress_bar_lightbox'); javascript:document.forms['upload_form'].submit();" />
	</p>
</form>
<br /><br />
Allowed File Extensions: <# FILE_EXTENSIONS #>

</template>
<!-- END: URL UPLOAD PAGE -->

<!-- BEGIN: UPLOADER PROGRESS BAR -->
<template id="upload_in_progress_lightbox">

<script type="text/javascript">
if (document.images) {
	image = new Image(32, 32);
	image.src = "css/images/progress_bar.gif";
}
</script>
<table cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th>Uploading</th>
	</tr>
	<tr>
		<td class="tdrow1" style="text-align:center;">Upload in progress...
		<br /><br />
		<img src="css/images/progress_bar.gif" alt="Upload in progress..." title="Upload in progress..." />
		<br /><br />
		Your images are in the progress of being uploaded.</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="javascript:toggle_lightbox('no_url', 'progress_bar_lightbox');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: UPLOADER PROGRESS BAR -->
