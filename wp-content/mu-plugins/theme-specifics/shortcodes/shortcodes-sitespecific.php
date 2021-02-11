<?php
/////////
// Site Specific Short Codes
/////////
function serviceBlock_shortcode(){
	$serviceBlockTitle 	= get_sub_field('service_block_title');
	$serviceBlockCont 	= get_sub_field('service_block_content');
	$linkAfter 				= get_field('more_link_after', 'options');
	//
	$o .= '<section class="layoutbuilder serviceBlock">';
	$o .= '<div class="columns is-mobile is-multiline oversized">';
	$o .= '<div class="column is-12-mobile is-12-tablet is-4-desktop is-4-widescreen">';
	if($serviceBlockTitle){
		$o .= '<div class="block-title">';
		$o .= '<span>Our Services</span>';
		$o .= $serviceBlockTitle;
		$o .= '</div>';
	}
	$o .= $serviceBlockCont;
	// buttons
	$btns	.= '<div class="button-block">';
	if( have_rows('service_block_buttons') ){
		while ( have_rows('service_block_buttons') ) : the_row();
			$linkStyle 				= get_sub_field('button_type');
			$link 						= get_sub_field('button');
			$method						= get_sub_field('button_method');
			$vidLink					= get_sub_field('video_link');
			$mediaLinks				= get_sub_field('media_link');
			$buttonText				= get_sub_field('button_text');
			$afterLinkIcon		= get_field('more_link_after', 'options');
			$size 						= 'full';

			if($method == 'videoLightbox'){
				// video lightbox
				$btn .= '<a class="btn '.$linkStyle.'" data-fancybox href="'.$vidLink['url'].'" data-caption="'.$vidLink['title'].'">'.$vidLink['title'].''.$afterLinkIcon.'</a>';
			} elseif($method == 'imageLightbox'){
				// image gallery
				if( $mediaLinks ){
					$mediaLinkCount = 0;
					foreach( $mediaLinks as $mediaLink ){
						$mediaLinkCount++;
						if($mediaLinkCount == '1'){
							$btn .= '<a class="btn '.$linkStyle.'" data-fancybox="images" href="'.$mediaLink['url'].'" data-caption="'.$mediaLink['title'].'">'.$buttonText.''.$afterLinkIcon.'</a>';
						} else {
							$btn .= '<a style="display: none" data-fancybox="images" href="'.$mediaLink['url'].'" data-caption="'.$mediaLink['title'].'"></a>';
						}
					}
				}
			} else {
				// standard link
				$btn .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$afterLinkIcon.'</a>';
			}

		endwhile;
	}
	$btns 	.= $btn;
	$btns		.= '</div>';
	$o .= $btns;
	// end buttons
	$o .= '</div>';

	$o .= '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen">';
	// services
	$query = new WP_Query(array(
		'post_type' 			=> 'page',
		'post_parent'			=> 301,
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> -1,
		'orderby' 				=> 'ID',
		'order' 					=> 'ASC',
	));

	$services .= '<ul class="services">';
	while ($query->have_posts()) {
	  $query->the_post();
	  $post_id 					= get_the_ID();
		$serviceTitle 		= get_the_title();
		$serviceLink 			= get_the_permalink();
		$serviceImg				= get_field('service_image');
		$serviceImgPH			= get_field('service_image_placeholder', 'options');

		$service .= '<li>';
		$service .= '<a href="'.$serviceLink.'" title="'.$serviceTitle.'">';
		if($serviceImg) {
			$service .= '<div class="thumbnail"><img src="'.$serviceImg['url'].'" alt="'.$serviceImg['alt'].'"></div>';
		} else {
			$service .= '<div class="thumbnail"><img src="'.$serviceImgPH['url'].'" alt="'.$serviceTitle.'"></div>';
		}
		$service .= '<div class="title">'.$serviceTitle.'</div>';
		$service .= '</a>';
		$service .= '</li>';

	}
	$services .= $service;
	$services .= '</ul>';
	wp_reset_query();
	$o .= $services;
	// end services
	$o .= '</div>';
	$o .= '</section>';

 // output
 return $o;
}
add_shortcode('serviceBlock', 'serviceBlock_shortcode');

function projectsBlock_shortcode(){
	$projectsBlockTitle 	= get_field('projects_block_title', 'options');
	$projectsBlockCont 		= get_field('projects_block_content', 'options');
	$projectsBlockMore 		= get_field('projects_link', 'options');
	$projectsBlockBg 			= get_field('projects_block_background', 'options');
	$projectsFeatured			= get_field('featured_projects', 'options');
	$linkAfter 						= get_field('more_link_after', 'options');

	// if bg
	if($projectsBlockBg){
		$background .= 'style="background: url('.$projectsBlockBg['url'].') #282828"; background-size: cover;"';
	}
	//

	//projects
	$featured_projects = get_field('featured_projects', 'options');
	if( $featured_projects ):
		$projects .= '<section class="projectBlock" '.$background.'>';
		$projects .= '<div class="columns is-multiline is-mobile">';
		$projects .= '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
		if($projectsBlockTitle){
			$projects .= '<div class="block-title">';
			$projects .= $projectsBlockTitle;
			$projects .= '</div>';
		}
		if($projectsBlockMore){
			$projects .= '<a class="more link" href="'.$projectsBlockMore['url'].'" title="'.$projectsBlockMore['title'].'">'.$projectsBlockMore['title'].$linkAfter.'</a>';
		}
		$projects .= $projectsBlockCont;
		$projects .= '</div>';
		$projects .= '<div class="column is-12-widescreen">';
		$projects .= '<ul class="projects">';
    foreach( $featured_projects as $featured_project ):
	    $post_id 					= get_the_ID($featured_project->ID);
			$projectTitle 		= get_the_title($featured_project->ID);
			$projectLink 			= get_the_permalink($featured_project->ID);
			$projectMediaType = get_field('hero_media_type', $featured_project->ID);
			$projectImg				= get_field('hero_image', $featured_project->ID);
			$projectVideo			= get_field('hero_video', $featured_project->ID);
			$projectLoc				= get_field('project_location', $featured_project->ID);
			$projectImgPH			= get_field('service_image_placeholder', 'options');

			if($projectLoc) {
				$loc = '<div>'.$projectLoc.'</div>';
			}
			//
      $project .= '<li>';
			$project .= '<a href="'.$projectLink.'" title="'.$projectTitle.'">';
			if($projectMediaType == 'videoHero') {
				$project .= '<div class="thumbnail">';
				$project .= '<video width="100%" height="100%" class="video" muted playsinline autoplay>';
				$project .= '<source src="'.$projectVideo['url'].'" type="video/mp4">';
				$project .= '</video>';
				$project .= '</div>';
			} else {
				$project .= '<div class="thumbnail"><img src="'.$projectImg['url'].'" alt="'.$projectTitle.'"></div>';
			}
			$project .= '<div class="title">'.$projectTitle.$loc.'</div>';
			$project .= '</a>';
      $project .= '</li>';
    endforeach;
		$projects	.= $project;
		$projects .= '</ul>';
		$projects .= '</div>';
		$projects .= '</div>';
		$projects .= '</section>';
	endif;

 // output
 return $projects;
}
add_shortcode('projectsBlock', 'projectsBlock_shortcode');


// hiring
function hiringBlock_shortcode(){
	$hiringCont 		= get_field('hiring_content', 'options');
	$jobImage				= get_field('job_image', 'options');
	$linkAfter 			= get_field('more_link_after', 'options');

	// if bg
	if($jobImage){
		$background .= '<img src="'.$jobImage['url'].'" alt="Now Hiring">';
	}
	//

	// buttons
	if( have_rows('quicklinks', 'options') ):
		$btn .= '<div class="button-block">';
		while( have_rows('quicklinks', 'options') ) : the_row();
      $link = get_sub_field('link');
			$btn .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$linkAfter.'</a>';
    endwhile;
		$btn .= '</div>';
	endif;
	//

	$hiringBlock .= '<section class="hiringBlock layout-builder">';
	$hiringBlock .= '<div class="contain-threequarter">';
	$hiringBlock .= $hiringCont;
	$hiringBlock .= $btn;
	$hiringBlock .= '</div>';
	$hiringBlock .= '<div class="contain-threequarter">';
	$hiringBlock .= $background;
	$hiringBlock .= '</div>';
	$hiringBlock .= '</section>';
	//

 	// output
 	return $hiringBlock;
}
add_shortcode('hiringBlock', 'hiringBlock_shortcode');


// starting block
function startingBlock_shortcode(){
	$startingCont 		= get_field('project_content', 'options');
	$startingImage		= get_field('project_image', 'options');
	$linkAfter 			= get_field('more_link_after', 'options');

	// if bg
	if($startingImage){
		$background .= '<img src="'.$startingImage['url'].'" alt="Get Started on Your Next Project">';
	}
	//

	// buttons
	if( have_rows('project_links', 'options') ):
		$btn .= '<div class="button-block">';
		while( have_rows('project_links', 'options') ) : the_row();
      $link = get_sub_field('link');
			$btn .= '<a class="btn '.$linkStyle.'" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].''.$linkAfter.'</a>';
    endwhile;
		$btn .= '</div>';
	endif;
	//

	$startingBlock .= '<section class="startingBlock layout-builder">';
	$startingBlock .= '<div class="contain">';
	$startingBlock .= '<div class="block-container">';
	$startingBlock .= $startingCont;
	$startingBlock .= $btn;
	$startingBlock .= '</div>';
	$startingBlock .= $background;
	$startingBlock .= '</div>';
	$startingBlock .= '</section>';
	//

 	// output
 	return $startingBlock;
}
add_shortcode('startingBlock', 'startingBlock_shortcode');

// newjobs
function newJobsBlock_shortcode(){
	$jobCont 				= get_field('new_job_content', 'options');
	$jobImage				= get_field('job_background_image', 'options');
	$linkAfter 			= get_field('more_link_after', 'options');

	// if bg
	if($jobImage){
		$background .= 'style="background-image: url('.$jobImage['url'].'); background-size: cover;"';
	}
	//

	// buttons
	if( have_rows('job_buttons', 'options') ):
		$btn .= '<div class="button-block">';
		while( have_rows('job_buttons', 'options') ) : the_row();
      $link = get_sub_field('link');
			$btn .= '<a class="btn styled" href="'.$link['url'].'" title="'.$link['title'].'">'.$link['title'].$linkAfter.'</a>';
    endwhile;
		$btn .= '</div>';
	endif;
	//

	$newJobBlock .= '<section class="newJobBlock layout-builder" '.$background.'>';
	$newJobBlock .= '<div class="columns is-multiline is-mobile">';
	$newJobBlock .= '<div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen">';
	$newJobBlock .= $jobCont;
	$newJobBlock .= $btn;
	$newJobBlock .= '</div>';
	$newJobBlock .= '</div>';
	$newJobBlock .= '</section>';
	//

 	// output
 	return $newJobBlock;
}
add_shortcode('newJobsBlock', 'newJobsBlock_shortcode');


function quicklinkServices_shortcode(){
	$linkAfter 				= get_field('more_link_after', 'options');
	if( have_rows('quicklinks', 'options') ){
		$o .= '<section class="quicklinks-block">';
		$o .= '<ul class="q-links">';
    while ( have_rows('quicklinks', 'options') ) : the_row();
			$post_object = get_sub_field('quicklink_page');
      if( $post_object){
				$post = $post_object;
				setup_postdata( $post );
				$permalink 	= get_the_permalink($post_object->ID);
				$pageTitle 	= get_the_title($post_object->ID);
				$pageSumm 	= get_field('page_summary', $post_object->ID);
				$pageLink 	= get_field('link_text', $post_object->ID);
				$pageIcon 	= get_field('page_icon', $post_object->ID);

				if($pageIcon != ''){
					$o .= '<li>';
					$o .= '<a href="'.$permalink.'" title="'.$pageTitle.'">';
					$o .= '<div class="shape">';
					$o .= '<div class="icon-block"><img src="'.$pageIcon['url'].'" alt="'.$pageTitle.'"></div>';
					$o .= '<div class="title">'.$pageTitle.'</div>';
					$o .= '<div class="page-sum">'.$pageSumm.'</div>';
					if($pageLink != ''){
						$o .= '<div class="page-link">'.$pageLink.$linkAfter.'</div>';
					} else {
						$o .= '<div class="page-link">Learn More'.$linkAfter.'</div>';
					}
					$o .= '</div>';
					$o .= '</a>';
					$o .= '</li>';
				}
			}

    endwhile;
		$o .= '</ul>';
		$o .= '</section>';
	}

 // output
 return $o;
}
add_shortcode('quicklinkServices', 'quicklinkServices_shortcode');


function fullMap_shortcode(){
	$map      		= get_field('map', 'options');
	// map
	$o .= '<section class="map-bg">';
  $o .= '<div class="map-fw">';
  $o .= '<div class="acf-map">';
  $o .= '<div class="marker" data-lat="'.$map['lat'].'" data-lng="'.$map['lng'].'"></div>';
  $o .= '</div>';
  $o .= '</div>';
  $o .= '</section>';

 // output
 return $o;
}
add_shortcode('fullMap', 'fullMap_shortcode');


function map_shortcode(){
	$map = get_field('map', 'options');
	// map
	$o .= '<section class="map-bg">';
  $o .= '<div class="map-fw">';
  $o .= '<div class="acf-map">';
  $o .= '<div class="marker" data-lat="'.$map['lat'].'" data-lng="'.$map['lng'].'"></div>';
  $o .= '</div>';
  $o .= '</div>';
  $o .= '</section>';

 // output
 return $o;
}
add_shortcode('map', 'map_shortcode');



// *****
// Page Shortcode - Contact Page
// *****
function contact_shortcode(){
	//sitewide info
	$address 		= get_field('address', 'options');
	$city				= get_field('city', 'options');
	$state			= get_field('state', 'options');
	$zip				= get_field('zip', 'options');
	$phone			= get_field('phone', 'options');
	$fax				= get_field('fax', 'options');
	$form				= get_sub_field('form_shortcode');
	$formSide		= get_sub_field('form_sidebar');

	//contact information
	$cForm .= '<div class="csection">';
	//$cForm .= '<div class="title">Contact Information</div>';
	$cForm .= '<ul>';
	$cForm .= '<li class="address">';
	$cForm .= '<icon class="icon-solid-location"></icon>';
	$cForm .= '<span>'.$address.', '.$city.', '.$state.' - '.$zip.'</span>';
	$cForm .= '</li>';
	$cForm .= '<li class="phone">';
	$cForm .= '<icon class="icon-phone-solid"></icon>';
	$cForm .= '<span>p: '.$phone.'</span>';
	$cForm .= '</li>';
	$cForm .= '<li class="phone">';
	$cForm .= '<icon class="icon-phone-solid"></icon>';
	$cForm .= '<span>f: '.$fax.'</span>';
	$cForm .= '</li>';
	//email
	$mainEmail = get_field('email_address', 'options');
	if($mainEmail != ''){
		$cForm .= '<li class="mail">';
		$cForm .= '<a class="mainemail" href="mailto:'.$mainEmail.'"><icon class="icon-message-closed-envelope"></icon><span>'.$mainEmail.'</span></a>';
		$cForm .= '</li>';
	}
	$cForm .= '</ul>';
	$cForm .= '</div>';

	return $cForm;
}
add_shortcode('contact', 'contact_shortcode');


function careerMeta_shortcode(){
	$sitePath							= get_field('site_path', 'options');
	include($sitePath.'/resources/views/partials/career-queries/query-header-career.php');
}
add_shortcode('careerMeta', 'careerMeta_shortcode');

// careers list
function careersList_shortcode(){
	$map      		= get_field('map', 'options');
	//ft-positions
	$query = new WP_Query(array(
		'post_type' 			=> 'jobs',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> -1,
	));


	while ($query->have_posts()) {
	  $query->the_post();
	  $post_id 					= get_the_ID();
		$post_title 			= get_the_title();
		$stripped   			= preg_replace("/[^A-Za-z0-9]/", "", $post_title);
		$job_type					= get_field('job_type');
		$listing_type			= get_field('job_listing_type');
		$active						= get_field('active_listing');
		$posted						= get_field('date_posted');
		$jobDesc					= get_field('job_description');
		$pdf							= get_field('pdf');

		if($active == 'yes'){
			if($listing_type == 'link'){
				$job_link			= get_field('job_link');
				$target 			= 'target="_blank"';
			} elseif($listing_type == 'application'){
				$job_link 		= '/apply/?job='.$stripped;
				$target				= '';
			} else {
				$job_link			= get_the_permalink();
				$target				= '';
			}

			if($posted){
				$post .= '<span>Posted on '.$posted.'</span>';
				$datePosted = $post;
			}

			// full-time
			if($job_type == 'ft'){
				$fullTime 	.= '<div class="job"><a href="'.$job_link.'" target="'.$target.'" title="'.$post_title.'"><div>'.$post_title.'</div>'.$datePosted.'</a></div>';
			}

			// part-time
			// if($job_type == 'pt'){
			// 	$partTime 	.= '<div class="job"><a href="'.$job_link.'" target="'.$target.'" title="'.$post_title.'"><div>'.$post_title.'</div></a></div>';
			// }

			// volunteer
			// if($job_type == 'vt'){
			// 	$volunteer 	.= '<div class="job"><a href="'.$job_link.'" target="'.$target.'" title="'.$post_title.'">'.$post_title.'</a></div>';
			// }
		}
	}

	wp_reset_query();
	//pt-positions
	//volunteers
	//

	// careers
	$o .= '<section class="careers">';
	$o .= '<div class="columns is-multiline">';
	$o .= '<div class="column is-12">';
	//ft
	$o .= '<div class="jobblock">';
	$o .= '<div class="type-title">Full-Time Openings</div>';
	if($fullTime != ''){
		$o .= $fullTime;
	} else {
		$o .= '<p class="non">There are currently no full-time jobs posted.</p>';
	}
	$o .= '</div>';
	//PT
	// $o .= '<div class="jobblock">';
	// $o .= '<div class="type-title">Part-Time Openings</div>';
	// if($partTime != ''){
	// 	$o .= $partTime;
	// } else {
	// 		$o .= '<p class="non">There are currently no part-time jobs posted.</p>';
	// }
	// $o .= '</div>';
	//VT
	// $o .= '<div class="jobblock">';
	// $o .= '<div class="type-title">Volunteer Opportunities</div>';
	// if($volunteer != ''){
	// 	$o .= $volunteer;
	// } else {
	// 	$o .= '<p class="non">There are currently no opportunities posted.</p>';
	// }
	// apply
	$app .= '<div class="jobblock">';
	$app .= '<div class="type-title">Submit an Application</div>';
	$app .= '<div class="button-block"><a class="btn styled" href="/apply/?job=generic" title="Apply Now"><div>Submit an Application</div></a></div>';
	$app .= '</div>';

	$o .= $app;
	$o .= '</div>';
	$o .= '</div>';
	$o .= '</div>';
  $o .= '</section>';

 // output
 return $o;
}
add_shortcode('careersList', 'careersList_shortcode');



// career
function career_single_shortcode(){
  $post_id 					= get_the_ID();
	$post_title 			= get_the_title();
	$stripped   			= preg_replace("/[^A-Za-z0-9]/", "", $post_title);
	$job_type					= get_field('job_type');
	$listing_type			= get_field('job_listing_type');
	$active						= get_field('active_listing');
	$posted						= get_field('date_posted');
	$jobDesc					= get_field('job_description');
	$pdf							= get_field('pdf');

	//type
	if($job_type == 'ft'){
		$type		.= '<span class="job-type">Full-Time Position</span>';
	}

	// part-time
	if($job_type == 'pt'){
		$type		.= '<span class="job-type">Part-Time Position</span>';
	}

	// volunteer
	if($job_type == 'vt'){
		$type		.= '<span class="job-type">Volunteer Opportunity</span>';
	}

	//button-block
	$btn .= '<div class="button-block">';
	$btn .= '<a href="/apply/?job='.$stripped.'" class="btn styled" title="Apply Now">Apply Now</a>';
	if($jobDesc != ''){
		$btn .= '<a class="btn styled" href="'.$pdf['url'].'" target="_blank" title="Download the Job Description">Download the Job Description</a>';
	}
	$btn .= '</div>';

	// careers
	$o .= '<section class="careers">';
	$o .= '<div class="jobblock">';
	$o .= '<h2>'.$post_title.'</h2>';
	if($active != ''){
		$o .= $type;
		$o .= $jobDesc;
		$o .= $btn;
	} else {
		$o .= '<p class="non">This posting is no longer active.</p>';
	}
	$o .= '</div>';
	//
  $o .= '</section>';

 // output
 return $o;
}
add_shortcode('career_single', 'career_single_shortcode');

// about child pages
function aboutChildPages_shortcode(){
	$id = get_the_id();
	$args = array(
	  'post_type'      	=> 'page',
		'post_status'			=> 'publish',
	  'posts_per_page' 	=> -1,
	  'post_parent'    	=> $id,
	  'order'          	=> 'ASC',
	  'orderby'        	=> 'menu_order',
	);

	$parent = new WP_Query( $args );
	$pageCount = 0;

	if ( $parent->have_posts() ) {
		$o .='<section class="child-pages layout-builder">';
		$o .='<div class="columns is-multiline is-mobile">';
		$o .='<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
		$o .='<ul class="nav-blocks childpages service-children">';
		while ( $parent->have_posts() ) : $parent->the_post();
			//vars
			$pageCount++;
			$title 			= get_the_title();
			$oTitle 		= get_field('title_override');
			$linkTitle 	= get_field('link_title');
			$id					= get_the_id();
			$link				= get_the_permalink();
			$linkText		= get_field('service_link_text');
			$linkAfter 	= get_field('more_link_after', 'options');
			$summary 		= get_field('service_description');
			$pageIcon 	= get_field('service_icon');
			$pageImage 	= get_field('service_image');

			//
			$o .= '<li id="parent-'.$id.'" class="animated fadeInUp _'.$pageCount.'">';

			if($pageIcon != ''){
				$o .= '<div class="page-asset"><a href="'.$link.'" title="'.$title.'"><div><img src="'.$pageIcon['url'].'" alt="'.$title.'"></div></a></div>';
			}

			$o .= '<div class="content">';
			// title
			if($oTitle){
				$o .= '<h3><a href="'.$link.'" title="'.$oTitle.'">'.$oTitle.'</a></h3>';
			} else {
				$o .= '<h3><a href="'.$link.'" title="'.$title.'">'.$title.'</a></h3>';
			}
			// end title

			// summary content
			if($summary != ''){
				$o .= $summary;
			}
			// close content

			// buttons
			$o .= '<div class="button-block">';
			if($linkText != ''){
				$o .= '<a href="'.$link.'" title="'.$title.'" class="more">'.$linkText.$linkAfter.'</a>';
			} else {
				$o .= '<a href="'.$link.'" title="'.$title.'" class="more">Learn More'.$linkAfter.'</a>';
			}
			$o .= '</div>';
			// close buttons

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
add_shortcode('aboutChildPages', 'aboutChildPages_shortcode');

// service child pages
function serviceChildPages_shortcode(){
	$id = get_the_id();
	$args = array(
	  'post_type'      	=> 'page',
		'post_status'			=> 'publish',
	  'posts_per_page' 	=> -1,
	  'post_parent'    	=> $id,
	  'order'          	=> 'ASC',
	  'orderby'        	=> 'menu_order',
	);

	$parent = new WP_Query( $args );
	$pageCount = 0;

	if ( $parent->have_posts() ) {
		$o .='<section class="child-pages layout-builder">';
		$o .='<div class="columns is-multiline is-mobile">';
		$o .='<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
		$o .='<ul class="nav-blocks childpages service-children">';
		while ( $parent->have_posts() ) : $parent->the_post();
			//vars
			$pageCount++;
			$title 			= get_the_title();
			$oTitle 		= get_field('title_override');
			$linkTitle 	= get_field('link_title');
			$id					= get_the_id();
			$link				= get_the_permalink();
			$linkText		= get_field('service_link_text');
			$linkAfter 	= get_field('more_link_after', 'options');
			$summary 		= get_field('service_description');
			$pageIcon 	= get_field('service_icon');
			$pageImage 	= get_field('service_image');

			//
			$o .= '<li id="parent-'.$id.'" class="animated fadeInUp _'.$pageCount.'">';

			if($pageIcon != ''){
				$o .= '<div class="page-asset"><a href="'.$link.'" title="'.$title.'"><div><img src="'.$pageIcon['url'].'" alt="'.$title.'"></div></a></div>';
			}

			$o .= '<div class="content">';
			// title
			if($oTitle){
				$o .= '<h3><a href="'.$link.'" title="'.$oTitle.'">'.$oTitle.'</a></h3>';
			} else {
				$o .= '<h3><a href="'.$link.'" title="'.$title.'">'.$title.'</a></h3>';
			}
			// end title

			// summary content
			if($summary != ''){
				$o .= $summary;
			}
			// close content

			// buttons
			$o .= '<div class="button-block">';
			if($linkText != ''){
				$o .= '<a href="'.$link.'" title="'.$title.'" class="more">'.$linkText.$linkAfter.'</a>';
			} else {
				$o .= '<a href="'.$link.'" title="'.$title.'" class="more">Learn More'.$linkAfter.'</a>';
			}
			$o .= '</div>';
			// close buttons

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
add_shortcode('serviceChildPages', 'serviceChildPages_shortcode');


function projectBlocks_shortcode(){
	$featured_projects = get_field('project_organization');
	if( $featured_projects ):
		$o .='<section class="child-pages layout-builder gradient">';
		$o .='<div class="columns is-multiline is-mobile">';
		$o .='<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
		$o .='<ul class="nav-blocks childpages">';
		//
    foreach( $featured_projects as $featured_project ):
			//vars
			$pageCount++;
			$title 			= get_the_title($featured_project->ID);
			$id					= get_the_id($featured_project->ID);
			$location		= get_field('project_location', $featured_project->ID);
			$summary 		= get_field('project_summary', $featured_project->ID);
			$link				= get_the_permalink($featured_project->ID);
			$summary 		= get_field('project_summary', $featured_project->ID);
			$heroType		= get_field('hero_media_type', $featured_project->ID);
			$heroImage 	= get_field('hero_image', $featured_project->ID);
			$heroVideo	= get_field('hero_video', $featured_project->ID);
			$locationIc = get_field('location_icon', 'options');
			$linkAfter 	= get_field('more_link_after', 'options');
			$featSize   = "project-image";
	    $image      = wp_get_attachment_image_src( $heroImage['id'], $featSize );

			//
			$o .= '<li id="parent-'.$id.'" class="animated fadeInUp _'.$pageCount.'">';

			if($heroType == 'videoHero'){
				$o .= '<div class="page-asset">';
				$o .= '<a href="'.$link.'" title="'.$title.'">';
				$o .= '<video width="100%" height="100%" class="video" muted playsinline autoplay>';
				$o .= '<source src="'.$heroVideo['url'].'" type="video/mp4">';
				$o .= '</video>';
				$o .= '</a>';
				$o .= '</div>';
				//
			} else {
				$o .= '<div class="page-asset">';
				$o .= '<a href="'.$link.'" title="'.$title.'">';
				$o .= '<img src="'.$image['0'].'" alt="'.$title.'">';
				$o .= '</a>';
				$o .= '</div>';
			}
			$o .= '<div class="content">';
			// title
			$o .= '<h3><a href="'.$link.'" title="'.$title.'">'.$title.'</a></h3>';
			// end title

			// project meta data
			$o .= '<div class="meta">';
			if($location){
				$o .= '<div>'.$locationIc.$location.'</div>'; // location
			}
			$o .= '</div>';
			$o .= '<hr class="cb">';
			// end project meta data

			// summary content
			if($summary != ''){
				$o .= $summary;
			}
			// close content

			// buttons
			$o .= '<div class="button-block">';
			$o .= '<a href="'.$link.'" title="'.$title.'" class="more">View Project'.$linkAfter.'</a>';
			$o .= '</div>';
			// close buttons

			$o .= '</div>';
			$o .= '</li>';

		endforeach;
		$o .= '</ul>';
		$o .= '</div>';
		$o .= '</div>';
		$o .= '</section>';
	endif;


	// output
	return $o;
}
add_shortcode('projectBlocks', 'projectBlocks_shortcode');

function childPageBlocks_shortcode(){
	$id = get_the_id();
	$args = array(
	  'post_type'      	=> 'page',
		'post_status'			=> 'publish',
	  'posts_per_page' 	=> -1,
	  'post_parent'    	=> $id,
	  'order'          	=> 'ASC',
	  'orderby'        	=> 'menu_order',
	);

	$parent = new WP_Query( $args );
	$pageCount = 0;

	if ( $parent->have_posts() ) {
		$o .='<section class="child-pages layout-builder gradient">';
		$o .='<div class="columns is-multiline is-mobile">';
		$o .='<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
		$o .='<ul class="nav-blocks childpages">';
		while ( $parent->have_posts() ) : $parent->the_post();
			//vars
			$pageCount++;
			$title 			= get_the_title();
			$override 	= get_field('title_override');
			$oTitle 		= get_field('title');
			$linkTitle 	= get_field('link_title');
			$id					= get_the_id();
			$link				= get_the_permalink();
			$linkText		= get_field('link_text');
			$linkAfter 	= get_field('more_link_after', 'options');
			$summary 		= get_field('service_description');
			$repeater 	= get_field('layout_builder', $id);
			$pageAsset 	= get_field('service_image');
			$pageAssetP = get_field('service_image_placeholder', 'options');

			//
			$o .= '<li id="parent-'.$id.'" class="animated fadeInUp _'.$pageCount.'">';

			if($pageAsset != ''){
				$o .= '<div class="page-asset"><a href="'.$link.'" title="'.$title.'"><img src="'.$pageAsset['url'].'" alt="'.$title.'"></a></div>';
			}

			$o .= '<div class="content">';
			// title
			if($override == 'yes'){
				$o .= '<h3><a href="'.$link.'" title="'.$title.'">'.$oTitle.'</a></h3>';
			} else {
				$o .= '<h3><a href="'.$link.'" title="'.$title.'">'.$title.'</a></h3>';
			}
			// end title

			// summary content
			if($summary != ''){
				$o .= $summary;
			}
			// close content

			// buttons
			$o .= '<div class="button-block">';
			if($linkText != ''){
				$o .= '<a href="'.$link.'" title="'.$title.'" class="more">'.$linkText.$linkAfter.'</a>';
			} else {
				$o .= '<a href="'.$link.'" title="'.$title.'" class="more">Learn More'.$linkAfter.'</a>';
			}
			$o .= '</div>';
			// close buttons

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
add_shortcode('childPageBlocks', 'childPageBlocks_shortcode');


// dual column callouts
function dualCCallouts_shortcode(){
	//contact information
	echo '<section class="fifty-percents layout-builder">';
	echo do_shortcode('[hiringBlock]');
	echo do_shortcode('[startingBlock]');
	echo '</section>';
}
add_shortcode('dualCCallouts', 'dualCCallouts_shortcode');


// contact form
function contactForm_shortcode(){
	//contact information
	echo '<div class="form-modal contact-modal" id="contactForm" style="display: none">';
	echo do_shortcode('[contact-form-7 id="5" title="Contact Us"]');
	echo '</section>';
}
add_shortcode('contactForm', 'contactForm_shortcode');


function quoteForm_shortcode(){
	//contact information
	echo '<div class="form-modal quote-modal" id="quoteForm" style="display: none">';
	echo do_shortcode('[contact-form-7 id="780" title="Quote"]');
	echo '</section>';
}
add_shortcode('quoteForm', 'quoteForm_shortcode');


//service projects - displays first 3
function projectsServiceBlock_shortcode(){
	$projectsBlockTitle		= 'Recently Completed Projects';
	$projectsBlockMore 		= 'View All Projects';
	$projectsFeatured			= get_field('featured_projects', 'options');
	$linkAfter 						= get_field('more_link_after', 'options');

	//projects
	$featured_projects = get_field('featured_projects');
	if( $featured_projects ):
		$projects .= '<section class="projectBlock service-projects">';
		$projects .= '<div class="columns is-multiline is-mobile">';
		$projects .= '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
		if($projectsBlockTitle){
			$projects .= '<div class="block-title">';
			$projects .= $projectsBlockTitle;
			$projects .= '</div>';
		}
		$projects .= '<a class="more link" href="/our-projects/" title="'.$projectsBlockMore.'">'.$projectsBlockMore.$linkAfter.'</a>';
		$projects .= '</div>';
		$projects .= '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
		$projects .= '<ul class="projects">';
		$projectCount = '0';
    foreach( $featured_projects as $featured_project ):
			$projectCount++;
			if($projectCount <= '3'){
		    $post_id 					= get_the_ID($featured_project->ID);
				$projectTitle 		= get_the_title($featured_project->ID);
				$projectLink 			= get_the_permalink($featured_project->ID);
				$projectMediaType = get_field('hero_media_type', $featured_project->ID);
				$projectImg				= get_field('hero_image', $featured_project->ID);
				$projectVideo			= get_field('hero_video', $featured_project->ID);
				$projectLoc				= get_field('project_location', $featured_project->ID);
				$projectImgPH			= get_field('service_image_placeholder', 'options');

				if($projectLoc) {
					$loc = '<div>'.$projectLoc.'</div>';
				}
				//
	      $project .= '<li>';
				$project .= '<a href="'.$projectLink.'" title="'.$projectTitle.'">';
				if($projectMediaType == 'videoHero') {
					$project .= '<div class="thumbnail">';
					$project .= '<video width="100%" height="100%" class="video" muted playsinline autoplay>';
					$project .= '<source src="'.$projectVideo['url'].'" type="video/mp4">';
					$project .= '</video>';
					$project .= '</div>';
				} else {
					$project .= '<div class="thumbnail"><img src="'.$projectImg['url'].'" alt="'.$projectTitle.'"></div>';
				}
				$project .= '<div class="title">'.$projectTitle.$loc.'</div>';
				$project .= '</a>';
	      $project .= '</li>';
			}
    endforeach;
		$projects	.= $project;
		$projects .= '</ul>';
		$projects .= '</div>';
		$projects .= '</div>';
		$projects .= '</section>';
	endif;

 // output
 return $projects;
}
add_shortcode('projectsServiceBlock', 'projectsServiceBlock_shortcode');

function homeServices_shortcode(){
	$id = get_the_id();
	$args = array(
	  'post_type'      	=> 'page',
		'post_status'			=> 'published',
	  'posts_per_page' 	=> 4,
	  'post_parent'    	=> 18,
	  'order'          	=> 'ASC',
	  'orderby'        	=> 'menu_order',
	);

	$parent = new WP_Query( $args );
	$pageCount = 0;

	if ( $parent->have_posts() ) {
		$o .='<ul class="shattered-elements">';
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
			$pimage 		= get_field('background_image');
			$dimage 		= get_field('default_page_image', 'options');
			$simage 		= get_field('staggered_image');
			$blockType 	= get_field('block_type');
			$linkAfter 	= get_field('more_link_after', 'options');

			//
			$o .= '<li>';
			$o .= '<a href="'.$link.'" title="'.$title.'">';
			$o .= '<div class="image-holder">';
			if($simage != ''){
			$o .= '<img src="'.$simage['url'].'" alt="'.$title.'">';
			} else {
			$o .= '<img src="'.$dimage['url'].'" alt="'.$title.'">';
			}
			$o .= '<div class="glass-1"></div>';
			$o .= '<div class="glass-2"></div>';
			$o .= '</div>';
			if($override != 'yes'){
				$o .= '<h4>'.$title.'</h4>';
			} else {
				$o .= '<h4>'.$oTitle.'</h4>';
			}
			if($content != ''){
			$o .= '<p>'.$content.'</p>';
			} else {
			$o .= '<p>'.$leadIn.'</p>';
			}
			$o .= '<div class="more">Learn More'.$linkAfter.'</div>';
			$o .= '</a>';
			$o .= '</li>';

		endwhile;
		$o .= '</ul>';
	}
	wp_reset_postdata();

	// closing service
	$title 			= get_the_title(26);
	$override 	= get_field('title_override', 26);
	$oTitle 		= get_field('title', 26);
	$leadIn 		= get_field('lead_in_content', 26);
	$content 		= get_field('content', 26);
	$link				= get_the_permalink(26);
	$bgImg			= get_field('homepage_block_background', 26);
	$pimage 		= get_field('background_image', 26);
	$dimage 		= get_field('default_page_image', 'options');
	$simage 		= get_field('staggered_image', 26);
	$blockType 	= get_field('block_type', 26);
	$linkAfter 	= get_field('more_link_after', 'options');

	$e .= '<div class="additional service-block">';
	$e .= '<div class="columns is-multiline is-mobile">';
	$e .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen">&nbsp;</div>';
	$e .= '<div class="column is-12-mobile is-8-tablet is-7-desktop is-7-widescreen">';
	$e .= '<div class="cont">';
	if($override != 'yes'){
		$e .= '<h4><a href="'.$link.'" title="'.$title.'">'.$title.'</a></h4>';
	} else {
		$e .= '<h4><a href="'.$link.'" title="'.$oTitle.'">'.$oTitle.'</a></h4>';
	}
	$e .= $content;
	$e .= '<a href="'.$link.'" title="'.$oTitle.'" class="more">Learn More'.$linkAfter.'</a>';
	$e .= '</div>';
	$e .= '</div>';
	$e .= '<div class="column is-12-mobile is-4-tablet is-3-desktop is-3-widescreen">';
	$e .= '<div class="image-holder">';
	$e .= '<img src="{!! $globalvalue->imagepath !!}placeholder-pg.png" alt="" class="static-img">';
	$e .= '<div class="mask-circle" style="background-image: url('.$bgImg['url'].')"></div>';
	$e .= '<div class="bg-circle"></div>';
	$e .= '</div>';
	$e .= '</div>';
	$e .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen">&nbsp;</div>';
	$e .= '</div>';
	$e .= '</div>';

	// output
	echo $o;
	echo $e;
}
add_shortcode('homeServices', 'homeServices_shortcode');


?>
