<?php

	/*
		
		MMHCLASS v2.0.1
		
		Thanks to : Michael, Craig, Ahmed, and Eugene, the developer of MMHCLASS v2.0.1.
		Modified and used by Ductungnguyen1234@gmail.com
	*/
	
	/* Template Parser: v1.0.2 */
	
	class mmhclass_template_engine
	{
		function mmhclass_template_engine()
		{
			$this->templ_vars = array(); 
			$this->templ_globals = array();
			$this->templ_html = array();
			return;
		}
	
		function output($filename = NULL, $template = NULL)
		{
			global $mmhclass;
			$template_html  = $this->page_header();
			$template_html .= (($mmhclass->funcs->is_null($this->html) == false) ? $this->html : $this->parse_template($filename, $template));
			$template_html .= $this->page_footer();
			$mmhclass->db->close();
			exit($template_html);
			return;
		}
		
		function parse_template($filename, $template = NULL) {
			global $mmhclass;
			
			if (is_file("{$mmhclass->info->root_path}source/public_html/{$filename}.tpl") == false) {
				exit("<b>Fatal Error</b>: The template '{$filename}.tpl' does not exist.");
			} else {
				$html2parse = implode("", file("{$mmhclass->info->root_path}source/public_html/{$filename}.tpl"));
				
				$html2parse = preg_replace("#<!-- (BEGIN|END): (.*) -->#", NULL, $html2parse);
				$html2parse = preg_replace("#<\\$(.*?)\\$>#Us", NULL, $html2parse);
				$html2parse = preg_replace(array('#<([\?%])=?.*?\1>#s', '#<script\s+language\s*=\s*(["\']?)php\1\s*>.*?</script\s*>#s', '#<\?php(?:\r\n?|[ \n\t]).*?\?>#s'), NULL, $html2parse);
			
				if (strstr($html2parse, "<template id=") == true) {
					$html2parse = trim(preg_replace("#</template>(.*)<template#Us", "</template>\n<template", $html2parse));
				
					/* Parse <template> tag into the templ_html array */
					preg_match_all("#<template id=\"(.*)\">#", $html2parse, $template_matches);
					foreach ($template_matches['1'] as $template_id) {
						$html2parse = preg_replace("#<template id=\"{$template_id}\">(.*)</template>#Us", "<"."?php\n\tob_start();\n?>$1<"."?php\n\t\$this->templ_html['{$filename}.{$template_id}'] = ob_get_clean();\n?".">", $html2parse);
					}
					$template_preg = preg_match("#<\?php(?:\r\n?|[ \n\t])(.*?)\?>#Us", $html2parse, $preg_matches);
					eval($preg_matches['1']);
					
					if (array_key_exists("{$filename}.{$template}", $this->templ_html) == false) {
						exit("<b>Fatal Error</b>: Template ID '{$template}' does not exist.");
					} else {
						$html2parse = $this->templ_html["{$filename}.{$template}"];
					}
				}
				
				if (empty($this->templ_vars) == false) {
					for ($i = 0; $i < count($this->templ_vars); $i++) {
						foreach ($this->templ_vars[$i] as $variable => $replacement) {
							if (preg_match("#<\# {$variable} \#>#", $html2parse) == true) {
								$html2parse = str_replace("<# {$variable} #>", $replacement, $html2parse);
								unset($this->templ_vars[$i][$variable]);
							}
						}
					}
				}
				
				if (strstr($html2parse, "<foreach=") == true) {
					$parse_html2php = true;
					$html2parse = preg_replace("#<foraech=\"(.*)\">#", '<?php foreach ($1) { ?>', $html2parse);
					$html2parse = preg_replace("#</endforeach>#", '<?php } ?>', $html2parse);
				}
				
				if (strstr($html2parse, "<if=") ==  true) {
					$parse_html2php = true;
					$html2parse = preg_replace("#<if=\"(.*)\">#", '<?php if ($1) { ?>', $html2parse);
					$html2parse = preg_replace("#<elseif=\"(.*)\">#", '<?php } elseif ($1) { ?>', $html2parse);
					$html2parse = preg_replace("#<else>#", '<?php } else { ?>', $html2parse);
					$html2parse = preg_replace("#</endif>#", '<?php } ?>', $html2parse);
				}
				
				if (strstr($html2parse, "<php>") == true) {
					$parse_html2php = true;
					$html2parse = preg_replace("#<php>#", '<?php', $html2parse);
					$html2parse = preg_replace("#</php>#", '?>', $html2parse);
				}	
				
				if (strstr($html2parse, "<while id=") == true) {
					preg_match("#<while id\=\"(.*)\">(.*)</endwhile>#Us", $html2parse, $whileloop_matches);
					if ($this->templ_globals['get_whileloop'] == false) {
						$html2parse = preg_replace("#<while id\=\"{$whileloop_matches['1']}\">(.*)</endwhile>#Us", $this->templ_globals[$whileloop_matches['1']], $html2parse);
					} else {
						$html2parse = $whileloop_matches['2'];
					}
				}	
				
				if ($parse_html2php == true) {
					ob_start();
					eval("?".">".$html2parse);
					$html2parse = ob_get_clean();
				}	
				
				// I like WWE Monday Night Raw, do you ?
				
				return $html2parse;
			}
		}

		function page_header()
		{
			global $mmhclass;
			if ($mmhclass->funcs->is_null($this->page_header) == true) {
				$this->templ_vars[] = array(
					"PAGE_TITLE" => (($mmhclass->funcs->is_null($this->page_title) == false) ? $this->page_title : "Welcome to {$mmhclass->info->config['site_name']}, a free image upload solution. Simply browse, select, and upload!"),
					"BASE_URL"   => $mmhclass->info->base_url,
					"URL_SCHEME" => (($mmhclass->funcs->is_null($mmhclass->input->server_vars['https']) == false) ? "s://ssl." : "://www"),
					"SITE_NAME"  => $mmhclass->info->config['site_name'],
					"USERNAME"   => $mmhclass->info->user_data['username'],
					"RETURN_URL" => base64_encode($mmhclass->info->page_url),
				);
				return $this->parse_template("page_header");
			} else {
				return $this->page_header;
			}
		}

		function page_footer()
		{
			global $mmhclass;
			if ($mmhclass->funcs->is_null($this->page_footer) == true) {
				$this->templ_vars[] = array(
					"TOTAL_PAGE_VIEWS" => (($mmhclass->info->site_cache['page_views'] == NULL) ? "<i>Not Installed</i>" : $mmhclass->funcs->format_number($mmhclass->info->site_cache['page_views'])),
				);
				return $this->parse_template("page_footer");
			} else {
				return $this->page_footer;
			}
		}

		function error($error, $output_html = true)
		{
			return $this->message("<h1>Warning</h1><br />{$error}", $output_html);
		}

		function message($message, $output_html = false)
		{
			global $mmhclass;
			$template_html = "\t\t\t<div class=\"message_box\">{$message}</div>";
			if ($output_html == true) {
				$this->html = $template_html;
				$this->output();
				return;
			} else {
				return $template_html;
			}
		}

		function pagelinks($base_url, $total_results)
		{
			global $mmhclass;
			$total_pages  = ceil($total_results / $mmhclass->info->config['max_results']); 
			$base_url     = ($base_url.((preg_match("/\?/", $base_url) == true) ? "&amp;" : "?"));
			$current_page = (($mmhclass->info->current_page > $total_pages) ? $total_pages : $mmhclass->info->current_page); 
			if ($total_pages < 2) {
				$template_html = "Viewing Only Page";
			} else {
				$template_html .= (($current_page > 1) ? "<a href=\"{$base_url}page=".($mmhclass->info->current_page - 1)."\">&laquo; Previous</a>" : NULL);
				for ($i = 0; $i < $total_pages; $i++) {
					$this_page = ($i + 1);
					if ($this_page == $current_page) {
						$template_html .= "<strong>{$this_page}</strong>";
					} else {
						if ($this_page < ($current_page - 5)) {
							continue;
						}
						if ($this_page > ($current_page + 5)) {
							break;
						}
						$template_html .= ("<a href=\"{$base_url}page={$this_page}\">".$mmhclass->funcs->format_number($this_page)."</a>");
					}
				}
				$template_html .= (($current_page < $total_pages) ? ("<a href=\"{$base_url}page=".($mmhclass->info->current_page + 1)."\">Next &raquo;</a>") : NULL);
				$template_html  = "Page {$current_page} of {$total_pages} &bull; {$template_html}";
			}
			return "<div class=\"pagination\">Pages: {$template_html}</div>";
		}
		
		function fatal_error($error) {
			exit("\t\t\t<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
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
					<p><b>Fatal Error</b>
					<br /><br />
					{$error}
					<br /><br />
					Application Exited
				</body>
			</html>");
			return;
		}	

		function file_results($filename){
			global $mmhclass;
			if ($mmhclass->funcs->is_null($filename) == true || is_file($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$filename) == false) {
				$this->error("Failed to load image links because of an unknown problem.");
			} else {
				$this->templ_globals['extension'] = $mmhclass->image->file_extension($filename);
				$this->templ_vars[] = array(
					"THUMBNAIL"   => ((is_file($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$mmhclass->image->thumbnail_name($filename)) == false && $mmhclass->image->manipulator == "gd") ? "{$mmhclass->info->base_url}css/images/no_thumbnail.jpg" : $mmhclass->info->base_url.$mmhclass->info->config['upload_path'].$mmhclass->image->thumbnail_name($filename)),
					"FILENAME"    => $filename,
					"BASE_URL"    => $mmhclass->info->base_url,
					"UPLOAD_PATH" => $mmhclass->info->config['upload_path'],
					"SITE_NAME"   => $mmhclass->info->config['site_name'],
				
				);
				$template_html = $this->parse_template("links");
				unset($this->templ_globals['extension'], $this->templ_vars);
				return $template_html;
			}
		}
	}

?>
