<!-- BEGIN: MAIN VIEWER PAGE -->

<if="$mmhclass->templ->templ_globals['new_file_rating'] == true">
	<# NEW_RATING_HTML #>
	<hr />
</endif>
<div style="text-align: center;">
	<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['is_random']) == false">
		<a href="index.php?do_random=1" class="button1">Refresh Random Image</a>
		<br /><br />
	</endif>
	
	<a href="<# UPLOAD_PATH #><# FILENAME #>"><img src="<# UPLOAD_PATH #><# FILENAME #>" alt="<# FILENAME #>" style="border: 1px dashed #000000; padding: 2px; max-width: 940px;" /></a>

	<if="$mmhclass->templ->templ_globals['file_info']['width'] > 940">
		<br /><br />
		<b>Resize</b>: The above image has been resized to better fit your screen. To view its true size, click the above image.
	</endif>
</div>
<br /><hr />
<a href="download.php?file=<# FILENAME #>" class="button1">Download Image</a> 
<a href="contact.php?act=file_report&amp;file=<# FILENAME #>" class="button1">Report Image</a> 
<a onclick="javascript:toggle('file_rating_block');" class="button1">Rate Image</a>
<a href="links.php?file=<# FILENAME #>" class="button1">Image Links</a>
<br /><br />
<div id="file_rating_block" style="display: none;">
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" width="100%">
			<tr>
				<th colspan="2">File Rating</th>
			</tr>
			<tr class="tdrow1">
				<td style="width: 44%;">&nbsp;</td>
				<td align="left" style="padding: 5px;">
					Rate This Image: 
					<br /><br />
					<form action="viewer.php?act=rate_it&amp;file=<# FILENAME #>" method="post">
						<p>
							<input type="radio" checked="checked" name="rating_id" value="5" /> <img src="css/images/ratings/22222.gif" alt="" /> Excellent!<br />
							<input type="radio" name="rating_id" value="4" /> <img src="css/images/ratings/22220.gif" alt="" /> Very Good<br />
							<input type="radio" name="rating_id" value="3" /> <img src="css/images/ratings/22200.gif" alt="" /> Good<br />
							<input type="radio" name="rating_id" value="2" /> <img src="css/images/ratings/22000.gif" alt="" /> Fair<br />
							<input type="radio" name="rating_id" value="1" /> <img src="css/images/ratings/20000.gif" alt="" /> Poor
							<br /><br />
							<input type="submit" class="button1" value="Rate It!" />
						</p>
					</form>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="table_footer">&nbsp;</td>
			</tr>
		</table>
	</div>
	<br /><hr />
</div>
<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" width="100%">
		<tr>
			<th colspan="2">Image Info</th>
		</tr>
		<tr>
			<td style="width: 44%" class="tdrow1"><b>Filename:</b></td>
			<td class="tdrow2"><a href="<# UPLOAD_PATH #><# FILENAME #>"><# FILENAME #></a></td>
		</tr>
		<tr>
			<td style="width: 44%" class="tdrow1"><b>Dimensions:</b></td>
			<td class="tdrow2"><# IMAGE_WIDTH #> x <# IMAGE_HEIGHT #> Pixels (Width x Height)</td>
		</tr>
		<tr>
			<td style="width: 44%" class="tdrow1"><b>Extension:</b></td>
			<td class="tdrow2">.<# FILE_EXTENSION #></td>
		</tr>
		
		<if="$mmhclass->funcs->is_null($mmhclass->templ->templ_globals['file_info']['comment']) == true">
			<tr>
				<td style="width: 44%" class="tdrow1"><b>Mime Type:</b></td>
				<td class="tdrow2"><# MIME_TYPE #></td>
			</tr>
		<else>
			<tr>
				<td style="width: 44%" class="tdrow1"><b>Image Comment:</b></td>
				<td class="tdrow2"><# HIDDEN_COMMENT #></td>
			</tr>
		</endif>
		
		<tr>
			<td style="width: 44%" class="tdrow1"><b>Date Uploaded:</b></td>
			<td class="tdrow2"><# DATE_UPLOADED #></td>
		</tr>
		<tr>
			<td style="width: 44%" class="tdrow1"><b>Filesize:</b></td>
			<td class="tdrow2"><# TOTAL_FILESIZE #></td>
		</tr>
		<tr>
			<td style="width: 44%" class="tdrow1"><b>Rating:</b></td>
			<td class="tdrow2"><img style="vertical-align:middle;" src="index.php?module=rating&amp;file=<# FILENAME #>" alt="File Rating" /> ( <# TOTAL_RATINGS #> Vote(s) )</td>
		</tr>
		<tr>
			<td colspan="2" class="tdrow2"><# FILE_LINKS #></td>
		</tr>
		<tr>
			<td colspan="2" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

<!-- END: MAIN VIEWER PAGE -->
