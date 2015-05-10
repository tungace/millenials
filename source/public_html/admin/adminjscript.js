// ======================================== \
// Package: Mihalism Multi Host
// Version: 4.0.0
// Copyright (c) 2007, 2008 Mihalism, Inc.
// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
// ======================================== /

var page_url         = location.href;
var google_account   = "UA-1125794-2"; // <- Google Analytics tracker ID
var xmlhttp_handle   = ajax_connect();

_uacct = google_account; 
urchinTracker();

function fetchElementById(id) 
{ 
	if (document.getElementById) {
		var return_var = document.getElementById(id); 
	} else if (document.all) {
		var return_var = document.all[id]; 
	} else if (document.layers) { 
		var return_var = document.layers[id]; 
	} else {
		alert("Failed to fetch element ID '" + id + "'");
	}
	return return_var; 
}

function ajax_connect()
{
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e) {
				alert("Your browser does not support AJAX!");
			}
		}
	}

	return xmlhttp;
}

function get_cookie(cookie_name)
{
	if (document.cookie.length > 0) {
		cookie_start = document.cookie.indexOf(cookie_name + "=");
		
		if (cookie_start != -1) { 
			cookie_start = ((cookie_start + cookie_name.length) + 1); 
			cookie_end   = document.cookie.indexOf(";", cookie_start);
			
			if ( cookie_end == -1) {
				cookie_end = document.cookie.length;
			}
			
			return unescape(document.cookie.substring(cookie_start, cookie_end));
		} 
	}
	
	return false;
}

function set_cookie(cookie_name, value, expire)
{
	var expire_date = new Date();
	
	expire_date.setDate(expire_date.getDate() + expire);
	document.cookie = (cookie_name + "=" + escape(value) + ((expire == null) ? "" : ";expires=" + expire_date.toGMTString()));

	return true;
}

function gallery_action(act, id, value, extra)
{
	if (act == "move" || act == "delete") {
		var checked_files = new Array();
		var block_id = document.forms['admin_gallery'];
			
		for (i = 0; i < block_id.elements.length; i++) {
			if (block_id.elements[i].name == "userfile[]") {
				if (block_id.elements[i].checked == 1) {
					checked_files[i] = block_id.elements[i].value;
				}
			}
		}
	}

	switch (act) {
		case "select":
			var block_id = document.forms['admin_gallery'];
			
			for (i = 0; i < block_id.elements.length; i++) {
				if (block_id.elements[i].name == "userfile[]") {
					if (block_id.elements[i].checked == 1) {
						block_id.elements[i].checked = 0;
					} else {
						block_id.elements[i].checked = 1;
					}
				}
			}
			break;
		case "rename":
			var block_id = fetchElementById(id);
			
			block_id.setAttribute("onclick", null);
			block_id.innerHTML = "<input type=\"text\" id=\"" + id + "_rename\" maxlength=\"25\" style=\"width: 165px;\" class=\"input_field\" value=\"" + block_id.innerHTML + "\" />";
			fetchElementById(id + "_rename").setAttribute("onblur", "javascript:gallery_action('rename-d', '" + id + "', this.value);");
			fetchElementById(id + "_rename").setAttribute("onkeypress", "javascript:void(0);");
			highlight(fetchElementById(id + "_rename"));
			break;
		case "rename-d":
			var block_id = fetchElementById(id);
			var new_title = ((value == "") ? "Untitled" : value);
		
			xmlhttp_handle.open("GET", ("admin.php?act=rename_file_title&file=" + id + "&title=" + encodeURI(new_title)), false);
			xmlhttp_handle.send(null);
			
			block_id.innerHTML = xmlhttp_handle.responseText;
			block_id.setAttribute("onclick", "javascript:gallery_action('rename', this.id);");
			break;
		case "move":
			var files_to_move = "";
			
			for (i = 0; i < checked_files.length; i++) {
				if (checked_files[i] != undefined) {
					files_to_move += (checked_files[i] + ",");
				}
			}
			
			if (files_to_move != "") {
				files_to_move = files_to_move.substr(0, (files_to_move.length - 1));
				toggle_lightbox(("admin.php?act=move_files&gal=" + id + "&files=" + encodeURI(files_to_move) + "&return=" + encodeURIComponent(page_url)), "move_files_lightbox");
			}
			break;
		case "delete":
			var files_to_delete = "";
			
			for (i = 0; i < checked_files.length; i++) {
				if (checked_files[i] != undefined) {
					files_to_delete += (checked_files[i] + ",");
				}
			}
			
			if (files_to_delete != "") {
				files_to_delete = files_to_delete.substr(0, (files_to_delete.length - 1));
				toggle_lightbox(("admin.php?act=delete_files&gal=" + id + "&files=" + encodeURI(files_to_delete) + "&return=" + encodeURIComponent(page_url)), "move_files_lightbox");
			}
			break;
	}
	
	return true;
}

function toggle_lightbox(url, div)
{
	var block_id    = fetchElementById("page_body");
	var request_url = (url + (((url.match(/\?/)) ? "&" : "?") + "lb_div=" + div));

	if (url != "no_url") {
		var lightbox_id  = document.createElement("div");
		
		scroll(0, 0);
	
		lightbox_id.setAttribute("id", div);
		
		xmlhttp_handle.open("GET", request_url, false);
		xmlhttp_handle.send(null);

		lightbox_id.innerHTML  = "<div class=\"lightbox_main\">" + xmlhttp_handle.responseText + "</div>";
		lightbox_id.innerHTML += "<div class=\"lightbox_background\">&nbsp;</div>";
		
		block_id.appendChild(lightbox_id);
	} else {
		var lightbox_id = fetchElementById(div);

		block_id.removeChild(lightbox_id);
	}

	return;
}

function highlight(field) 
{
       	field.focus();
       	field.select();
	return true;
}

function toggle(id) {
	var block_id = fetchElementById(id);

	if (block_id.style == false) {
		block_id.setAttribute("style", "");
	}
		
	block_id.style.display = ((block_id.style.display == "none") ? "block" : "none");

	return true;
}

function position_pulldown(menu_obj, menu_id) 
{
	var block_id = fetchElementById(menu_id);
	var block_obj = menu_obj;
	var left_position = top_position = 0;
	
	if (block_obj.offsetParent) {
		while (block_obj.offsetParent) {
			left_position += block_obj.offsetLeft;
			top_position  += block_obj.offsetTop;
			block_obj = block_obj.offsetParent
		}
	}
	
	block_id.setAttribute("style", ""); //<- Reset style attribute
	
	block_id.style.position = "absolute";
	block_id.style.top      = ((top_position + 17) + "px");
	block_id.style.left     = (left_position + "px");
	
	return true;
}
