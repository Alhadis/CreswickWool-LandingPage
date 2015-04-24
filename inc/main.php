<?php

	# Set current working directory
	$cwd	=	getcwd();
	chdir(dirname(__FILE__));


	include_once 'constants.php';
	include_once 'func.php';


	# Path prefix prepended to any URLs pointing to Creswick Wool's base directory
	$base_url		=	'../';


	# Detected server environment: K_ENV_*
	$environment	=	FALSE === stripos($_SERVER['SERVER_NAME'], 'creswickwool') ? K_ENV_DEVELOPMENT : K_ENV_PRODUCTION;


	# Locale setting
	$locale		=	K_LOCALE_CHINESE;


	# HTML lang attribute values
	$page_langs	=	array(
		'en_AU'	=>	'en-AU',
		'zh_CN'	=>	'zh-Hans'
	);


	# Ensure gettext support is available.
	if(function_exists('bindtextdomain')){
		setlocale(LC_ALL, $locale);
		bindtextdomain('messages', '../src/lang');
		bind_textdomain_codeset('messages', 'UTF-8');
		textdomain('messages');
	}


	# If translations aren't possible, switch the page's locale to English, since it'll affect its styling.
	else $locale	=	K_LOCALE_ENGLISH;


	# Load product configuration
	include_once 'products.php';


	# Restore previous working directory
	chdir($cwd);
