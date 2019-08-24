<?php
    global $global_variable;
    $global_variable['site_url'] = 'http://localhost/crypto/';
	$abosolute_path = dirname(__FILE__);
    $abosolute_path = str_replace('inc', '', $abosolute_path);
    $global_variable['site_path'] = $abosolute_path;
	
	
	 /*****************
        ## Paths
    ****************/

    $root      = 'http://localhost';
	$base_name = '/crypto/';
    $css       = $root . $base_name . 'assets/css/';
    $js        = $root . $base_name .  'assets/js/';
    $images    = $root . $base_name .  'assets/images/';
    $header    = $root . $base_name .  'header.php';
	$qr_path   = $root . $base_name .  'inc/qr_generator/php/qr_img.php';
	

?>
