<?php include (TEMPLATEPATH . '/options.php'); ?>

<div id="sidebar-column" class="bpside">

<?php if ( is_active_sidebar( __('right-column', TEMPLATE_DOMAIN ) ) ) : ?>
<?php dynamic_sidebar( __('right-column', TEMPLATE_DOMAIN ) ); ?>
<?php endif; ?>


</div>