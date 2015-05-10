<!-- BEGIN: CONTACT US PAGE -->
<template id="contact_us_page">

<form action="contact.php?act=contact_us-s" method="post">	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" width="100%">
			<tr>
				<th colspan="2">Contact <# SITE_NAME #></th>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1"><span>E-Mail Address:</span> <br /> <div class="explain">To be considered valid an email address can only contain the characters: -_A-Za-z0-9</div></td> 
				<td valign="top" class="tdrow2"><input type="text" name="email_address" style="width: 300px;" class="input_field" /></td>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Message:</span> <br /> <div class="explain">This message will be sent as plain text, so do not include any HTML.</div></td> 
				<td class="tdrow2"><textarea rows="25" cols="80" class="input_field" name="message_body"></textarea></td>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Security Image:</span> <br /> <div class="explain">Enter the text from the image on the right into the input box below it. Case insensitive.</div></td> 
				<td valign="top" class="tdrow2"><img class="thumbnail" src="index.php?module=captcha&amp;sid=<# CAPTCHA_ID #>" alt="Security Image" /> <br /><br /> <input type="text" name="captcha_code" style="width: 300px;" class="input_field" /></td>
			</tr>
			<tr>
				<td class="table_footer" colspan="2"><input class="button1" type="submit" value="Send Message" /></td>
			</tr>
		</table>
	</div>
</form>

</template>
<!-- END: CONTACT US PAGE -->

<!-- BEGIN: CONTACT US EMAIL -->
<template id="contact_us_email">
You have received the following email from the site contact form located at <# SITE_NAME #>

----------------------------------

<# EMAIL_ADDRESS #> wrote,

<# EMAIL_BODY #>
</template>
<!-- END: CONTACT US EMAIL -->

<!-- BEGIN: FILE REPORT PAGE -->	
<template id="report_files_page">
	
<form action="contact.php?act=file_report-s" method="post">	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" width="100%">
			<tr>
				<th colspan="2">Report abuse to <# SITE_NAME #></th>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1"><span>E-Mail Address:</span> <br /> <div class="explain">To be considered valid an email address can only contain the characters: -_A-Za-z0-9</div></td> 
				<td valign="top" class="tdrow2"><input type="text" name="email_address" style="width: 300px;" class="input_field" /></td>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Report:</span> <br /> <div class="explain">This report will be sent as plain text, so do not include any HTML.</div></td> 
				<td class="tdrow2"><textarea rows="25" cols="80" class="input_field" name="message_body">List of images to be deleted and reason(s) why (add links, urls, and lines as necessary, no HTML please): 

<# PREDEFINED_LIST #></textarea></td>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Security Image:</span> <br /> <div class="explain">Enter the text from the image on the right into the input box below it. Case insensitive.</div></td> 
				<td valign="top" class="tdrow2"><img class="thumbnail" src="index.php?module=captcha&amp;sid=<# CAPTCHA_ID #>" alt="Security Image" /> <br /><br /> <input type="text" name="captcha_code" style="width: 300px;" class="input_field" /></td>
			</tr>
			<tr>
				<td class="table_footer" colspan="2"><input class="button1" type="submit" value="Send Report" /></td>
			</tr>
		</table>
	</div>
</form>
	
</template>
<!-- END: FILE REPORT PAGE -->	

<!-- BEGIN: FILE REPORT EMAIL -->
<template id="report_files_email">
You have received the following email from the report abuse form located at <# SITE_NAME #>

----------------------------------

<# EMAIL_ADDRESS #> wrote,

<# EMAIL_BODY #>
</template>
<!-- END: FILE REPORT EMAIL -->
