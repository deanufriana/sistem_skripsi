<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'Pdf', 'session', 'encryption', 'form_validation', 'email');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'form', 'myhelper', 'date', 'file', 'string', 'text');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('M_data');
