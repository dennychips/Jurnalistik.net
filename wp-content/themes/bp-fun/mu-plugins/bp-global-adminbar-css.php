<?php

function buddypress_global_adminbar_css() {
// only work for wpmudev buddypress theme with theme options
global $current_site, $blog_id; ?>

<?php // save site options
if($blog_id == BP_ROOT_BLOG) {
$active_themename = get_option('template');
$check_if_theme_save = get_site_option('blog_1_active_theme');
if($check_if_theme_save == '') {
add_site_option('blog_1_active_theme', $active_themename);
} else {
update_site_option('blog_1_active_theme', $active_themename);
}
}
?>

<?php $main_blog_active_theme = get_site_option('blog_1_active_theme'); // styling global started here ?>
<link rel="stylesheet" href="http://<?php echo $current_site->domain . $current_site->path . 'wp-content/themes/' . $main_blog_active_theme .'/global-adminbar.php'; ?>" type="text/css" media="screen" />
<?php }

add_action('wp_head', 'buddypress_global_adminbar_css'); // init global wp_head
add_action('admin_head', 'buddypress_global_adminbar_css'); // init global admin_head

?>