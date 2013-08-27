<?php
/*
Plugin Name: TTT Devices
Plugin URI: http://www.33themes.com
Description: Simple detectior device: mobile, tablet, richtCSS. Only -interface- base on http://www.mobileesp.com library. Insert device class in <body>
Version: 1.0
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

// via bit.ly/wpthemg-bodclass   
 
/**
 * Extends the body_class(); to include browser detection
 * Props to Thematic: http://wordpress.org/extend/themes/thematic
 */
 
function browser_body_class($classes) {
 
    // A little Browser detection shall we?
    $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
 
    // Mac, PC ...or Linux
    if ( preg_match( "/Mac/", $browser ) ){
        $classes[] = 'mac';
 
    } elseif ( preg_match( "/Windows/", $browser ) ){
        $classes[] = 'windows';
 
    } elseif ( preg_match( "/Linux/", $browser ) ) {
        $classes[] = 'linux';
 
    } else {
        $classes[] = 'unknown-os';
    }
 
    // Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
    if ( preg_match( "/Chrome/", $browser ) ) {
        $classes[] = 'chrome';
 
        preg_match( "/Chrome\/(\d.\d)/si", $browser, $matches);
        $classesh_version = 'ch' . str_replace( '.', '-', $matches[1] );
        $classes[] = $classesh_version;
 
        } elseif ( preg_match( "/Safari/", $browser ) ) {
            $classes[] = 'safari';
 
            preg_match( "/Version\/(\d.\d)/si", $browser, $matches);
            $sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
            $classes[] = $sf_version;
 
         } elseif ( preg_match( "/Opera/", $browser ) ) {
            $classes[] = 'opera';
 
            preg_match( "/Opera\/(\d.\d)/si", $browser, $matches);
            $op_version = 'op' . str_replace( '.', '-', $matches[1] );
            $classes[] = $op_version;
 
         } elseif ( preg_match( "/MSIE/", $browser ) ) {
            $classes[] = 'msie';
 
            if( preg_match( "/MSIE 6.0/", $browser ) ) {
                $classes[] = 'ie6';
            } elseif ( preg_match( "/MSIE 7.0/", $browser ) ){
                $classes[] = 'ie7';
            } elseif ( preg_match( "/MSIE 8.0/", $browser ) ){
                $classes[] = 'ie8';
            } elseif ( preg_match( "/MSIE 9.0/", $browser ) ){
                $classes[] = 'ie9';
            } elseif ( preg_match( "/MSIE 10.0/", $browser ) ){
                $classes[] = 'ie10';
            }
 
            } elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
                $classes[] = 'firefox';
 
                preg_match( "/Firefox\/(\d)/si", $browser, $matches);
                $ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
                $classes[] = $ff_version;
 
            } else {
                $classes[] = 'unknown-browser';
            }
	
		//add tttevent class to body if the post have an event
		$tttevents = new TTTEvents_Front();
		if ( $tttevents->get_events(array('p' => get_the_ID() )) )
			$classes[] = 'tttevent';


		if ( is_tttdevice('mobile') )
			$classes[] = 'mobile';
		elseif ( is_tttdevice('tablet') )
			$classes[] = 'tablet';
		elseif ( is_tttdevice('desktop') )
			$classes[] = 'desktop';
 
    return $classes;
}
 
add_filter('body_class','browser_body_class');
