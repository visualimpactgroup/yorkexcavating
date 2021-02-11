<?php
// portal relations functions and shortcodes

// login/logout button for portal
function wp_userlogin( $redirect = '', $echo = true ) {
  global $current_user;
  wp_get_current_user();
  $userName     = $current_user->user_login;
  $displayName  = $current_user->display_name;
  //$mainLoginURL = esc_url( wp_login_url( $redirect ) );
  $mainLoginURL = '/login';
  $portalLogin  = '/login';

  if (!is_user_logged_in()) {
    $link = '<a href="' . $portalLogin . '" title="Login to Portal">' . __( 'Log in' ) . '</a>';
  } else {
    $link = 'Welcome '.$displayName.', <a href="' . esc_url( wp_logout_url( $mainLoginURL ) ) . '">' . __( 'Log out?' ) . '</a>';
  }

  if ( $echo ) {
    echo '<div class="admin-login-block">'. apply_filters( 'loginout', $link ) . '</div>';
  } else {
    return apply_filters( 'loginout', $link );
  }
}

function wp_username( $redirect = '', $echo = true ) {
  global $current_user;
  wp_get_current_user();
  $userName     = $current_user->user_login;
  $displayName  = $current_user->display_name;

  if ( is_user_logged_in() ) {
    $link = 'Welcome back, '.$displayName;
  }

  if ($echo) {
    echo '<div class="admin-block">'. apply_filters( 'loginout', $link ) . '</div>';
  } else {
    return apply_filters( 'loginout', $link );
  }
}

// portal dashboard icons and text in blocks
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
  if( $args->theme_location == 'Dashboard Navigation' ) {
  	// loop
  	foreach( $items as &$item ) {
  		// vars
  		$desc   = get_field('menu_description', $item);
      $icon   = get_field('menu_icon', $item);
      $ltitle = $item->title;

  		// append fields
  		if( $desc ) {
  			$item->title .= '<div class="description">'.$desc.'</div>';
  		} else {
        $item->title;
      }
  	}
  }

	// return
	return $items;
}


function portalList_shortcode(){
	//
  $calendarIco = get_field('calendar_icon', 'options');
  $downloadIco = get_field('download_icon', 'options');
  $photoIco    = get_field('photo_icon', 'options');
  $videoIco    = get_field('video_icon', 'options');
  $linkIco     = get_field('link_icon', 'options');
	$pageType    = get_field('page_type');
  // page type options:
  // resource
  // sections
  // news
  // calendar

	if($pageType == 'resources'){
		// resources
		if( have_rows('resources') ):
			$resources .= '<ul class="resources standard">';
	    while( have_rows('resources') ) : the_row();
        ////
        //document
        //link
        //photo
        //video
        //
        $resourceType     = get_sub_field('resource_type');
        $resourceTitle    = get_sub_field('resource_title');
        $resourceDate     = get_sub_field('resource_date');
        $resourceDateEnc  = '<div class="date">'.$calendarIco.$resourceDate.'</div>';
        $resourceDesc     = get_sub_field('resource_description');
        $resourceDocURL   = get_sub_field('document')['url'];
        $resourceLinkUrl  = get_sub_field('link');
        $resourcePhotoUrl = get_sub_field('photo')['url'];
        $resourcePhotoCap = get_sub_field('photo')['caption'];
        $resourceVidUrl   = get_sub_field('video');
        $download         = '<div class="block-link">'.$downloadIco.'<span>Download</span></div>';
        $viewPhoto        = '<div class="block-link">'.$photoIco.'<span>Download</span></div>';
        $viewVideo        = '<div class="block-link">'.$videoIco.'<span>View Video</span></div>';
        $viewlink         = '<div class="block-link">'.$linkIco.'<span>Download</span></div>';

        if($resourceType == 'document'){
          $resource .= '<li>';
          $resource .= '<a href="'.$resourceDocURL.'" target="_blank" title="Download '.$resourceTitle.'" download>';
          $resource .= '<div class="rtitle">'.$resourceTitle.'</div>';
          $resource .= $resourceDateEnc;
          $resource .= $resourceDesc;
          $resource .= $download;
          $resource .= '</a>';
          $resource .= '</li>';
        }

        if($resourceType == 'link'){
          $resource .= '<li>';
          $resource .= '<a href="'.$resourceLinkUrl.'" target="_blank" title="'.$resourceTitle.'">';
          $resource .= '<div class="rtitle">'.$resourceTitle.'</div>';
          $resource .= $resourceDateEnc;
          $resource .= $resourceDesc;
          $resource .= $viewlink;
          $resource .= '</a>';
          $resource .= '</li>';
        }

        if($resourceType == 'photo'){
          $resource .= '<li>';
          $resource .= '<a href="'.$resourcePhotoUrl.'" target="_blank" title="'.$resourceTitle.'" download>';
          $resource .= '<div class="rtitle">'.$resourceTitle.'</div>';
          $resource .= $resourceDateEnc;
          $resource .= $resourceDesc;
          $resource .= $viewPhoto;
          $resource .= '</a>';
          $resource .= '</li>';
        }

        if($resourceType == 'video'){
          $resource .= '<li>';
          $resource .= '<a data-fancybox href="'.$resourceVidUrl.'" title="'.$resourceTitle.'">';
          $resource .= '<div class="rtitle">'.$resourceTitle.'</div>';
          $resource .= $resourceDateEnc;
          $resource .= $resourceDesc;
          $resource .= $viewVideo;
          $resource .= '</a>';
          $resource .= '</li>';
        }
      endwhile;
      $resources .= $resource;
			$resources .= '</ul>';
		endif;

		$section .= $resources;
  } elseif($pageType == 'news'){
    // news articles
    if( have_rows('news_articles') ):
      $news .= '<ul class="resources news-articles">';
      while( have_rows('news_articles') ) : the_row();
        ////
        $newsTitle    = get_sub_field('news_title');
        $newsDate     = get_sub_field('news_date');
        $newsDateEnc  = '<div class="date">'.$calendarIco.$newsDate.'</div>';
        $newsAuthor   = get_sub_field('news_author');
        $newsAuthEnc  = '<div class="author">'.$newsAuthor.'</div>';
        $newsDesc     = get_sub_field('news_content');
        $includeGal   = get_sub_field('include_gallery');
        $newsGallery  = get_sub_field('news_gallery');

        $news .= '<li>';
        $news .= '<div class="rtitle">'.$newsTitle.'</div>';
        if($newsDate != ''){
          $news .= $newsDateEnc;
        }

        if($newsAuthor != ''){
          $news .= $newsAuthor;
        }
        $news .= $newsDesc;

        $images           = get_sub_field('news_gallery');
        if($images):
          $imageGallery  .= '<div class="article-gallery">';
          $imageGallery  .= '<ul class="gallery">';
          foreach( $images as $image ):
            $galImg      .= '<li>';
            $galImg      .= '<a data-fancybox="images" data-caption="'.$image['caption'].'" href="'.$image['url'].'">';
            $galImg      .= '<img src="'.$image['sizes']['gal-image'].'"></li>';
            $galImg      .= '</a>';
            $galImg      .= '</li>';
          endforeach;
          $gallery       .= $galImg;
          $gallery       .= '</ul>';
          $gallery       .= '</div>';
        endif;
        $imageGallery .= $gallery;
        $imageGallery .= '</li>';
        $articles .= $imageGallery;
        $articles .= '</ul>';

      endwhile;
      $news .= $articles;
    endif;
    $section .= $news;
	} else {
		// sections
		if( have_rows('sections') ):
			//
	    while( have_rows('sections') ) : the_row();
				$sectionresourceTitle = get_sub_field('section_resource_title');
        $sectionresourceDate = get_sub_field('section_resource_date');
				//
				$sections .= '<div class="section-block">';
				$sections .= '<h3>'.$sectionresourceTitle.'</h3>';
				if( have_rows('section_resources') ):
					$sections .= '<ul class="resources">';
					while( have_rows('section_resources') ) : the_row();
            ////
            //document
            //link
            //photo
            //video
            //
            $secresourceType     = get_sub_field('section_resource_type');
            $secresourceTitle    = get_sub_field('section_resource_title');
            $secresourceDate     = get_sub_field('section_resource_date');
            $secresourceDesc     = get_sub_field('section_resource_description');
            $secresourceDocURL   = get_sub_field('section_document')['url'];
            $secresourceDocTit   = get_sub_field('section_document')['title'];
            $secresourceLinkUrl  = get_sub_field('section_link')['url'];
            $secresourceLinkTit  = get_sub_field('section_link')['title'];
            $secresourcePhotoUrl = get_sub_field('section_photo')['url'];
            $secresourcePhotoCap = get_sub_field('section_photo')['caption'];
            $secresourceVidUrl   = get_sub_field('section_video')['url'];
            $secresourceVidTitle = get_sub_field('section_video')['title'];

            if($secresourceType == 'document'){
              $sec .= '<li><a href="'.$secresourceDocURL.'" target="_blank" title="Download '.$secresourceDocTit.'">'.$secresourceDocTit.'</a></li>';
            }

            if($secresourceType == 'link'){
              $sec .= '<li><a href="'.$secresourceLinkUrl.'" target="_blank" title="'.$secresourceLinkTit.'">'.$secresourceLinkTit.'</a></li>';
            }

            if($secresourceType == 'photo'){
              $sec .= '<li><a href="'.$secresourcePhotoUrl.'" target="_blank" title="'.$secresourcePhotoUrl.'">';
              if($secresourcePhotoCap != ''){
                $sec .= $secresourcePhotoCap;
              } else {
                $sec .= $secresourcePhotoUrl;
              }
              $sec .= '</a></li>';
            }

            if($secresourceType == 'video'){
              $sec  .= '<li><a href="'.$secresourceVidUrl.'" title="'.$secresourceVidTitle.'">'.$secresourceVidTitle.'</a></li>';
            }
					endwhile;
          $section  .= $sec;
					$sections .= '</ul>';
				endif;
				$sections   .= '</div>';
			endwhile;
		endif;

    $section .= $sections;
	}

	return $section;

}
add_shortcode('portalList', 'portalList_shortcode');
?>
