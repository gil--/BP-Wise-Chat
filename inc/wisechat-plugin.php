<?php
/*
Plugin Name: BuddyPress Wise Chat Integration
Version: 0.1
Description: Adds Wise Chat to BuddyPress Groups
Author: Gil Greenberg
Author URI: http://github.com/gil--
Text Domain: bp_wisechat
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// prevent problems during upgrade or when Groups are disabled
if ( !class_exists( 'BP_Group_Extension' ) ) { return; }

class BP_WiseChat_Group_Extension extends BP_Group_Extension {
    /**
     * Your __construct() method will contain configuration options for
     * your extension, and will pass them to parent::init()
     */
    function __construct() {
        $args =  array(
            'slug'     => 'chat',
            'name'   => 'Chat',
            'nav_item_position' => 31,
            'enable_create_step' => false,
        );
        parent::init( $args );
    }

    /**
     * display() contains the markup that will be displayed on the main
     * plugin tab
     */
    function display( $group_id = NULL ) {
        $group_id = bp_get_group_id();
        $chat_enabled = groups_get_groupmeta( $group_id, 'bp_wisechat_enable' );
        
        if($chat_enabled) {
            if (function_exists('wise_chat')) {
                wise_chat('bp-chat-' . $group_id); 
            }
        } else {
            _e('Chat is currently disabled.', 'bp_wisechat');
        }
    }

    /**
     * settings_screen() is the catch-all method for displaying the content 
     * of the edit, create, and Dashboard admin panels
     */
    function settings_screen( $group_id = NULL ) {
        $enabled = groups_get_groupmeta( $group_id, 'bp_wisechat_enable' );
 
        ?>
        <label><?php _e('Enable Chat', 'bp_wisechat'); ?></label>
        <input type="checkbox" tabindex="0" name="bp_wisechat_enable" <?php echo $enabled ? 'CHECKED': ''; ?>/>
        <?php
    }
 
    /**
     * settings_sceren_save() contains the catch-all logic for saving 
     * settings from the edit, create, and Dashboard admin panels
     */
    function settings_screen_save( $group_id = NULL ) {
        $enabled = '';
 
        if ( isset( $_POST['bp_wisechat_enable'] ) ) {
            $enabled = $_POST['bp_wisechat_enable'];
        }
 
        groups_update_groupmeta( $group_id, 'bp_wisechat_enable', $enabled );
    }
} // class ends

// register our class
bp_register_group_extension( 'BP_WiseChat_Group_Extension' );
