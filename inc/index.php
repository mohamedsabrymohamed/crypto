<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');
date_default_timezone_set('Africa/Cairo');

	require_once 'connection.php';
	require_once 'global.php';
	require_once 'params.php';
	require_once 'users.php';
	require_once 'functions.php';
	require_once 'non_user_login_history.php';
	require_once 'csprng.php';
	require_once 'login_history.php';
	require_once 'class.phpmailer/PHPMailerAutoload.php';
	require_once 'trace.php';
	require_once 'wrong_login_history.php';
	require_once 'all_countries.php';
	require_once 'notifications_table.php';
	require_once 'sms_verf_table.php';
	require_once 'user_balance_change_table.php';
	require_once 'user_current_balance_table.php';
	require_once 'user_bank_table.php';
	require_once 'user_addresses.php';
	require_once 'encrypt.php';
	
	?>
