<?php

	/*
		
		MMHCLASS v2.0.1
		
		Thanks to : Michael, Craig, Ahmed, and Eugene, the developer of MMHCLASS v2.0.1.
		Modified and used by Ductungnguyen1234@gmail.com
	*/
	
	
	class mmhclass_mysql_driver
	{
		function mmhclass_mysql_driver()
		{
			global $mmhclass;
			if (extension_loaded("mysql") == false) {
				$mmhclass->templ->fatal_error("Sorry but Mihalism Multi Host will not work without MySQL loaded as a PHP extension");
			}
		}
		
		function connect($host = "localhost", $username, $password, $database, $new_link = NULL)
		{
			global $mmhclass;
			$connection_id = mysql_connect($host, $username, $password, true);
			mysql_query("SET NAMES 'UTF8'");  
			if (is_resource($connection_id) == false) {
				$this->error();
			} else {
				if (mysql_select_db($database, $connection_id) == false) {
					$this->error();
				} else {
					if (is_resource($this->root_connection) == false) {
						$this->root_connection = $connection_id;
					} else {
						if ($mmhclass->funcs->is_null($new_link) == false) {
							if (is_array($this->alt_connections) == true) {
								$this->alt_connections = array();
							}
					
							$this->alt_connections[$new_link] = $connection_id;
						}
					}
				}
			}
			
			return $connection_id;
		}

		function close()
		{
			if (is_resource($this->root_connection) == true) {
				mysql_close($this->root_connection);
			}
			
			if (is_array($this->alt_connections) == true) {
				foreach ($this->alt_connections as $id => $connection) {
					mysql_close($this->alt_connections[$id]);
				}
			}
		}

		function query($query, $connection_id = NULL)
		{
			global $mmhclass;
			if (is_resource($this->root_connection) == false) {
				$this->connect($mmhclass->info->config['sql_host'], $mmhclass->info->config['sql_username'], $mmhclass->info->config['sql_password'], $mmhclass->info->config['sql_database']);
				
			}
			mysql_set_charset('utf8');
			$query = str_replace("<# QUERY_LIMIT #>", ((($mmhclass->info->current_page * $mmhclass->info->config['max_results']) - $mmhclass->info->config['max_results']).", {$mmhclass->info->config['max_results']}"), $query);
			if ($mmhclass->info->config['sql_tbl_prefix'] != "mmh_" && $mmhclass->funcs->is_null($mmhclass->info->config['sql_tbl_prefix']) == false){
				$query = preg_replace("/mmh_(\S+?)([\s\.,]|$)/", ($mmhclass->info->config['sql_tbl_prefix']."\\1\\2"), $query);
			}
			
			if ($mmhclass->funcs->is_null($connection_id) == false) {
				if (is_resource($this->alt_connections[$connection_id]) == false) {
					$this->error($query, "Unknown alternate connection id: {$connection_id}");
				}
			}
			
			$this->query_result = mysql_query($query, (($mmhclass->funcs->is_null($connection_id) == false) ? $this->alt_connections[$connection_id] : $this->root_connection));

			if ($this->query_result == false) {
				$this->error($query);
			} else {
				return $this->query_result;
			}
		}

		function total_rows($query_id)
		{
			return mysql_num_rows($query_id);
		}

		function fetch_array($query_id, $result_type = MYSQL_ASSOC)
		{
			return mysql_fetch_array($query_id, $result_type);
		}

		function error_number()
		{
			global $mmhclass;
			return (($mmhclass->funcs->is_null(mysql_error()) == false) ? mysql_errno() : "Unknown Error Number");
		}

		function error($query = "No Query Executed", $custom_error = NULL)
		{
			global $mmhclass;
			$error_message = (($mmhclass->funcs->is_null($custom_error) == false) ? $custom_error : mysql_error());
			$error_html = "\t\t\t<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
			<html>
				<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
					<title>MySQL Error (Powered by Mihalism Multi Host)</title>
					<style type=\"text/css\">
					    	* { font-size: 100%; margin: 0; padding: 0; }
						body { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 75%; margin: 10px; background: #FFFFFF; color: #000000; }
						a:link, a:visited { text-decoration: none; color: #005fa9; background-color: transparent; }
						a:active, a:hover { text-decoration: underline; }						
						textarea { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; border: 1px dashed #000000; background: #FFFFFF; padding: 5px; background: #f4f4f4; }
					</style>
				</head>
				<body>
					<p>
						<b>MySQL Driver Error</b>
						<br /><br />
						A MySQL error has occurred. 
						Please copy the output shown below and email it immediately to <a href=\"mailto:{$mmhclass->input->server_vars['server_admin']}\">{$mmhclass->input->server_vars['server_admin']}</a>.
						<br /><br />
						<textarea readonly=\"readonly\" rows=\"15\" cols=\"40\" style=\"width:500px;\">Time Encountered: ".date("F j, Y, g:i:s a")."\nIP Address: {$mmhclass->input->server_vars['remote_addr']}\rError: {$error_message}\nError Number: ".$this->error_number()."\nQuery Executed: {$query}</textarea>
					</p>		
				</body>
			</html>";
			exit($error_html);
			return;
		}
	}

?>
