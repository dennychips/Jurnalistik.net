<?php

define ( 'BP_GROUP_LIVECHAT_IS_INSTALLED', 1 );
define ( 'BP_GROUP_LIVECHAT_VERSION', '1.0' );
define ( 'BP_GROUP_LIVECHAT_DB_VERSION', '1.3' );
if ( !defined( 'BP_GROUP_LIVECHAT_SLUG' ) )
	define ( 'BP_GROUP_LIVECHAT_SLUG', 'live-chat' );

require( dirname( __FILE__ ) . '/bp-group-livechat-db-functions.php' );


if ( file_exists( dirname( __FILE__ ) . '/languages/' . get_locale() . '.mo' ) )
	load_textdomain( 'bp-group-livechat', dirname( __FILE__ ) . '/bp-group-livechat/languages/' . get_locale() . '.mo' );

/**
 * bp_group_livechat_setup_globals()
 *
 * Sets up global variables for your component.
 */
function bp_group_livechat_setup_globals() {
	global $bp, $wpdb;

	/* For internal identification */
	$bp->livechat->id = 'livechat';

	$bp->livechat->table_name = $wpdb->base_prefix . 'bp_group_livechat';
	$bp->livechat->format_notification_function = 'bp_group_livechat_format_notifications';
	$bp->livechat->slug = BP_GROUP_LIVECHAT_SLUG;

	/* Register this in the active components array */
	$bp->active_components[$bp->livechat->slug] = $bp->livechat->id;
}
add_action( 'bp_setup_globals', 'bp_group_livechat_setup_globals' );


class BP_Group_Livechat extends BP_Group_Extension {	

	function bp_group_livechat() {
		global $bp;
		
		$this->name = 'Live Chat';
		$this->slug = 'live-chat';

		$this->create_step_position = 16;
		$this->nav_item_position = 31;
		
		if ( groups_get_groupmeta( $bp->groups->current_group->id, 'bp_group_livechat_enabled' ) == '1' ) {
			$this->enable_nav_item = true;
		} else {
			$this->enable_nav_item = false;
		}		
				
	}	
	
	function create_screen() {
		global $bp;
		
		if ( !bp_is_group_creation_step( $this->slug ) )
			return false;
			
		wp_nonce_field( 'groups_create_save_' . $this->slug );
		?>
		<input type="checkbox" name="bp_group_livechat_enabled" id="bp_group_livechat_enabled" value="1"  
			<?php 
			if ( groups_get_groupmeta( $bp->groups->current_group->id, 'bp_group_livechat_enabled' ) == '1' ) {
				echo 'checked=1';
			}
			?>
		/>
		Enable Group Livechat
		<hr>
		<?php
	}

	function create_screen_save() {
		global $bp;
		
		check_admin_referer( 'groups_create_save_' . $this->slug );	
		
		if ( $_POST['bp_group_livechat_enabled'] == 1 ) {
			groups_update_groupmeta( $bp->groups->current_group->id, 'bp_group_livechat_enabled', 1 );
		}
	}

	function edit_screen() {
		global $bp;
		
		if ( !groups_is_user_admin( $bp->loggedin_user->id, $bp->groups->current_group->id ) ) {
			return false;
		}
		
		if ( !bp_is_group_admin_screen( $this->slug ) )
			return false;
			
		wp_nonce_field( 'groups_edit_save_' . $this->slug );
		?>
		<input type="checkbox" name="bp_group_livechat_enabled" id="bp_group_livechat_enabled" value="1"  
			<?php 
			if ( groups_get_groupmeta( $bp->groups->current_group->id, 'bp_group_livechat_enabled' ) == '1' ) {
				echo 'checked=1';
			}
			?>
		/>
		Enable Group Livechat
		<hr>
		<input type="submit" name="save" value="Save" />
		<?php
	}

	function edit_screen_save() {
		global $bp;

		if ( !isset( $_POST['save'] ) )
			return false;

		check_admin_referer( 'groups_edit_save_' . $this->slug );
		
		if ( $_POST['bp_group_livechat_enabled'] == 1 ) {
			groups_update_groupmeta( $bp->groups->current_group->id, 'bp_group_livechat_enabled', 1 );
		} else {
			groups_update_groupmeta( $bp->groups->current_group->id, 'bp_group_livechat_enabled', 0 );
		}
		
		bp_core_add_message( __( 'Settings saved successfully', 'buddypress' ) );
		
		bp_core_redirect( bp_get_group_permalink( $bp->groups->current_group ) . 'admin/' . $this->slug );

	}

	function display() {
		global $bp;
		
		if ( groups_is_user_member( $bp->loggedin_user->id, $bp->groups->current_group->id )
			 || groups_is_user_mod( $bp->loggedin_user->id, $bp->groups->current_group->id ) 
			 || groups_is_user_admin( $bp->loggedin_user->id, $bp->groups->current_group->id )
			 || is_super_admin() ) {
			
			$livechat_display = true;
			require( dirname( __FILE__ ) . '/bp-group-livechat-display.php' );
		} else {
			echo '<div id="message" class="error"><p>This content is only available to group members.</p></div>';
		}
	}

	function widget_display() { 
		// Not used
	}
}
bp_register_group_extension( 'BP_Group_Livechat' );
?>