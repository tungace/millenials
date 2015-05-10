<?php
	
	/*
		
		MMHCLASS v2.0.1
		
		Thanks to : Michael, Craig, Ahmed, and Eugene, the developer of MMHCLASS v2.0.1.
		Modified and used by Ductungnguyen1234@gmail.com
	*/
	
	ob_start(array("ob_gzhandler", 9));
	clearstatcache();

	header("Cache-Control: no-cache, must-revalidate;"); 
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT;");

	$mmhclass = new stdClass; // <-- Just make it look like a class

	ini_set("display_errors"  , 0);
	ini_set("log_errors"      , 0);
	ini_set("register_globals", 0);
	ini_set("memory_limit"    , "128M");
	ini_set("post_max_size"   , "128M");
	
	if (__FILE__ == NULL) {
		exit("<b>Fatal Error</b>: <br /><br /> __FILE__ is NULL <br /><br /> Application Exited");
	}
	
	$mmhclass->info->root_path = (dirname(preg_replace("#/source/includes/#i", "/", str_replace("\\", "/",  __FILE__)))."/"); //<-- YAH! Now works on Windows
	
	require_once "{$mmhclass->info->root_path}source/includes/config.php";
	require_once "{$mmhclass->info->root_path}source/includes/functions.php";
	require_once "{$mmhclass->info->root_path}source/includes/database.php";
	require_once "{$mmhclass->info->root_path}source/includes/template.php";
	/*require_once "{$mmhclass->info->root_path}source/includes/imagemagick.php";*/

	$mmhclass->db    = new mmhclass_mysql_driver();
	$mmhclass->templ = new mmhclass_template_engine();
	$mmhclass->funcs = new mmhclass_core_functions();
	/*$mmhclass->image = new mmhclass_image_functions();*/
	
	$mmhclass->input->get_vars    = $mmhclass->funcs->clean_array($_GET);    // <-- MySQL Safe _GET Variable
	$mmhclass->input->file_vars   = $mmhclass->funcs->clean_array($_FILES);  // <-- MySQL Safe _FILES Variable
	$mmhclass->input->post_vars   = $mmhclass->funcs->clean_array($_POST);   // <-- MySQL Safe _POST Variable
	$mmhclass->input->server_vars = $mmhclass->funcs->clean_array($_SERVER); // <-- MySQL Safe _SERVER Variable
	$mmhclass->input->cookie_vars = $mmhclass->funcs->clean_array($_COOKIE); // <-- MySQL Safe _COOKIE Variable

	$mmhclass->info->version      = "4.0.0"; // <-- DO NOT CHANGE !
	$mmhclass->info->base_url     = $mmhclass->funcs->fetch_url(false, false, false);
	$mmhclass->info->page_url     = $mmhclass->funcs->fetch_url(true, false, true);
	$mmhclass->info->script_path  = ((dirname($mmhclass->input->server_vars['php_self']) != "/") ? (dirname($mmhclass->input->server_vars['php_self'])."/") : dirname($mmhclass->input->server_vars['php_self']));
	$mmhclass->info->current_page = round(($mmhclass->funcs->is_null($mmhclass->input->get_vars['page']) == false && $mmhclass->input->get_vars['page'] >= 1) ? $mmhclass->input->get_vars['page'] : 1);

	if (version_compare(phpversion(), "4.0.0", ">=") == false) { 
		echo "Your PHP version is not compatible with us : {$mmhclass->info->version}";
	}
	/*
	if ($mmhclass->info->site_installed == false) {
		if (preg_match("/install/", basename($mmhclass->input->server_vars['php_self'])) == false) {
			$mmhclass->templ->page_title = "Installation Required";
			$mmhclass->templ->message("This website has yet to be installed. Please click <a href=\"install.php\">here</a> to continue to installation.", true);
		}
	} else {
		$do_not_null = array("do_not_null", "mmhclass", "HTTP_SERVER_VARS", "GLOBALS", "_GET", "_POST", "_COOKIE", "_REQUEST", "_SERVER", "_SESSION", "_ENV", "_FILES");
		foreach ($GLOBALS as $variable_name => $variable_value) {
			if (in_array($variable_name, $do_not_null) == false) {
				$$variable_name = NULL;
			}
		}
		
		$mmhclass->db->query("UPDATE `mmh_site_cache` SET `cache_value` = `cache_value` + 1 WHERE `cache_id` = 'page_views';");

		$sql = $mmhclass->db->query("SELECT * FROM `mmh_site_cache`;");
		while ($row = $mmhclass->db->fetch_array($sql)) {
			$mmhclass->info->site_cache[$row['cache_id']] = $row['cache_value'];
		}

		$sql = $mmhclass->db->query("SELECT * FROM `mmh_site_settings`;");
		while ($row = $mmhclass->db->fetch_array($sql)) {
			$mmhclass->info->config[$row['config_key']] = $row['config_value'];
		}
		
		$sql = $mmhclass->db->query("SELECT * FROM `mmh_robot_info`;");
		while ($row = $mmhclass->db->fetch_array($sql)) {
			if (preg_match("#{$row['preg_match']}#i", html_entity_decode($mmhclass->input->server_vars['http_user_agent'])) == true) {
				$current_page = str_replace($mmhclass->info->base_url, NULL, $mmhclass->info->page_url);
				$mmhclass->db->query("INSERT INTO `mmh_robot_logs` (`robot_id`, `page_indexed`, `time_indexed`, `ip_address`, `user_agent`, `http_referer`) VALUES ('{$row['robot_id']}', '{$current_page}', '".time()."', '{$mmhclass->input->server_vars['remote_addr']}', '{$mmhclass->input->server_vars['http_user_agent']}', '{$mmhclass->input->server_vars['http_referer']}');");
				$mmhclass->info->is_robot = true;
			}
		}

		if ($mmhclass->funcs->is_null($mmhclass->input->cookie_vars['mmh_user_session']) == false && $mmhclass->info->is_robot == false) {
			$mmhclass->info->user_session = unserialize(stripslashes(str_replace("&quot;", "\"", urldecode($mmhclass->input->cookie_vars['mmh_user_session']))));
			$sql = $mmhclass->db->query("SELECT * FROM `mmh_user_sessions` WHERE `user_id` = '{$mmhclass->info->user_session['user_id']}' AND `session_id` = '{$mmhclass->info->user_session['session_id']}' AND `ip_address` = '{$mmhclass->input->server_vars['remote_addr']}';");
			if ($mmhclass->db->total_rows($sql) == 1) {
				$sql = $mmhclass->db->query("SELECT * FROM `mmh_user_info` WHERE `user_id` = '{$mmhclass->info->user_session['user_id']}';");
				if ($mmhclass->db->total_rows($sql) == 1) {
					$mmhclass->info->is_user   = true;
					$mmhclass->info->user_data = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `mmh_user_info` WHERE `user_id` = '{$mmhclass->info->user_session['user_id']}';"));
					$mmhclass->info->is_admin  = (($mmhclass->info->user_data['user_group'] === "root_admin" || $mmhclass->info->user_data['user_group'] === "normal_admin") ? true :false);
				}
			}
		}
		
		if ($mmhclass->info->is_user == true) {
			$mmhclass->info->config['file_extensions'] = $mmhclass->info->config['user_file_extensions'];
			$mmhclass->info->config['max_filesize']    = $mmhclass->info->config['user_max_filesize'];
			unset($mmhclass->info->config['user_file_extensions'], $mmhclass->info->config['user_max_filesize']);
		}

		$mmhclass->info->config['file_extensions'] = preg_split("/,/", str_replace(".", NULL, trim($mmhclass->info->config['file_extensions'])));

		if ($mmhclass->funcs->is_null($mmhclass->input->get_vars['rurl']) == false) {
			$return_url = strtr(base64_decode($mmhclass->input->get_vars['rurl']), array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_COMPAT)));
			header("Location: {$return_url}");
			exit;
		}

		$sql = $mmhclass->db->query("SELECT * FROM `mmh_ban_filter`;");
		while ($row = $mmhclass->db->fetch_array($sql)) {
			if ($row['ban_type'] == 1 && trim($row['ban_value']) == $mmhclass->input->server_vars['remote_addr']) {
				$mmhclass->templ->error("Your IP address <b>{$row['ban_value']}</b> has been banned from use of {$mmhclass->info->config['site_name']}.", true);
			} elseif ($row['ban_type'] == 2 && $mmhclass->info->is_user == true && trim($row['ban_value']) == $mmhclass->info->user_data['username']) {
				$mmhclass->templ->error("Your account has been banned from use of {$mmhclass->info->config['site_name']}.", true);
			}
		}

		if ($mmhclass->funcs->is_null($mmhclass->input->get_vars['do_random']) == false) {
			$sql = $mmhclass->db->query("SELECT * FROM `mmh_file_storage` WHERE `is_private` = '0' AND `gallery_id` = '0' ORDER BY RAND() LIMIT 1;");
			if ($mmhclass->db->total_rows($sql) != 1) {
				$mmhclass->templ->error("Failed to locate a random image file.", true);
			} else {	
				$file_info = $mmhclass->db->fetch_array($sql);
				header("Location: {$mmhclass->info->base_url}viewer.php?is_random=1&file={$file_info['filename']}");
				exit;
			}
		}
		if ($mmhclass->funcs->is_null($mmhclass->input->get_vars['version']) == false) {
			header("Content-Type: text/plain;");
			header("Content-Disposition: inline; filename=mmhcheck.txt;");
			echo $mmhclass->info->version;
			exit;
		}
	}
*/
?>
