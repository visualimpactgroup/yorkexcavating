<?php
// *****
// Page Shortcode - Calendar Sidebar Block of 5 Events
// *****
function calendarSidebarBlock_shortcode(){
	$sitePath							= get_field('site_path', 'options');
	include($sitePath.'/resources/views/partials/blog-queries/query-blogmeta.php');

	$args = array(
	  'post_status' 		   => 'publish',
	  'post_type' 			   => array(TribeEvents::POSTTYPE),
	  'posts_per_page'	   => 5,
	  //order by startdate from newest to oldest
	  'meta_key'					 => '_EventStartDate',
	  'orderby'						 => '_EventStartDate',
		'meta_query'         => array(
			array(
				'key'            => '_EventEndDate',
				'value'          => date( 'Y-m-d H:i:s' ),
				'compare'        => '>',
				'type'           => 'DATETIME',
			),
		),
	  'order'							 => 'ASC',
	  'eventDisplay'			 => 'custom',
	);
	$get_posts             = null;
	$get_posts             = new WP_Query();
	$get_posts->query($args);
	if($get_posts->have_posts()){
		$calTitle             = get_field('calendar_title', 'options');
		$calLink              = get_field('calendar_link', 'options');
		$o .= '<div class="sidebar">';
		$o .= '<div id="sidebarTabs">';
		$o .= '<ul class="filterbar">';
	  $o .= '<li><a href="#tab-events">Upcoming Events</a></li>';
	  $o .= '</ul>';
		$o .= '<div class="tabcont" id="tab-events">';
		$o .= '<div class="block style-featImg yes-solid">';
		$o .= '<div class="b-title">Upcoming Events</div>';
		$o .= '<ul>';
			while($get_posts->have_posts()) : $get_posts->the_post();
				//event fields
				$eventPHImg       = get_field('event_placeholder_image', 'options');
		    $imageType 				= get_field('image_type');
		    $ftImg 	          = get_field('featured_image');
		    $post_object      = get_field('event_default_information');
		    $title            = get_field('event_short_title');
		    $shortDesc	      = get_field('event_short_description');
		    $link				      = get_the_permalink();
		    $theTitle		      = get_the_title();
		    $monthName	      = tribe_get_start_date(null, false, 'F');
		    $dayName		      = tribe_get_start_date(null, false, 'd');
		    $monthNameend	    = tribe_get_end_date(null, false, 'F');
		    $dayNameend		    = tribe_get_end_date(null, false, 'd');

				$o .= '<li>';

		    $o .= '<a href="'.$link.'" title="'.$title.'">';
		    if($imageType == 'defaultImage'){
		      if($post_object != '') {
		        $post = $post_object;
		        setup_postdata( $post );
		        $catImg = get_field('category_image', $post_object->ID);
		        $o .= '<div class="img"><img src="'.$catImg['url'].'"></div>';
		        wp_reset_postdata();
		      } else {
		        $o .= '<div class="img"><img src="'.$eventPHImg['url'].'"></div>';
		      }
		    }

		    if($imageType == 'customImage'){
		      if($featImage != ''){
		        $o .= '<div class="img"><img src="'.$featImg['url'].'"></div>';
		      } else {
		        $o .= '<div class="img"><img src="'.$eventPHImg['url'].'"></div>';
		      }
		    }

		    if($imageType == 'none') {
		      $o .= '<div class="img"><img src="'.$eventPHImg['url'].'"></div>';
		    }
		    $o .= '</a>';

		    $o .= '
		    <div class="cont">
		      <div class="cont-title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
		    ';
		    //


		    $o .= $mdo;

		    if (tribe_get_start_date(null, false, 'F d') != tribe_get_end_date(null, false, 'F d') ) {
		      if($monthName != $monthNameend){
		        $o .= '<div class="data date">';
		        $o .= '<div class="meta-icon">'.$dateIcon.' '.$monthName.' '.$dayName.' - '.$monthNameend.' '.$dayNameend.'</div>';
		        $o .= '</div>';
		      } else {
		        $o .= '<div class="data date">';
		        $o .= '<div class="meta-icon">'.$dateIcon.' '.$monthName.' '.$dayName.' - '.$monthNameend.' '.$dayNameend.'</div>';
		        $o .= '</div>';
		      }
		    } else {
		      $o .= '<div class="data date">';
		      $o .= '<div class="meta-icon">'.$dateIcon.' '.$monthName.' '.$dayName.'</div>';
		      $o .= '</div>';
		    }

		    $o .= $mdc;
		    //
		    $o .= '</div>';
		    $o .= '</li>';
			endwhile;
			$o .= '</ul>';
			$o .= '</div>';
			$o .= '</div>';
			$o .= '</div>';
		}
		wp_reset_postdata();

	 // output
	 return $o;

}
add_shortcode('calendarSidebarBlock', 'calendarSidebarBlock_shortcode');

// *****
// Page Shortcode - Calendar Block of 3 Events
// *****
function calendarBlock_shortcode(){
	$args = array(
	  'post_status' 		   => 'publish',
	  'post_type' 			   => array(TribeEvents::POSTTYPE),
	  'posts_per_page'	   => 3,
	  //order by startdate from newest to oldest
	  'meta_key'					 => '_EventStartDate',
	  'orderby'						 => '_EventStartDate',
		'meta_query'         => array(
			array(
				'key'            => '_EventEndDate',
				'value'          => date( 'Y-m-d H:i:s' ),
				'compare'        => '>',
				'type'           => 'DATETIME',
			),
		),
	  'order'							 => 'ASC',
	  'eventDisplay'			 => 'custom',
	);
	$get_posts             = null;
	$get_posts             = new WP_Query();
	$get_posts->query($args);
	if($get_posts->have_posts()){
		$calTitle             = get_field('calendar_title', 'options');
		$calLink              = get_field('calendar_link', 'options');
		$o .= '<section class="calendar-block">';
		$o .= '<div class="columns is-mobile is-multiline contain">';
		$o .= '<div class="column is-12">';
		$o .= '<div class="block-title">'.$calTitle.'</div>';
		$o .= '<a class="full-calendar" href="'.$calLink['url'].'" title="'.$calLink['title'].'">'.$calLink['title'].'</a>';
		$o .= '<ul class="calendar-blocks">';
			while($get_posts->have_posts()) : $get_posts->the_post();
				//event fields
				$eventPHImg       = get_field('event_placeholder_image', 'options');
				$imageType 				= get_field('image_type');
				$featImage 	      = get_field('featured_image');
        $post_object      = get_field('event_default_information');
				$shortTitle       = get_field('event_short_title');
				$shortDesc	      = get_field('event_short_description');
				$link				      = get_the_permalink();
				$theTitle		      = get_the_title();
				$monthName	      = tribe_get_start_date(null, false, 'F');
				$dayName		      = tribe_get_start_date(null, false, 'd');
				$monthNameend	    = tribe_get_end_date(null, false, 'F');
				$dayNameend		    = tribe_get_end_date(null, false, 'd');

				$o .= '<li>';
				if($imageType == 'defaultImage'){
	        if($post_object != '') {
	          $post = $post_object;
	          setup_postdata( $post );
	          $catImg = get_field('category_image', $post_object->ID);
	          $o .= '<div class="event-block" style="background-image: url('.$catImg['url'].');">';
	          wp_reset_postdata();
					} else {
	          $o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
					}
				}

				if($imageType == 'customImage'){
					if($featImage != ''){
	          $o .= '<div class="event-block" style="background-image: url('.$featImage['url'].');">';
	        } else {
						$o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
					}
				}

				if($imageType == 'none') {
					$o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
				}

				$o .= '<a href="'.$link.'" title="'.$theTitle.'">';
				$o .= '<div class="content">';
				if($shortTitle != ''){
					$o .= '<div class="title">'.$shortTitle.'</div>';
				} else {
					$o .= '<div class="title">'.$theTitle.'</div>';
				}

				if (tribe_get_start_date(null, false, 'F d') != tribe_get_end_date(null, false, 'F d') ) {
					if($monthName != $monthNameend){
		  			$o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.' - '.$monthNameend.' '.$dayNameend.'</span><div class="more">Learn More</div></div>';
					} else {
						$o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.' - '.$dayNameend.'</span><div class="more">Learn More</div></div>';
					}
				} else {
			    $o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.'</span><div class="more">Learn More</div></div>';
			  }

				$o .= '</div>';
				$o .= '<div class="shade"></div>';
				$o .= '</a>';
				$o .= '</div>';
				$o .= '</li>';
			endwhile;
			$o .= '</ul>';
			$o .= '</div>';
			$o .= '</div>';
			$o .= '</section>';
		}
		wp_reset_postdata();

	 // output
	 return $o;

}
add_shortcode('calendarBlock', 'calendarBlock_shortcode');


// *****
// Page Shortcode - Featured Calendar Events
// *****
function featuredCalendarEvents_shortcode(){
	$args = array(
	  'post_status' 		   => 'publish',
	  'post_type' 			   => array(TribeEvents::POSTTYPE),
	  'posts_per_page'	   => 30,
	  //order by startdate from newest to oldest
	  'meta_key'					 => '_EventStartDate',
	  'orderby'						 => '_EventStartDate',
		'meta_query'         => array(
			array(
				'key'            => '_EventEndDate',
				'value'          => date( 'Y-m-d H:i:s' ),
				'compare'        => '>',
				'type'           => 'DATETIME',
			),
		),
	  'order'							 => 'ASC',
	  'eventDisplay'			 => 'custom',
	);
	$get_posts             = null;
	$get_posts             = new WP_Query();
	$get_posts->query($args);
	if($get_posts->have_posts()){
		$calTitle             = get_field('calendar_title', 'options');
		$calLink              = get_field('calendar_link', 'options');
		$o .= '<div class="columns is-mobile is-multiline contain">';
		$o .= '<div class="column is-12">';
		$o .= '<ul class="calendar-blocks full-cal-blocks">';
			while($get_posts->have_posts()) : $get_posts->the_post();
				//event fields
				$eventPHImg       = get_field('event_placeholder_image', 'options');
				$imageType 				= get_field('image_type');
				$featImage 	      = get_field('featured_image');
        $post_object      = get_field('event_default_information');
				$shortTitle       = get_field('event_short_title');
				$shortDesc	      = get_field('event_short_description');
				$link				      = get_the_permalink();
				$theTitle		      = get_the_title();
				$monthName	      = tribe_get_start_date(null, false, 'F');
				$dayName		      = tribe_get_start_date(null, false, 'd');
				$monthNameend	    = tribe_get_end_date(null, false, 'F');
				$dayNameend		    = tribe_get_end_date(null, false, 'd');

				$o .= '<li>';
				if($imageType == 'defaultImage'){
	        if($post_object != '') {
	          $post = $post_object;
	          setup_postdata( $post );
	          $catImg = get_field('category_image', $post_object->ID);
	          $o .= '<div class="event-block" style="background-image: url('.$catImg['url'].');">';
	          wp_reset_postdata();
					} else {
	          $o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
					}
				}

				if($imageType == 'customImage'){
					if($featImage != ''){
	          $o .= '<div class="event-block" style="background-image: url('.$featImage['url'].');">';
	        } else {
						$o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
					}
				}

				if($imageType == 'none') {
					$o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
				}

				$o .= '<a href="'.$link.'" title="'.$theTitle.'">';
				$o .= '<div class="content">';
				if($shortTitle != ''){
					$o .= '<div class="title">'.$shortTitle.'</div>';
				} else {
					$o .= '<div class="title">'.$theTitle.'</div>';
				}

				if (tribe_get_start_date(null, false, 'F d') != tribe_get_end_date(null, false, 'F d') ) {
					if($monthName != $monthNameend){
		  			$o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.' - '.$monthNameend.' '.$dayNameend.'</span><div class="more">Learn More</div></div>';
					} else {
						$o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.' - '.$dayNameend.'</span><div class="more">Learn More</div></div>';
					}
				} else {
			    $o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.'</span><div class="more">Learn More</div></div>';
			  }

				$o .= '</div>';
				$o .= '<div class="shade"></div>';
				$o .= '</a>';
				$o .= '</div>';
				$o .= '</li>';
			endwhile;
			$o .= '</ul>';
			$o .= '</div>';
			$o .= '</div>';
		}

	 // output
	 wp_reset_postdata();
	 return $o;
}
add_shortcode( 'featuredCalendarEvents', 'featuredCalendarEvents_shortcode' );



// *****
// Page Shortcode - Events Archive
// *****
function eventsArchive_shortcode(){
	$archiveDate 						= tribe_get_start_date(null, false, 'F j, Y');
	$args = array(
	  'post_status' 		   => 'publish',
	  'post_type' 			   => array(TribeEvents::POSTTYPE),
	  'posts_per_page'	   => -1,
	  'orderby'						 => '_EventStartTime',
		'order'							 => 'ASC',
		'eventDate'					 => $archiveDate,
	);
	$get_posts             = null;
	$get_posts             = new WP_Query();
	$get_posts->query($args);
	if($get_posts->have_posts()){
		$calTitle             = get_field('calendar_title', 'options');
		$calLink              = get_field('calendar_link', 'options');
		$o .= '<div class="columns is-mobile is-multiline contain">';
		$o .= '<div class="column is-12">';
		$o .= '<h2>Upcoming Events on '.$archiveDate.'</h2>';
		$o .= '<ul class="calendar-blocks full-cal-blocks">';
			while($get_posts->have_posts()) : $get_posts->the_post();
				//event fields
				$eventPHImg       = get_field('event_placeholder_image', 'options');
				$imageType 				= get_field('image_type');
				$featImage 	      = get_field('featured_image');
        $post_object      = get_field('event_default_information');
				$shortTitle       = get_field('event_short_title');
				$shortDesc	      = get_field('event_short_description');
				$link				      = get_the_permalink();
				$theTitle		      = get_the_title();
				$monthName	      = tribe_get_start_date(null, false, 'F');
				$dayName		      = tribe_get_start_date(null, false, 'd');
				$monthNameend	    = tribe_get_end_date(null, false, 'F');
				$dayNameend		    = tribe_get_end_date(null, false, 'd');

				$o .= '<li>';
				if($imageType == 'defaultImage'){
	        if($post_object != '') {
	          $post = $post_object;
	          setup_postdata( $post );
	          $catImg = get_field('category_image', $post_object->ID);
	          $o .= '<div class="event-block" style="background-image: url('.$catImg['url'].');">';
	          wp_reset_postdata();
					} else {
	          $o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
					}
				}

				if($imageType == 'customImage'){
					if($featImage != ''){
	          $o .= '<div class="event-block" style="background-image: url('.$featImage['url'].');">';
	        } else {
						$o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
					}
				}

				if($imageType == 'none') {
					$o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
				}

				$o .= '<a href="'.$link.'" title="'.$theTitle.'">';
				$o .= '<div class="content">';
				if($shortTitle != ''){
					$o .= '<div class="title">'.$shortTitle.'</div>';
				} else {
					$o .= '<div class="title">'.$theTitle.'</div>';
				}

				if (tribe_get_start_date(null, false, 'F d') != tribe_get_end_date(null, false, 'F d') ) {
					if($monthName != $monthNameend){
		  			$o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.' - '.$monthNameend.' '.$dayNameend.'</span><div class="more">Learn More</div></div>';
					} else {
						$o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.' - '.$dayNameend.'</span><div class="more">Learn More</div></div>';
					}
				} else {
			    $o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.'</span><div class="more">Learn More</div></div>';
			  }

				$o .= '</div>';
				$o .= '<div class="shade"></div>';
				$o .= '</a>';
				$o .= '</div>';
				$o .= '</li>';
			endwhile;
			$o .= '</ul>';
			$o .= '</div>';
			$o .= '</div>';
		}

	 // output
	 wp_reset_postdata();
	 return $o;
}
add_shortcode( 'eventsArchive', 'eventsArchive_shortcode' );


// *****
// Page Shortcode - Calendar Tabs on Calendar Page
// *****
function calendarTabs_shortcode(){
	$pageTitle			= get_field('calendar_page_title', 'options');
	$calendarOpen 	.= '<div class="columns is-multiline layout-builder">';
	$calendarOpen 	.= '<div class="column is-12 centered">'.$pageTitle.'</div>';
	$calendarOpen 	.= '<div class="column is-12">';
	$calendarClose 	.= '</div>';
	$calendarClose 	.= '</div>';
	$calendarTop 		.= '<section class="calendar-block internal-block">';
	$calendarTop 		.= '<div id="calendarTabs">';
	$calendarTO  		.= '<ul class="filterbar">';
	$calendarTC  		.= '</ul>';

	if( have_rows('calendar_tabs', 'options') ){
		//$rowC = '0';
		while ( have_rows('calendar_tabs', 'options') ) : the_row();
			//$rowC++;
			$tname 		= get_sub_field('tab_name', 'options');
			$tabName 	= preg_replace("/[^A-Za-z0-9]/", "", $tname);
			$link			= get_sub_field('tab_link', 'options');
			$type			= get_sub_field('tab_type', 'options');
			$tab 			.= '<li>';
			$tab			.= '<a href="#tab-'.$tabName.'">';
			$tab 			.= $tname;
			$tab 			.= '</a>';
			$tab 			.= '<div class="triangle"></div>';
			$tab 			.= '</li>';
		endwhile;
		$tabs 		.= $tab;
	}

	if( have_rows('calendar_tabs', 'options') ){
		while ( have_rows('calendar_tabs', 'options') ) : the_row();
			$name 		= get_sub_field('tab_name', 'options');
			$tab 			= preg_replace("/[^A-Za-z0-9]/", "", $name);
			$scode 		= get_sub_field('tab_shortcode', 'options');
			$type			= get_sub_field('tab_type', 'options');
			$cont			= get_sub_field('tab_content', 'options');
			$tabC 		.= '<div class="tabcont" id="tab-'.$tab.'">';
			$tabC 		.= '<div class="columns">';
			$tabC 		.= '<div class="column is-12 is-paddingless">';
			if($type == 'shortcode'){
				$tabC 	.= do_shortcode($scode);
			} else {
				$tabC		.= $cont;
				$tabC 	.= '<div class="button-block"><a class="btn styled" href="'.$link['url'].'" title="'.$link['title'].'" target="'.$link['target'].'">'.$link['title'].'</a></div>';
			}
			$tabC 		.= '</div>';
			$tabC 		.= '</div>';
			$tabC 		.= '</div>';
		endwhile;
		$calendarBot .= '</div>';
		$calendarBot .= '</section>';
		$calendarBot .= '</div>';
	}

	//
	wp_reset_postdata();
	echo $calendarOpen;
	echo $calendarTop;
	echo $calendarTO;
	echo $tabs;
	echo $calendarTC;
	echo $tabC;
	echo $calendarBot;
	echo $calendarClose;
	//

}
add_shortcode('calendarTabs', 'calendarTabs_shortcode');


// *****
// Page Shortcode - Events Archive
// *****
function singleEvent_shortcode(){
		$o .= '<div class="columns is-mobile is-multiline contain">';
		//event fields
		$eventPHImg       = get_field('event_placeholder_image', 'options');
		$imageType 				= get_field('image_type');
		$featImage 	      = get_field('featured_image');
    $post_object      = get_field('event_default_information');
		$shortTitle       = get_field('event_short_title');
		$shortDesc	      = get_field('event_short_description');
		$theContent				= get_the_content();
		$link				      = get_the_permalink();
		$theTitle		      = get_the_title();
		$monthName	      = tribe_get_start_date(null, false, 'm');
		$dayName		      = tribe_get_start_date(null, false, 'd');
		$yearName		      = tribe_get_start_date(null, false, 'Y');
		$startTime		    = tribe_get_start_date($event_id, true, 'ga');
		$endTime		    	= tribe_get_end_date($event_id, true, 'ga');
		$monthNameend	    = tribe_get_end_date(null, false, 'F');
		$dayNameend		    = tribe_get_end_date(null, false, 'd');
		$yearNameend		  = tribe_get_end_date(null, false, 'Y');
		$dateIcon					= get_field('date_icon', 'options');

		$o .= '<div class="column is-12-mobile is-4-tablet is-5-desktop is-5-widescreen">';
		$o .= '<div class="calendar-blocks single-block">';
		$o .= '<div class="cal-block">';
		if($imageType == 'defaultImage'){
      if($post_object != '') {
        $post = $post_object;
        setup_postdata( $post );
        $catImg = get_field('category_image', $post_object->ID);
        $o .= '<div class="event-block" style="background-image: url('.$catImg['url'].');">';
        wp_reset_postdata();
			} else {
        $o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
			}
		}

		if($imageType == 'customImage'){
			if($featImage != ''){
        $o .= '<div class="event-block" style="background-image: url('.$featImage['url'].');">';
      } else {
				$o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
			}
		}

		if($imageType == 'none') {
			$o .= '<div class="event-block" style="background-image: url('.$eventPHImg['url'].');">';
		}

		// $o .= '<div class="content">';
		// if($shortTitle != ''){
		// 	$o .= '<div class="title">'.$shortTitle.'</div>';
		// } else {
		// 	$o .= '<div class="title">'.$theTitle.'</div>';
		// }
		//
		// if (tribe_get_start_date(null, false, 'F d') != tribe_get_end_date(null, false, 'F d') ) {
		// 	if($monthName != $monthNameend){
  	// 		$o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.' - '.$monthNameend.' '.$dayNameend.'</span><div class="more">Learn More</div></div>';
		// 	} else {
		// 		$o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.' - '.$dayNameend.'</span><div class="more">Learn More</div></div>';
		// 	}
		// } else {
	  //   $o .= '<div class="more-info"><span class="date">'.$monthName.' '.$dayName.'</span><div class="more">Learn More</div></div>';
	  // }
		//
		// $o .= '</div>';
		if($startTime .= ''){
			$starting .= '<div class="block"><span>'.$dateIcon.'</span>'.$startTime;
			if($endTime != ''){
				$ending .= '- '.$endTime.'</div>';
			} else {
				$ending .= '</div>';
			}
		}
		//
		$o .= '<div class="shade"></div>';
		$o .= '</div>';
		$o .= '</div>';
		$o .= '</div>';
		$o .= '</div>';
		$o .= '<div class="column is-12-mobile is-8-tablet is-7-desktop is-7-widescreen single-event">';
		$o .= '<h2>'.$theTitle.'</h2>';
		if (tribe_get_start_date(null, false, 'F d') != tribe_get_end_date(null, false, 'F d') ) {
			if($monthName != $monthNameend){
				$o .= '<div class="meta">';
				$o .= '<div class="block"><span>'.$dateIcon.'</span>'.$monthName.'/'.$dayName.' - '.$monthNameend.'/'.$dayNameend.'/'.$yearNameend.'</div>';
				$o .= $starting;
				$o .= $ending;
				$o .= '</div>';
			} else {
				$o .= '<div class="meta">';
				$o .= '<div class="block"><span>'.$dateIcon.'</span>'.$monthName.'/'.$dayName.' - '.$dayNameend.'/'.$yearNameend.'</div>';
				$o .= $starting;
				$o .= $ending;
				$o .= '</div>';
			}
		} else {
			$o .= '<div class="meta">';
			$o .= '<div class="block"><span>'.$dateIcon.'</span>'.$monthName.'/'.$dayName.'/'.$yearNameend.'</div>';
			$o .= $starting;
			$o .= $ending;
			$o .= '</div>';
		}
		$o .= '<p>'.$theContent.'</p>';
		$o .= '</div>';
		$o .= '</div>';
		$o .= '</div>';

	 // output
	 wp_reset_postdata();
	 return $o;
}
add_shortcode( 'singleEvent', 'singleEvent_shortcode' );

?>
