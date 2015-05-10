<!-- BEGIN: GLOBAL GALLERY LAYOUT -->
<template id="global_gallery_layout">

<# TABLE_BREAK #>
<td class="<# TDCLASS #>" valign="top" style="text-align:center; ;">
	<if="$mmhclass->templ->templ_globals['file_options'] == true">
		<input type="checkbox" name="userfile[]" value="<# FILENAME #>" />
	</endif>
	<b><# FILE_TITLE #></b>
	<br /><br />
	<a href="viewer.php?file=<# FILENAME #>"><img src="index.php?module=thumbnail&amp;file=<# FILENAME #>" alt="<# FILENAME #>" class="thumbnail" /></a>
	<br /><br />
	<a href="download.php?file=<# FILENAME #>"><b>Download Image</b></a> | <a href="javascript:void(0);" onclick="toggle_lightbox('index.php?module=fileinfo&amp;file=<# FILENAME #>', 'file_info_lightbox');"><b>More Info</b></a>
</td>

</template>
<!-- END: GLOBAL GALLERY LAYOUT -->
