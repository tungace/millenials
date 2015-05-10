<!-- BEGIN: INSTALLER INTRO PAGE -->
<template id="installer_intro_page">

Welcome to Mihalism Multi Host! The Mihalism Multi Host mission is to provide the 
best image hosting software in the world. Our users know from experience that no hosting script on the Internet comes close 
to the power that Mihalism Multi Host can provide. Mihalism, Inc's development team knows that security and compatibility 
are the most important parts of any software. Therefore, we have developed advanced features that are compatible with 
almost any systems. So welcome to Mihalism Multi Host, we know you will love using it!
<br /><br />
You will need to have the following to allow Mihalism Multi Host to operate:
<br /><br />
&nbsp;&nbsp;1. <a href="http://httpd.apache.org/" target="_blank">Apache Web Server</a><br />
&nbsp;&nbsp;&nbsp;2. <a href="http://www.mysql.com/" target="_blank">MySQL Database Server</a><br />
&nbsp;&nbsp;&nbsp;&nbsp;3. <a href="http://www.php.net/" target="_blank">PHP: Hypertext Preprocessor</a><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. <a href="http://www.libgd.org/" target="_blank">GD Graphics Library</a>
<br /><br />
<b>Warning:</b> Using this installer will erase any already existing Mihalism Multi Host installation.
<br /><br />
Click the button shown below to be taken to the installation form.
<br /><br />
<a href="install.php?act=install" class="button1">&raquo; Continue to Installation &raquo;</a>

</template>
<!-- END: INSTALLER INTRO PAGE -->

<!-- BEGIN: INSTALL FORM PAGE -->
<template id="install_form_page">

Fill in the following form completely to install this version of Mihalism Multi Host. Once 
installed you can change these settings and others via the admin control panel. 
<br /><br />
<form action="install.php?act=install-d" method="post">
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" width="100%">
			<tr>
				<th colspan="2">Install Mihalism Multi Host v<# MMH_VERSION #></th>
			</tr>
			<tr>
				<td style="width: 40%;" class="tdrow1"><span>MySQL Host: </span> <br /> <div class="explain">If you are unsure of your MySQL host please contact your hosting company before continuing.</div></td>
				<td valign="top" width="60%" class="tdrow2"><input class="input_field"  type="text" name="sql_host" style="width: 300px;" value="localhost" /></td>
			</tr>
			<tr>
				<td style="width: 40%;" class="tdrow1"><span>MySQL Database Name: </span> <br /> <div class="explain">This will be the table that all information related to your site will be stored in. The database name must already exist.</div></td>
				<td valign="top" width="60%" class="tdrow2"><input class="input_field"  type="text" name="sql_database" style="width: 300px;" value="mmh4x" /></td>
			</tr>
			<tr>
				<td style="width: 40%;" class="tdrow1"><span>MySQL Username: </span></td>
				<td width="60%" class="tdrow2"><input class="input_field"  type="text" name="sql_username" style="width: 300px;" value="root" /></td>
			</tr>
			<tr>
				<td style="width: 40%;" class="tdrow1"><span>MySQL Password (optional): </span> <br /> <div class="explain">We don't recommenced leaving this field empty.</div></td>
				<td valign="top" width="60%" class="tdrow2"><input class="input_field"  type="password" name="sql_password" style="width: 300px;" value="" /></td>
			</tr>
			<tr>
				<td style="width: 40%;" class="tdrow1"><span>Administrator Username: </span> <br /> <div class="explain">Must be between 3 and 30 characters in length and only contain the characters: -_A-Za-z0-9</div></td>
				<td valign="top" width="60%" class="tdrow2"><input class="input_field" type="text" name="username" style="width: 300px;" value="Admin" /></td>
			</tr>
			<tr>
				<td style="width: 40%;" class="tdrow1"><span>Administrator Password: </span> <br /> <div class="explain">Must be between 6 and 30 characters in length. For more security we recommend that the password entered contains at least one numerical character.</div></td>
				<td valign="top" width="60%" class="tdrow2"><input class="input_field"  type="password" name="password" style="width: 300px;" value="" /></td>
			</tr>
			<tr>
				<td style="width: 40%;" class="tdrow1"><span>Administrator Password (confirm):</span></td>
				<td width="60%" class="tdrow2"><input class="input_field"  type="password" name="password-c" style="width: 300px;" value="" /></td>
			</tr>
			<tr>
				<td style="width: 40%;" class="tdrow1"><span>Administrator E-Mail Address: </span> <br /> <div class="explain">To be considered valid an email address can only contain the characters: &nbsp; -_A-Za-z0-9</div></td>
				<td valign="top" width="60%" class="tdrow2"><input class="input_field"  type="text" name="email_address" style="width: 300px;" value="<# SERVER_ADMIN #>" /></td>
			</tr>
			<tr>
				<td colspan="2" class="table_footer"><input class="button1" type="submit" value="Finish Installation" /></td>
			</tr>
		</table>
	</div>
</form>

</template>
<!-- END: INSTALL FORM PAGE -->
