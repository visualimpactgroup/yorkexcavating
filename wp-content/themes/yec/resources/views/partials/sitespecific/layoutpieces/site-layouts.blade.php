<?php
//  these are layout pieces designed specifically for the current site outside of the standard layout builder pieces.
// welcomeBlock
// navigationBlocks


//welcomeBlock
if($layoutType == 'welcomeBlock'){
  $title    = get_sub_field('welcome_block_title');
  $content  = get_sub_field('welcome_block');

  if($title != ''){
    $wbT .= '<div class="title">';
    $wbT .= '<h1>'.$title.'</h1>';
    $wbT .= '</div>';
  }

  //content
  if($content != ''){
    $wbC .= $content;
  }

  //buttons
  if( have_rows('welcome_block_buttons') ):
    $wbBtn 	  .= '<div class="button-block centered">';
    while ( have_rows('welcome_block_buttons') ) : the_row();
      $btn	   = get_sub_field('button');
      $button	.= '<a class="btn styled" href="'.$btn['url'].'" title="'.$btn['title'].'" target="'.$btn['target'].'">'.$btn['title'].$afterLinkIcon.'</a>';
    endwhile;
    $wbBtn	   .= $button;
    $wbBtn 	   .= '</div>';
  endif;

  $wB .= '<section class="welcome arrow-top layout-builder">';
  $wB .= '<div class="columns">';
  $wB .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen">&nbsp;</div>';
  $wB .= '<div class="column is-12-mobile is-12-tablet is-10-desktop is-10-widescreen">';
  $wB .= $wbT;
  $wB .= $wbC;
  $wB .= $wbBtn;
  $wB .= '</div>';
  $wB .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen">&nbsp;</div>';
  $wB .= '</div>';
  $wB .= '</section>';

  echo $wB;
}

//navigationBlocks
if($layoutType == 'navigationBlocks'){
  if(get_field('navigation_blocks')):
    $nB .= '<section class="welcome-bar">';
    $nB .= '<div class="columns is-multiline is-mobile is-fw">';
    $nB .= '<div class="column is-12">';
		$nB .= '<ul class="shortcuts">';
    while ( have_rows('navigation_blocks') ) : the_row();
			$postObject = get_sub_field('page_link');

			if($postObject){
				//$title = get_field('main_image', $car_object->ID);
				$title = get_the_title($postObject->ID);
				$link = get_the_permalink($postObject->ID);
				$titleOverride = get_sub_field('title_override');
				$oTitle = get_sub_field('title');

				//$o .= '<li style="background-image: url('.$image.');">';
				$nB .= '<li>';
				$nB .= '<a href="'.$link.'" title="'.$title.'">';
				$nB .= '<div class="content">';
				if($titleOverride == 'yes'){
					$nB .= '<h3>'.$oTitle.'</h3>';
				} else {
					$nB .= '<h3>'.$title.'</h3>';
				}
				$nB .= '</div>';
				$nB .= '<div class="shade"></div>';
				$nB .= '</a>';
				$nB .= '</li>';
			}

    endwhile;
		$nB .= '</ul>';
    $nB .= '</div>';
    $nB .= '</div>';
    $nB .= '</section>';

    echo $nB;
	 endif;
}


//SDS Sheets
if($layoutType == 'sdsSheets'){
  if(get_sub_field('sds_sheets')):
    $sds .= '<div class="columns leftalign layout-builder is-multiline is-mobile">';
    //
    while ( have_rows('sds_sheets') ) : the_row();
      $content = get_sub_field('content');
      //
      $sheet .= '<div class="column is-12">';
      $sheet .= '<p><strong>'.$content.'</strong></p>';
      if(get_sub_field('sheets')):
        $docs .= '<ul>';
        while ( have_rows('sheets') ) : the_row();
          $doc = get_sub_field('sheet');
          $file .= '<li><a href="'.$doc['url'].'" title="'.$doc['title'].'">'.$doc['title'].'</a></li>';
        endwhile;
        $docs .= $file;
        $docs .= '</ul>';
      endif;
      $sheet .= $docs;
      $sheet .= '<p>&nbsp;</p>';
      $sheet .= '</div>';
      //
    endwhile;
  //
  $sds .= $sheet;
  $sds .= '</div>';

  echo $sds;
  endif;
}
?>
