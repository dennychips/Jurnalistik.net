<?php
require_once('../../../wp-config.php');
require_once( dirname(__FILE__) . '/functions.php');

header("Content-type: text/css");

global $options;
foreach ($options as $value) {
if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); } }
// wp theme option
?>



<?php if($tn_buddyfun_adminbar_bg_color != "") { ?>
div#wp-admin-bar {
background: <?php echo $tn_buddyfun_adminbar_bg_color; ?> none !important;
}
<?php } ?>

<?php if($tn_buddyfun_adminbar_hover_bg_color != "") { ?>
div#wp-admin-bar ul.main-nav li:hover, div#wp-admin-bar ul.main-nav li.sfhover, div#wp-admin-bar ul.main-nav li ul li.sfhover {
	background: <?php echo $tn_buddyfun_adminbar_hover_bg_color; ?> none !important;
}
<?php } ?>