<?php
/*
Plugin Name: TTT Devices
Plugin URI: http://www.33themes.com
Description: Simple detectior device: mobile, tablet, richtCSS. Only -interface- base on http://www.mobileesp.com library. Insert device class in <body>
Version: 0.4
Author: 33 Themes UG i.Gr.
Author URI: http://www.33themes.com
License: MIT License
*/


require_once(dirname(__FILE__).'/sdc_uagent_info.class.php');

global $sdc_uagent_info;

if (!$sdc_uagent_info) {
	$sdc_uagent_info = new sdc_uagent_info();
	$sdc_uagent_info->uagent_info();
}

function is_tttdevice( $name = false, $engine = false ) {
	global $sdc_uagent_info;
	$uai =& $sdc_uagent_info;

	$name = trim(mb_strtolower($name));
	switch( $name ) {
 		case 'mobile':
 			return ( $uai->isTierIphone > 0 ? true : false );
	      		break;
 		case 'tablet':
 			return ( $uai->isTierTablet > 0 ? true : false );
 			break;
 		case 'iphone':
 			return ( $uai->isIphone > 0 ? true : false );
 			break;
 		case 'android':
 			return ( $uai->isAndroidPhone > 0 ? true : false );
 			break;
 		case 'winphone':
 		case 'windowsphone':
 			return ( $uai->DetectWindowsPhone7() > 0 ? true : false );
 			break;
 		case 'tv':
 			return ( $uai->DetectGoogleTV() > 0 ? true : false );
 		case 'ebook':
 			return ( $uai->DetectKindle() > 0 || $uai->DetectAmazonSilk() > 0 ? true : false );
 		case 'desktop':
 			return ( !is_tttdevice('mobile') && !is_tttdevice('tablet') && !is_tttdevice('ebook') ? true : false );
 			break;
 	}


	return false;
}

function is_tttdevice_engine( $engine = false ) {
	global $sdc_uagent_info;

	$engine = trim(mb_strtolower($engine));

	switch( $name ) {
		case 'webkit':
			return ( $sdc_uagent_info->DetectWebkit() > 0 ? true : false );
			break;
	}

	return false;

}

function browser_body_class($classes) {
 
    // A little Browser detection shall we?
    $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
	
	if ( is_tttdevice('mobile') )
		$classes[] = 'mobile';
	elseif ( is_tttdevice('tablet') )
		$classes[] = 'tablet';
	elseif ( is_tttdevice('desktop') )
		$classes[] = 'desktop';
 
    return $classes;
}
 
add_filter('body_class','browser_body_class');

function ttt_devices_script() {
    wp_enqueue_script(
        'ttt-devices',
        plugins_url( '/js/ttt-devices.js' , __FILE__ ),
        array( 'jquery' ),
        '0.4.2'
    );
}
add_action('wp_enqueue_scripts','ttt_devices_script',0);
