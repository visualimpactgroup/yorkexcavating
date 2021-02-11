<?php
$id 						= get_the_id();
$feed_display		= get_field('feed_meta_data_display_settings', 'options');
$authorType			= get_field('author_type', 'options');
$authorIcon			= get_field('author_icon', 'options');
$authorText			= get_field('author_text', 'options');
$dateType				= get_field('date_type', 'options');
$dateIcon				= get_field('date_icon', 'options');
$dateText				= get_field('date_text', 'options');
$catType				= get_field('category_type', 'options');
$catIcon				= get_field('category_icon', 'options');
$catText				= get_field('category_text', 'options');
$excerptMore    = get_field('excerpt_link_text', 'options');
$postAuthor			= get_the_author('post_author');
$excerpt			  = get_the_excerpt(false, false);
$dateFormat     = get_field('date_format', 'options');
$moreLinkAfter  = get_field('more_link_after', 'options');

//determine date format
if($dateFormat == 'FjY'){
  // January 1, 2020
  $postDate			= 'F j, Y';
}

if($dateFormat == 'MjY'){
  // Jan 1, 2020
  $postDate			= 'M j, Y';
}

if($dateFormat == 'sdyu'){
  // 01/01/2020
  $postDate			= 'm/d/Y';
}

if($dateFormat == 'mdy'){
  // 01.01.20
  $postDate			= 'm.d.y';
}

if($dateFormat == 'sdy'){
  // 01/01/20
  $postDate			= 'm/d/y';
}

if($dateFormat == 'his'){
  // 01-01-20
  $postDate			= 'm-d-y';
}

// meta-data
$mdo .= '<div class="entry-meta">';
$mdc .= '</div>';

  // meta-data - Date
  if (( in_array( 'date', get_field('feed_meta_data_display_settings', 'options') ))) {
    //) || ($dateFound == 'true')
    $mdd .= '<div class="data date">';
    // icon only
    if($dateType == 'icon'){
      $mdd .= '<div class="meta-icon">'.$dateIcon.' '.$postDate.'</div>';
    }
    // text only
    if($dateType == 'text'){
      $mdd .= '<div class="meta-text">'.$dateText.' '.$postDate.'</div>';
    }
    // both
    if($dateType == 'both'){
      $mdd .= '<div class="meta-icon">'.$dateIcon.'</div><div class="meta-text">'.$dateText.' '.$postDate.'</div>';
    }
    $mdd .= '</div>';
  }

  // meta-data - Author
  if ( in_array( 'author', get_field('feed_meta_data_display_settings', 'options') ) ) {
    $mda .= '<div class="data author">';
    // icon only
    if($authorType == 'icon'){
      $mda .= '<div class="meta-icon">'.$authorIcon.' '.$postAuthor.'</div>';
    }
    // text only
    if($authorType == 'text'){
      $mda .= '<div class="meta-text">'.$authorText.' '.$postAuthor.'</div>';
    }
    // both
    if($authorType == 'both'){
      $mda .= '<div class="meta-icon">'.$authorIcon.'</div><div class="meta-text">'.$authorText.' '.$postAuthor.'</div>';
    }
    $mda .= '</div>';
  }

  // meta-data - Categories
  if ( in_array( 'categories', get_field('feed_meta_data_display_settings', 'options') ) ) {
    $mdcat .= '<div class="data categories">';
    // icon only
    if($catType == 'icon'){
      $mdcat .= '<div class="meta-icon">'.$catIcon.' '.$categories.'</div>';
    }
    // text only
    if($catType == 'text'){
      $mdcat .= '<div class="meta-text">'.$catText.' '.$categories.'</div>';
    }
    // both
    if($catType == 'both'){
      $mdcat .= '<div class="meta-icon">'.$catIcon.'</div><div class="meta-text">'.$catText.' '.$categories.'</div>';
    }
    $mdcat .= '</div>';
  }

  // meta-data - social sharing
  if ( in_array( 'ssharing', get_field('feed_meta_data_display_settings', 'options') ) ) {
    $ss .= '<div class="social-sharing">';
    $ss .= '<span class="title">Share Posting</span>';
    $ss .= do_shortcode('[socialSharing]');
    $ss .= '</div>';
  }


//
?>
