<?php
global $bp;
$privacy_enable = get_option('tn_buddyfun_privacy_status');
$disable_community_dropdown = get_option('tn_buddyfun_community_dropdown');

if( BP_ENABLE_MULTIBLOG == 1 ) {
$current_siteurl = site_url() . '/';
} else {
if(function_exists('get_current_site')) {
$current_site = get_current_site();
$current_siteurl = 'http://' . $current_site->domain . $current_site->path;
} else {
$current_siteurl = site_url() . '/';
}
}
?>


<li<?php if ( is_front_page() ) : ?> class="selected"<?php endif; ?>><a href="<?php echo $current_siteurl; ?>" title="<?php _e( 'Home', TEMPLATE_DOMAIN ) ?>">
<?php _e( 'Home', TEMPLATE_DOMAIN ) ?></a></li>

<?php if ( 'activity' != bp_dtheme_page_on_front() && bp_is_active( 'activity' ) ) : ?>
<li<?php if ( bp_is_page( BP_ACTIVITY_SLUG ) ) : ?> class="selected"<?php endif; ?>>
<a href="<?php echo $current_siteurl; ?><?php echo BP_ACTIVITY_SLUG ?>/" title="<?php _e( 'Activity', TEMPLATE_DOMAIN ) ?>"><?php _e( 'Activity', TEMPLATE_DOMAIN ) ?></a>
</li><?php endif; ?>


<?php if($disable_community_dropdown != 'disable' || $disable_community_dropdown == '') { ?>
<li<?php if (  bp_is_page( BP_BLOGS_SLUG ) || bp_is_page( BP_FORUMS_SLUG ) || bp_is_page( BP_MEMBERS_SLUG ) || bp_is_member() || bp_is_page( BP_GROUPS_SLUG ) || bp_is_group()) : ?> class="selected"<?php endif; ?>><a href="#"><?php _e('Community', TEMPLATE_DOMAIN); ?></a><ul><?php } ?>
<?php if($privacy_enable == 'enable') { ?>
<?php if (is_user_logged_in() ) { ?>
<li<?php if ( bp_is_page( BP_MEMBERS_SLUG ) || bp_is_member() ) : ?> class="selected"<?php endif; ?>><a href="<?php echo $current_siteurl; ?><?php echo BP_MEMBERS_SLUG ?>" title="<?php _e( 'Members', TEMPLATE_DOMAIN ) ?>"><?php _e( 'Members', TEMPLATE_DOMAIN ) ?></a></li>
<?php } ?>
<?php } else { ?>
<li<?php if ( bp_is_page( BP_MEMBERS_SLUG ) || bp_is_member() ) : ?> class="selected"<?php endif; ?>><a href="<?php echo $current_siteurl; ?><?php echo BP_MEMBERS_SLUG ?>" title="<?php _e( 'Members', TEMPLATE_DOMAIN ) ?>"><?php _e( 'Members',TEMPLATE_DOMAIN ) ?></a></li>
<?php } ?>


<?php if ( bp_is_active( 'groups' ) ) : ?>
<li<?php if ( bp_is_page( BP_GROUPS_SLUG ) || bp_is_group() ) : ?> class="selected"<?php endif; ?>>
<a href="<?php echo $current_siteurl; ?><?php echo BP_GROUPS_SLUG ?>/" title="<?php _e( 'Groups', TEMPLATE_DOMAIN ) ?>"><?php _e( 'Groups', TEMPLATE_DOMAIN ) ?></a>
</li>
<?php if (bp_is_active( 'forums' ) && ( function_exists( 'bp_forums_is_installed_correctly' ) && !(int) get_site_option('bp-disable-forum-directory' )) && bp_forums_is_installed_correctly()) : ?>
<li<?php if ( bp_is_page( BP_FORUMS_SLUG ) ) : ?> class="selected"<?php endif; ?>>
<a href="<?php echo $current_siteurl; ?><?php echo BP_FORUMS_SLUG ?>/" title="<?php _e( 'Forums', TEMPLATE_DOMAIN ) ?>"><?php _e( 'Forums', TEMPLATE_DOMAIN ) ?></a>
</li>
<?php endif; ?>
<?php endif; ?>


<?php if ( function_exists( 'bp_core_is_multisite') )  : ?>
<?php if ( function_exists( 'bp_blogs_install' ) && bp_core_is_multisite() ) : ?>
<li<?php if ( bp_is_page( BP_BLOGS_SLUG ) ) : ?> class="selected"<?php endif; ?>>
<a href="<?php echo $current_siteurl; ?><?php echo BP_BLOGS_SLUG ?>/" title="<?php _e( 'Blogs', TEMPLATE_DOMAIN ) ?>"><?php _e( 'Blogs', TEMPLATE_DOMAIN ) ?></a>
</li>
<?php endif; ?>
<?php endif; ?>

<?php if($disable_community_dropdown != 'disable' || $disable_community_dropdown == '') { ?></ul></li><?php } ?>

<?php do_action( 'bp_nav_items' ); ?>