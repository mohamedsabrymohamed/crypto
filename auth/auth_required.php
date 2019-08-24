<?php 
	//env
	
	$URL='crypto';
    require_once (realpath($_SERVER["DOCUMENT_ROOT"]) ."/".$URL.'/inc.php');
    if(!is_user_login())
    {
		$query          = $_SERVER['PHP_SELF'];
		$path           = pathinfo( $query );
		if ($path['dirname'] == '/crypto'){
        ?><script>window.location = 'index.php';</script><?php
    }
	else{
		?><script>window.location = '../index.php';</script><?php
	}
	}
	
	//prod
/*
	 require_once '../inc.php';
    if(!is_user_login())
    {
        ?><script>window.location = 'index.php';</script><?php
    }
*/
	?>