<?php
function socialmedia_shortcode(){
	if( have_rows('social_media_outlets','options') ){
		$sm .= '<div class="social-media">';
		//$sm .= '<div class="social-links">';
		$sm .= '<ul>';
    while ( have_rows('social_media_outlets','options') ) : the_row();
    	$link = get_sub_field('link','options');
			$sm .= '<li><a href="'.$link['url'].'" target="'.$link['target'].'"><div class="icons"><icon class="'.$link['title'].'"></icon></div></a></li>';
    endwhile;
		$sm .= '</ul>';
		//$sm .= '</div>';
		$sm .= '</div>';
	}

	echo $sm;
}
add_shortcode('socialmedia', 'socialmedia_shortcode');


function breadcrumb_shortcode(){
	if(function_exists('bcn_display')){
		$bc .= '<div class="breadcrumbs">';
		$bc .= '<div class="columns is-multiline is-mobile is-marginless">';
		$bc .= '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen is-paddingless">';
		$bc .= bcn_display(true);
		$bc .= '</div>';
		$bc .= '</div>';
		$bc .= '</div>';

		return $bc;
	}
}
add_shortcode( 'breadcrumb', 'breadcrumb_shortcode' );


function directions_shortcode(){
	// fields
	$locationIcon	= get_field('location_icon', 'options');
	$phoneIcon		= get_field('phone_icon', 'options');
	$address			= get_field('address', 'options');
	$city					= get_field('city', 'options');
	$state				= get_field('state', 'options');
	$zip					= get_field('zip', 'options');
	$map      		= get_field('map', 'options');
	$content			= get_field('content');


	// map
	$o .= '<section class="map-bg">';
  $o .= '<div class="map-fw">';
  $o .= '<div class="acf-map">';
  $o .= '<div class="marker" data-lat="'.$map['lat'].'" data-lng="'.$map['lng'].'"></div>';
  $o .= '</div>';
  $o .= '</div>';
  $o .= '</section>';

	// output
	echo $o;
}
add_shortcode('directions', 'directions_shortcode');


function staggeredChildPages_shortcode(){
	$id = get_the_id();
	$args = array(
	  'post_type'      	=> 'page',
		'post_status'			=> 'published',
	  'posts_per_page' 	=> -1,
	  'post_parent'    	=> $id,
	  'order'          	=> 'ASC',
	  'orderby'        	=> 'menu_order',
	);

	$parent = new WP_Query( $args );
	$pageCount = 0;

	if ( $parent->have_posts() ) {
		$o .='<section class="site-nav-blocks whitebg">';
		$o .='<div class="columns is-multiline is-mobile">';
		$o .='<div class="column is-12 is-paddingless">';
		$o .='<ul class="nav-blocks childpages shattered-elements">';
		while ( $parent->have_posts() ) : $parent->the_post();
			//vars
			$pageCount++;
			$title 			= get_the_title();
			$override 	= get_field('title_override');
			$oTitle 		= get_field('title');
			$leadIn 		= get_field('lead_in_content');
			$content 		= get_field('content');
			$id					= get_the_id();
			$link				= get_the_permalink();
			$pimage 		= get_field('staggered_image');
			$dimage 		= get_field('default_page_image', 'options');
			$blockType 	= get_field('block_type');
			$linkAfter 	= get_field('more_link_after', 'options');

			//
			$o .= '<li id="parent-'.$id.'" class="fullWidth staggered animated fadeInUp _'.$pageCount.'">';
			$o .= '<div class="image-holder">';
			if($pimage != ''){
				$o .= '<a href="'.$link.'" title="'.$title.'"><img src="'.$pimage['url'].'" alt="'.$title.'"></a>';
			} else {
				$o .= '<a href="'.$link.'" title="'.$title.'"><img src="'.$dimage['url'].'" alt="'.$title.'"></a>';
			}
			$o .= '<div class="glass-1"></div>';
			$o .= '<div class="glass-2"></div>';
			$o .= '</div>';

			$o .= '<div class="content">';
			if($override == 'yes'){
				$o .= '<h3><a href="'.$link.'" title="'.$title.'">'.$oTitle.'</a></h3>';
			} else {
				$o .= '<h3><a href="'.$link.'" title="'.$title.'">'.$title.'</a></h3>';
			}
			$o .= '<p>'.$content.'</p>';

			if( have_rows('page_buttons')){
				$o .= '<div class="button-block alignleft">';
				while ( have_rows('page_buttons') ) : the_row();
					$button = get_sub_field('button');
					$o .= '<a class="more" href="'.$button['url'].'" title="'.$button['title'].'">'.$button['title'].' '.$linkAfter.'</a>';
				endwhile;
				$o .= '</div>';
			}

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
	echo $o;
}
add_shortcode('staggeredChildPages', 'staggeredChildPages_shortcode');

function pageNav_shortcode(){
	$o .= '<ul class="nav-blocks">';

	//services
	$title = get_the_title(7);
	$permalink = get_the_permalink(7);
	$himage = get_field('header_image', 7);
	$o .= '<li style="background-image: url('.$himage['url'].');">';
	$o .= '<a href="'.$permalink.'" title="'.$title.'">';
	$o .= '<div class="content">';
	$o .= '<h3>'.$title.'</h3>';
	$o .= '</div>';
	$o .= '<div class="shade"></div>';
	$o .= '</a>';
	$o .= '</li>';
	//services

	//markets
	$title = get_the_title(8);
	$permalink = get_the_permalink(8);
	$himage = get_field('header_image',8);
	$o .= '<li style="background-image: url('.$himage['url'].');">';
	$o .= '<a href="'.$permalink.'" title="'.$title.'">';
	$o .= '<div class="content">';
	$o .= '<h3>'.$title.'</h3>';
	$o .= '</div>';
	$o .= '<div class="shade"></div>';
	$o .= '</a>';
	$o .= '</li>';
	//markets

	//quote
	$title = get_the_title(10);
	$permalink = get_the_permalink(10);
	$himage = get_field('header_image', 10);
	$o .= '<li style="background-image: url('.$himage['url'].');">';
	$o .= '<a href="'.$permalink.'" title="'.$title.'">';
	$o .= '<div class="content">';
	$o .= '<h3>'.$title.'</h3>';
	$o .= '</div>';
	$o .= '<div class="shade"></div>';
	$o .= '</a>';
	$o .= '</li>';
	//quote

	$o .= '</ul>';

	echo $o;
}
add_shortcode('pageNav', 'pageNav_shortcode');

function career_shortcode(){
  // single job posting
	$jobStatus = get_field('status');
	if($jobStatus == 'active'){
		$title 	= get_the_title();
		if( get_field('job_responsibilities')){
			$o .= '<h2>Job Responsibilities</h2>';
			$o .= '<ul class="dotted career-list">';
		    while( the_repeater_field('job_responsibilities') ){
		    	$o .= '<li>'. get_sub_field('job_responsibility') . '</li>';
		    }
			$o .= '</ul>';

			echo $o;
		}

		if( get_field('required_skills')){
			$a .= '<h2>Required Skills</h2>';
			$a .= '<ul class="dotted career-list">';
		    while( the_repeater_field('required_skills') ){
		    	$a .= '<li>'. get_sub_field('required_skill') . '</li>';
		    }
			$a .= '</ul>';

			echo $a;
		}

		if( get_field('required_experience')){
			$b .= '<h2>Required Experience</h2>';
			$b .= '<ul class="dotted career-list">';
		    while( the_repeater_field('required_experience') ){
		    	$b .= '<li>'. get_sub_field('experience') . '</li>';
		    }
			$b .= '</ul>';

			echo $b;
		}

		echo '<div class="button-block"><a class="btn career-btn" href="/apply/?jobTitle='.$title.'" title="Apply Now">Apply Now</a></div>';
	}
}
add_shortcode('career', 'career_shortcode');

function sitemap_shortcode(){
  echo '<section class="sitemap-links layout-builder"><div class="columns"><div class="column is-12">';
  return wp_nav_menu( array('theme_location' => 'Sitemap', 'menu_class' => 'sitemap' ));
  echo '</div></div></section>';
}
add_shortcode('sitemap', 'sitemap_shortcode');

// *****
// Page Shortcode - Internal Page App Promotion
// *****
function internalApp_shortcode(){
	//fields
	$contentTitle 				= get_field('internal_application_title', 'options');
	$contentSubtitle 			= get_field('internal_application_content', 'options');
	$image 								= get_field('internal_application_image', 'options');
	$afterLinkIcon				= get_field('more_link_after', 'options');
	$playBtnIcon				  = get_field('play_button', 'options');
	$checkMarkIcon				= get_field('checkmark_button', 'options');

	//title
	if($contentTitle != ''){
		$cT .= '<h4>'.$contentTitle.'</h4>';
	}

	//content
	if($contentSubtitle != ''){
		$csT .= $contentSubtitle;
	}

	// buttons
	if( have_rows('internal_application_buttons', 'options') ){
		$o .= '<div class="button-block">';
    while ( have_rows('internal_application_buttons', 'options') ) : the_row();
			$linkType 				= get_sub_field('link_type', 'options');
			$linkStyle 				= get_sub_field('link_style', 'options');
			$link 						= get_sub_field('button_page', 'options');
			$vidLink 					= get_sub_field('youtube_link', 'options');
			$vidText 					= get_sub_field('button_text', 'options');

			if($linkType == 'pageLink'){
				$o .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$afterLinkIcon.'</a></li>';
			}

			if($linkType == 'youtubeVideo'){
				$o .= '<a class="btn '.$linkStyle.' ico-before" data-fancybox href="'.$vidLink.'"title="'.$vidText.'">'.$playBtnIcon.''.$vidText.'</a></li>';
			}
    endwhile;
		$o .= '</div>';
	}

	// content type
	$hP .= '<section class="main-content internal-content">';
	$hP .= '<section class="application-internal">';
	$hP .= '<div class="columns is-multiline is-mobile">';
	$hP .= '<div class="column is-12-mobile is-7-tablet is-6-desktop is-6-widescreen">';
	$hP .= $cT; // title
	$hP .= $csT; // subtitle
	$hP .= $li; // list items
	$hP .= $o; // links
	$hP .= '</div>';
	if($image != ''){
		$hP .= '<div class="column is-12-mobile is-5-tablet is-6-desktop is-6-widescreen image-side"><img src="'.$image['url'].'" alt="'.$image['alt'].'"></div>';
	}
	$hP .= '</div>';
	$hP .= '</section>';

	echo $hP;

}
add_shortcode('internalApp', 'internalApp_shortcode');




// *****
// Page Shortcode - Footer Category List
// *****
function footerCatList_shortcode(){
	//fields
	$orderby              = 'name';
  $order                = 'asc';
  $hide_empty           = false;
  $cat_args = array(
    'post_type'         => 'product',
    'orderby'           => $orderby,
    'order'             => $order,
    'hide_empty'        => $hide_empty,
    'parent'            => 0,
  );
  $product_categories = get_terms( 'product_cat', $cat_args );

  if( !empty($product_categories) ){
		$fL .= '<nav class="footer-nav">';
		$fL .= '<ul class="menu-company-nav">';
		$count = '0';
    foreach ($product_categories as $key => $category) {
      //
			$count++;
			$catTitle					= $category->name;
      //
			if($catTitle != 'Uncategorized'){
				$fL .= '<li>';
				$fL .= '<a href="'.get_term_link($category).'" title="Browse '.$category->name.'">';
				$fL .= $category->name;
				$fL .= '</a>';
				$fL .= '</li>';
			}
    }
		$fL .= '</ul>';
		$fL .= '</nav>';
    echo $fL;
  }
}
add_shortcode('footerCatList', 'footerCatList_shortcode');

?>
