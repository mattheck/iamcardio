<?php
/*
Plugin Name: Disable autop
Plugin URI: http://ottodestruct.com/
Description: Disables the "wpautop" function for your posts, allowing you to use straight XHTML without it getting modified.
Author: Otto
Version: 1.0
Author URI: http://ottodestruct.com/
*/

remove_filter('the_content', 'wpautop');

?>