<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function redirect_ssl()
{
	$CI =& get_instance();
	$class = $CI->router->fetch_class();
	$exclude = array('client');
	if (!in_array($class, $exclude)) {
		$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
		if ($_SERVER['SERVER_PORT'] != 443) redirect($CI->uri->uri_string());
	} else {
		$CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);
		if ($_SERVER['SERVER_PORT'] == 443) redirect($CI->uri->uri_string());
	}
}