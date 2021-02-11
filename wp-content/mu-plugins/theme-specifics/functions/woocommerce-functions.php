<?php
//////////
//WOO FUNCTIONS
//

// Hide Product Data Tabs in Admin
function remove_linked_products($tabs){
  unset($tabs['general']);
  unset($tabs['inventory']);
  unset($tabs['shipping']);
  unset($tabs['linked_product']);
  unset($tabs['attribute']);
  unset($tabs['advanced']);
  return($tabs);
}

add_filter('woocommerce_product_data_tabs', 'remove_linked_products', 10, 1);

// Hide Product Data block
function remove_product_data(){
  remove_meta_box( 'woocommerce-product-data',  'product', 'normal');
}
add_action( 'add_meta_boxes' , 'remove_product_data', 40 );

// Hide Product Short Description
function remove_short_description() {
  remove_meta_box( 'postexcerpt', 'product', 'normal');
}
add_action('add_meta_boxes', 'remove_short_description', 999);

// Hide Product tags page
function misha_hide_product_tags_admin_menu() {
	remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product' );
}
add_action( 'admin_menu', 'misha_hide_product_tags_admin_menu', 9999 );

// Hide Products tag box
function misha_hide_product_tags_metabox() {
	remove_meta_box( 'tagsdiv-product_tag', 'product', 'side' );
}
add_action( 'admin_menu', 'misha_hide_product_tags_metabox' );

// Hide Product Gallery meta box
function remove_my_meta_boxes(){
  remove_meta_box( 'woocommerce-product-images',  'product', 'side');
}
add_action( 'add_meta_boxes' , 'remove_my_meta_boxes', 40 );
?>
