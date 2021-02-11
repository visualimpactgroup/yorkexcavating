<?php
$sitePath							= get_field('site_path', 'options');
include($sitePath.'/resources/views/partials/career-queries/query-careers.php');

// header statements
$HeadershowDate     = 'false';
$HeadershowAuthor   = 'false';
$HeadershowCat      = 'false';
$Headerss           = 'false';
// header

$headerMeta = get_field('include_header_meta_settings', 'options');
$value      = get_field('header_meta_data_includes', 'options');

if($headerMeta == 'yes'){
  // meta
  $o .= $mdo;

  if(in_array('date', $value)){
    $HeadershowDate = 'true';
    if($HeadershowDate == 'true'){
      $o .= '<div class="data date">';
      // both
      $o .= '<div class="meta-icon">'.$dateIcon.'</div><div class="meta-text">Posted on '.get_the_date($postDate).'</div>';
      $o .= '</div>';
    }
  }

  if(in_array('author', $value)){
    $HeadershowAuthor = 'true';
    if($HeadershowAuthor == 'true'){
      $o .= $mda;
    }
  }

  if(in_array('categories', $value)){
    $HeadershowCat = 'true';
    if($HeadershowCat == 'true'){
      $o .= $mdcat;
    }
  }

  // if using social sharing
  if(in_array('ssharing', $value)){
    $Headerss = 'true';
    if($Headerss == 'true'){
      $o .= $ss;
    }
  }

  $o .= $mdc;
  // close meta data

  echo $o;
}
// Close Header
?>
