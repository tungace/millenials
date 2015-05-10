<!-- BEGIN: FILE RESULTS TABLE -->

<if="$mmhclass->image->manipulator == "gd" && is_file($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$mmhclass->image->thumbnail_name("<# FILENAME #>")) == false && preg_match("/links|viewer/", $mmhclass->input->server_vars['php_self']) == false && $mmhclass->templ->templ_globals['extension'] != "bmp" && $mmhclass->templ->templ_globals['extension'] != "ico"">
	<div style="text-align: center;">
		<b>Notice</b>: Failed to generate thumbnail for image file <b><# FILENAME #></b> because of an internal error. 
		<br /><br />
	</div>
</endif>

<if="preg_match("/viewer/", $mmhclass->input->server_vars['php_self']) == false">
	<div style="text-align: center;">
		<a href="viewer.php?file=<# FILENAME #>" class="button1">View Full Image</a>
	</div>
	<br />
</endif>

<script type="text/javascript">
if (navigator.userAgent.toLowerCase().indexOf("msie") != -1 && navigator.userAgent.toLowerCase().indexOf("opera") == -1 && parseInt(navigator.appVersion) < 7 && get_cookie("in_explorer_lnkphp") == false) {
	set_cookie("in_explorer_lnkphp", "true", 365);
	alert("Hmm... your browser is not officialy supported.\n\nWe recommened you download a supported browser (e.g. Firefox, Opera, or Safari) or some parts of this page may not function as they should.\n\nContinue at your own risk.");
}
</script>

<table cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<td style="width: 20%;" valign="middle">
			<div style="text-align: center;">
				<a href="<# BASE_URL #>viewer.php?file=<# FILENAME #>"><img src="index.php?module=thumbnail&amp;file=<# FILENAME #>" class="thumbnail" alt="<# FILENAME #>" style="max-height: 125px; " /></a>
			</div>
		</td>
		<td style="width: 80%;">
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="javascript:highlight(this);" type="text" style="width: 605px" name="option" value="<# BASE_URL #><# UPLOAD_PATH #><# FILENAME #>" /></td>
					<td>Direct Link</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="javascript:highlight(this);" type="text" style="width: 605px" name="option" value="&lt;a href=&quot;<# BASE_URL #>viewer.php?file=<# FILENAME #>&quot;&gt;&lt;img src=&quot;<# THUMBNAIL #>&quot; border=&quot;0&quot; alt=&quot;<# FILENAME #>&quot; /&gt;&lt;/a&gt;" /></td>
					<td>Thumbnail for Websites</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="javascript:highlight(this);" type="text" style="width: 605px" name="option" value="[URL=<# BASE_URL #>viewer.php?file=<# FILENAME #>][IMG]<# THUMBNAIL #>[/IMG][/URL]" /></td>
					<td>Thumbnail for forums</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="javascript:highlight(this);" type="text" style="width: 605px" name="option" value="Thanks to <# SITE_NAME #> for &lt;a href=&quot;<# BASE_URL #>&quot;&gt;Free image hosting&lt;/a&gt;" /></td>
					<td>Link to us</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="javascript:highlight(this);" type="text" style="width: 605px" name="option" value="[URL=<# BASE_URL #>][IMG]<# BASE_URL #><# UPLOAD_PATH #><# FILENAME #>[/IMG][/URL]" /></td>
					<td>Hotlink for forums</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="javascript:highlight(this);" type="text" style="width: 605px" name="option" value="&lt;a href=&quot;<# BASE_URL #>&quot;&gt;&lt;img src=&quot;<# BASE_URL #><# UPLOAD_PATH #><# FILENAME #>&quot; border=&quot;0&quot; alt=&quot;<# SITE_NAME #>&quot; /&gt;&lt;/a&gt;" /></td>
					<td>Hotlink for Websites</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<!-- END: FILE RESULTS TABLE -->
