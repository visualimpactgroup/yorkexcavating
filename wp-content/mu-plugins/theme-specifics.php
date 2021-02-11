<?php
  /**
  *theme specifics
  **/
  //functions
  require_once(dirname(__FILE__) . '/theme-specifics/functions/filetypes.php');
  require_once(dirname(__FILE__) . '/theme-specifics/functions/custom-functions.php');
  //require_once(dirname(__FILE__) . '/theme-specifics/functions/woocommerce-functions.php');
  require_once(dirname(__FILE__) . '/theme-specifics/functions/portal-functions.php');
  require_once(dirname(__FILE__) . '/theme-specifics/functions/custom-image-sizes.php');

  //post types
  require_once(dirname(__FILE__) . '/theme-specifics/post-types/custom-post-types.php');

  //shortcodes
  require_once(dirname(__FILE__) . '/theme-specifics/shortcodes/blog-shortcodes.php');
  require_once(dirname(__FILE__) . '/theme-specifics/shortcodes/shortcodes.php');
  require_once(dirname(__FILE__) . '/theme-specifics/shortcodes/shortcodes-sitespecific.php');
  require_once(dirname(__FILE__) . '/theme-specifics/shortcodes/layout-builder.php');
  //require_once(dirname(__FILE__) . '/theme-specifics/shortcodes/calendar-shortcodes.php');
  //require_once(dirname(__FILE__) . '/theme-specifics/shortcodes/woocommerce-shortcodes.php');

  //enqueue
  require_once(dirname(__FILE__) . '/theme-specifics/enqueue/enqueue.php');
  //wp_register_script( 'youtube-api', '//www.youtube.com/iframe_api', array('main'), null, true );
?>
