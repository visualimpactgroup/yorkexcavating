<?php
function custom_scripts() {
  $propertyID = get_field('share_this', 'options');
  wp_enqueue_style( 'icon-library', 'https://s3.amazonaws.com/icomoon.io/141886/VIGIconLibrary/style.css?4nbdqe', array(), '1.0', 'all');
  wp_enqueue_script('share-this', '//platform-api.sharethis.com/js/sharethis.js#property='.$propertyID.'&product=inline-share-buttons');
  wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDgyhJOU67jM3wK8gbi-0BtAfhFTQUhc0c', true);
  wp_enqueue_script('google-map', get_template_directory_uri() .'/assets/scripts/routes/google-maps.js', array(), '1.9.4', true);
  //wp_enqueue_script('fixed-header', get_template_directory_uri() .'/assets/scripts/routes/header-fixed.js', array(), '2016.10.8', true);
  wp_enqueue_script('youtube-api', '//www.youtube.com/iframe_api');
  wp_enqueue_style( 'site-overrides', get_template_directory_uri() .'/overrides.css');
}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );

function custom_admin_scripts() {
  wp_enqueue_style( 'site-overrides-admin', get_template_directory_uri() .'/overrides.css');
}
add_action( 'admin_enqueue_scripts', 'custom_admin_scripts' );

?>
