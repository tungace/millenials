<?php

	/*
		
		MMHCLASS v2.0.1
		
		Thanks to : Michael, Craig, Ahmed, and Eugene, the developer of MMHCLASS v2.0.1.
		Modified and used by Ductungnguyen1234@gmail.com
	*/
	
	
	class mmhclass_core_functions
	{
		function clean_array($array)
		{
			if (is_array($array) == true) {
				$array_keys = array_keys($array);
				for ($i = 0; $i < count($array_keys); $i++) {
					$key = $array_keys[$i];
					$value = $array[$key];
					$new_key = strtolower($key);
					unset($array[$key]);
					if (is_array($value) == true) {
						$array[$new_key] = $this->clean_array($value);
					} elseif ($this->is_null($value) == NULL) {
						$array[$new_key] = $this->clean_value($value);
					}
				}
			}
			return $array;
		}

		function clean_value($value, $value_decode = false)
		{
			if ($value_decode == true) { // <-- Decode cleaned string
				$value = html_entity_decode($value);
				$value = strtr($value, array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_COMPAT)));
				$value = str_replace("<br />", "\n", $value);
			} else {
				$value = str_replace("\\\"", "\"", $value); // <-- Because stripslashes() removes Windows directory slashes
				$value = str_replace("\\'", "'", $value); // <-- ^
				$value = str_replace("\\\\", "\\", $value); // <!-- ^^
				$value = str_replace("&#032;", " ", $value);
				$value = str_replace("&", "&amp;", $value);
				$value = str_replace("<!--", "&#60;&#33;--", $value);
				$value = str_replace("-->", "--&#62;" , $value);
				$value = preg_replace("/<script/i", "&#60;script", $value);
				$value = str_replace(">", "&gt;", $value);
				$value = str_replace("<", "&lt;", $value);
				$value = str_replace('"', "&quot;", $value);
				$value = str_replace("\n", "<br />", $value);
				$value = str_replace("$", "&#036;", $value);
				$value = str_replace("\r", NULL, $value); 
				$value = str_replace("!", "&#33;", $value);
				$value = str_replace("'", "&#39;", $value); // <-- zProtecting the world one variable at a time.
			}
			return $value;
		}
		
		function is_null($string) 
		{
			return ((empty($string) == false && $string !== 0 && $string !== "0") ? false : true);
		}

		function format_number($number)
		{
			return strrev(preg_replace("/(\d{3})(?=\d)(?!\d*\.)/", "$1,", strrev(intval($number))));
		}

		function valid_string($string, $valid_chars = "-_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789")
		{
			for ($i = 0; $i < strlen($string); $i++) {
				$string_preg_match = preg_quote(substr($string, $i, 1));
				if (preg_match("/{$string_preg_match}/", $valid_chars) == false) {
					return false;
				}
			}
			return true;
 		}

		function random_string($max_length = 20, $random_chars = "abcdefghijklmnopqrstuvwxyz0123456789")
		{
			for ($i = 0; $i < $max_length; $i++) {
				$random_key = mt_rand(0, strlen($random_chars));
				$random_string .= substr($random_chars, $random_key, 1);
			}
			return strtolower(str_shuffle($random_string));
		}

		function valid_email($email_address)
		{
			return ((preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", trim($email_address)) == true) ? true : false);
		}

		function fetch_url($base = true, $www = true, $query = true)
		{
			global $mmhclass;
			$the_url  = (($this->is_null($mmhclass->input->server_vars['https']) == false) ? "https://" : "http://");
			$the_url .= (($www == true && preg_match("/^www\./", $mmhclass->input->server_vars['http_host']) == false) ? "www.{$mmhclass->input->server_vars['http_host']}" : $mmhclass->input->server_vars['http_host']);
			$the_url .= ((pathinfo($mmhclass->input->server_vars['php_self'], PATHINFO_DIRNAME) != "/") ? (pathinfo($mmhclass->input->server_vars['php_self'], PATHINFO_DIRNAME)."/") : pathinfo($mmhclass->input->server_vars['php_self'], PATHINFO_DIRNAME)); 
			$the_url .= (($base == true) ? pathinfo($mmhclass->input->server_vars['php_self'], PATHINFO_BASENAME) : NULL);
			$the_url .= (($query == true && $this->is_null($mmhclass->input->server_vars['query_string']) == false) ? "?{$mmhclass->input->server_vars['query_string']}" : NULL); 
			$the_url  = ((strtoupper(substr(PHP_OS, 0, 3)) === "WIN") ? str_replace("\/", "/", $the_url) : $the_url); // <- Because Windows hates forward slashes
			return $the_url;
		}
	}

?>
