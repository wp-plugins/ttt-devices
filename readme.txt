=== TTT Device ===
Contributors: 33themes, gabrielperezs, lonchbox
Tags: devices, mobile
Requires at least: 3.4
Tested up to: 3.6
Stable tag: 0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Description: Simple way to detect the client device at php level.


== Description ==

Simple way to detect the client device at php level.

= Identify the device with a CSS body class =

Based on http://wordpress.org/extend/themes/thematic

We add a "body_class" filter with the device information:

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
<body class="mac safari mobile">
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

And also some for IE, nobody worried about it... ;)


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
	echo "this is an iPhone";
}
if ( is_tttdevice('windowsphone') ) {
	echo "this is an iPhone";
}
if ( is_tttdevice('mobile') ) {
	echo "this is a mobile";
}
?>
`



== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How the plugin detected devices? =

We use the user agent of the browser client.

= Use some standar library? =

Yes, we use the sources from http://www.mobileesp.com 
