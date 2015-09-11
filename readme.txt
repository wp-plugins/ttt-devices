# TTT Device

* Contributors: 33themes, gabrielperezs, lonchbox, tomasog, 11bits
* Tags: devices, mobile, user agents, media queries, body class, tablet, desktop, browser class, device, responsive, orientation, portrait, landscape
* Requires at least: 3.4
* Tested up to: 3.8.1
* Stable tag: 0.4
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

Improve your adaptive web design with detecting the devices that visit your website.


## Description

This plugin detects the client device in a simple way at php level.

### Identify the device with a CSS body class

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

* For an iphone mobile
`
<html>
<body class="mac safari mobile portrait">
</body>
</html>
`
* For an iphone mobile landscape
`
<html>
<body class="mac safari mobile landscape">
</body>
</html>
`

* For an android mobile
`
<html>
<body class="chrome linux mobile">
</body>
</html>
`

And also for IE ;)


### How to indentify the device

```
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
```

### How to remove the sidebar for mobile only
```
<?php
if ( ! is_tttdevice('mobile') ) {
	get_sidebar();
}
?>
```

This means, the sidebar will not show in mobile devices. This is not the same has "hidden" in CSS, with TTT Devices the code is not  sent to the client.

### Other keywords to detect devices
```
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
```

### Stop loading some js for mobile

It is very useful if you need make your site faster for mobile or tablet, these browsers can't handle well some javascript effects. You can stop loading them in mobile devices. Example:

In your functions.php file:

```
function heavyanimation_script() {
	if ( is_tttdevice('desktop') ) { 
	 	wp_enqueue_script( 'heavyanimation', get_template_directory_uri() . '/js/havyscript.js', array('jquery'));
	}
}	
add_action('wp_enqueue_scripts', 'heavyanimation_script');
```
This means that js only loads in desktop devices, easy :)


## Installation

This section describes how to install the plugin and get it working.

1. Upload `ttt-devices` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Frequently Asked Questions

**How does the plugin detecte devices?**

We use the user agent of the browser client.

**Does the plugin use some standar library?**

Yes, we use the sources from http://www.mobileesp.com 

For better performance with server cache systems like varnish the plugin detects the browser using Javascript. The idea came from this threat: http://stackoverflow.com/a/2401861
