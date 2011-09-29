<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>
<?php include (TEMPLATEPATH . '/options.php');
if($bp_existed == 'true') { ?>
<?php bp_page_title(); ?>
<?php } else { ?>
<?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?>
<?php } ?>
</title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php if( is_rtl() ): ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_inc/css/rtl.css" type="text/css" media="all" />
<?php endif; ?>

<?php if(function_exists('font_show')) { font_show(); } ?>

<?php
$get_current_scheme = get_option('tn_buddyfun_custom_style');
?>

<?php
if(($get_current_scheme == '') || ($get_current_scheme == 'default.css')) { ?>

<!-- start theme options sync - using php to fetch theme option are deprecated and replace with style sync -->
<?php print "<style type='text/css' media='screen'>"; ?>
<?php include (TEMPLATEPATH . '/theme-options.php'); ?>
<?php print "</style>"; ?>
<!-- end theme options sync -->
<?php } else { ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_inc/preset-styles/<?php echo $get_current_scheme; ?>" type="text/css" media="all" />
<!-- start theme options sync - using php to fetch theme option are deprecated and replace with style sync -->
<?php print "<style type='text/css' media='screen'>"; ?>
<?php include (TEMPLATEPATH . '/theme-options-exclude.php'); ?>
<?php print "</style>"; ?>
<!-- end theme options sync -->
<?php }
?>


<?php if(!function_exists( 'bp_exists' )) { ?>
<?php print "<style type='text/css' media='screen'>"; ?>
body { padding: 0px !important; margin: 0px !important; }
body.transparent_widget { color:#FFFFFF !important; }     
<?php print "</style>"; ?>
<?php } ?>


<?php if($bp_existed == 'true') { ?>
<?php if ( function_exists( 'bp_sitewide_activity_feed_link' ) ) : ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php _e('Site Wide Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_sitewide_activity_feed_link() ?>" />
<?php endif; ?>
<?php if ( function_exists( 'bp_member_activity_feed_link' ) && bp_is_member() ) : ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php bp_displayed_user_fullname() ?> | <?php _e( 'Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_member_activity_feed_link() ?>" />
<?php endif; ?>
<?php if ( function_exists( 'bp_group_activity_feed_link' ) && bp_is_group() ) : ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php bp_current_group_name() ?> | <?php _e( 'Group Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_group_activity_feed_link() ?>" />
<?php endif; ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />
<?php } ?>

<!-- automatic-feed-links in functions.php -->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- favicon.ico location -->
<?php if(file_exists( WP_CONTENT_DIR . '/favicon.ico')) { //put your favicon.ico inside wp-content/ ?>
<link rel="icon" href="<?php echo WP_CONTENT_URL; ?>/favicon.ico" type="images/x-icon" />
<?php } elseif(file_exists( TEMPLATEPATH . '/favicon.ico')) { ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="images/x-icon" />
<?php } ?>


<!--[if IE 6]>
<style type="text/css">
#sidebar-column .widgettitle, #top-header .navigation {
background: <?php if($tn_buddyfun_nav_bg_color == ""){ ?><?php echo "#204C6E"; } else { ?><?php echo $tn_buddyfun_nav_bg_color; ?><?php } ?> none !important;
}
</style>
<![endif]-->


<!-- lets use js from google -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/_inc/js/drop_down.js"></script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<?php if(is_front_page() || is_home()) { ?>
<?php $home_featured_block_style = get_option('tn_buddyfun_home_featured_block_style');
if($home_featured_block_style == 'slideshow') { ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/_inc/js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
jQuery.noConflict();
var $je = jQuery;
 $je(window).load(function() {
        $je('#slider').nivoSlider();
    });
</script>
<?php } ?>
<?php } ?>

</head>

<body <?php body_class() ?> id="custom">

<div id="wrapper"<?php if($bp_existed == 'true') { ?><?php if ( $bp_front_is_activity == "true" )  { ?> class="activity_on_front<?php if(is_front_page() || !bp_current_component()) { ?> directory<?php } ?>"<?php } else { ?> class="activity_not_front"<?php } ?><?php } ?>>

<?php do_action( 'bp_before_container' ) ?>

<div id="container">

<div id="top-header">

<div class="top-h">
<div class="site-title">
<?php
if($tn_buddyfun_header_logo == '') { ?>
<h1><a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a></h1>
<p><?php bloginfo('description'); ?></p>
<?php } else { ?>
<a href="<?php echo site_url(); ?>" title="<?php _e('Click here to go to the site homepage', TEMPLATE_DOMAIN); ?>">
<img src="<?php echo stripslashes($tn_buddyfun_header_logo); ?>" alt="<?php _e('homepage', TEMPLATE_DOMAIN); ?>" /></a>
<?php } ?>
</div>

<div class="header-nav">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul class="pagenav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='top-nav', $get_default_menu=''); ?>
</ul>
<?php } ?>
</div>

</div>


<div class="navigation">
<?php wp_nav_menu();?>

</div>

</div>

<?php do_action( 'bp_before_header' ) ?>

<?php
$tn_buddyfun_header_on = get_option('tn_buddyfun_header_on');
if('' != get_header_image() ) {
if($tn_buddyfun_header_on == 'enable'){ ?>
<div id="header">
<div class="custom-img-header"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></div>
</div>
<?php } } ?>

<?php do_action( 'bp_after_header' ) ?>


<?php
$tn_buddyfun_call_signup_on = get_option('tn_buddyfun_call_signup_on');
if($tn_buddyfun_call_signup_on != ""){ ?>
<?php } else { ?>
<?php locate_template ( array( 'lib/templates/wp-template/call-signup.php' ), true ); ?>
<?php } ?>

<?php do_action( 'bp_before_content' ) ?>

<div class="content">