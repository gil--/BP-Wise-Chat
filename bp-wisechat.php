<?php
/*
Plugin Name: BuddyPress Wise Chat Integration
Version: 0.1
Description: Adds Wise Chat to BuddyPress Groups
Author: Gil Greenberg
Author URI: http://github.com/gil--
Text Domain: bp_wisechat
*/

// Define a constant that we can use to construct file paths throughout the component
define( 'BPWC_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'BPWC_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/* Only load code that needs BuddyPress to run once BP is loaded and initialized. */
function bp_wisechat_init() {
    include(  BPWC_PLUGIN_DIR . '/inc/wisechat-plugin.php' );
}
add_action( 'bp_include', 'bp_wisechat_init' );