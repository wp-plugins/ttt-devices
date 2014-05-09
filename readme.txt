=== TTT Device ===
Contributors: 33themes, gabrielperezs, lonchbox, tomasog
Tags: devices, mobile, user agents, media queries, body class, tablet, desktop, browser class, device, responsive, orientation, portrait, landscape
Requires at least: 3.4
Tested up to: 3.8.1
Stable tag: 0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Custom device performance.

Make your Responsive Design better. Beyond CSS @media Queries.


== Description ==

Simple way to detect the client device at php level.

= Identify the device with a CSS body class =

* For a desktop in linux
`
<html>
<body class="linux chrome desktop">
</body>
</html>
`

* For a desktop in Mac
`
<html>
<body class="mac firefox desktop">
</body>
</html>
`

* For a iphone mobile
`
<html>
<body class="mac safari mobile portrait">
</body>
</html>
`
* For a iphone mobile landscape
`
<html>
<body class="mac safari mobile landscape">
</body>
</html>
`

* For a android mobile
`
<html>
<body class="chrome linux mobile">
</body>
</html>
`

And also some for IE ;)


= How to indentify the device =

`
<?php
if ( is_tttdevice('desktop') ) {
	echo "this is a desktop device";
}
elseif ( is_tttdevice('mobile') ) {
	echo "this is a mobile device";
}
elseif ( is_tttdevice('tablet') ) {
	echo "this is a tablet device";
}
else {
	echo "Opps...  we don't know what this device is!!";
}
?>
`

= How to remove the sidebar for mobile only =
`
<?php
if ( ! is_tttdevice('mobile') ) {
	get_sidebar();
}
?>
`

This means, the sidebar will not -print- for mobile divices. This is not the same has "hidden" in CSS.

= Other keyword to dettect devices =
`
<?php
if ( is_tttdevice('iphone') ) {
	echo "this is an iPhone";
}
if ( is_tttdevice('android') ) {
	echo "this is an android";
}
if ( is_tttdevice('windowsphone') ) {
	echo "this is an windows phone";
}
if ( is_tttdevice('mobile') ) {
	echo "this is a mobile";
}
?>
`

= Stop loading some js for mobile =

Is very usefull if you need to make your site faster for mobile or tablet, this browsers can handle well some javascripts effects. You can stop remove them from a device like this. Example:

In your functions.php file:

`
function heavyanimation_script() {
	if ( is_tttdevice('desktop') ) { 
	 	wp_enqueue_script( 'heavyanimation', get_template_directory_uri() . '/js/havyscript.js', array('jquery'));
	}
}	
add_action('wp_enqueue_scripts', 'heavyanimation_script');
`
This means that js only load in desktop devices, easy :)


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `ttt-devices` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How the plugin detected devices? =

We use the user agent of the browser client.

= Use some standar library? =

Yes, we use the sources from http://www.mobileesp.com 

For better performance with server cache systems like varnish the plugin detect the browser using Javascript. The idea came from this threat: http://stackoverflow.com/a/2401861
