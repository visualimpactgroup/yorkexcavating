<?php
//////////
//BLOG & NEWS SHORTCODES
//
function headerMeta_shortcode(){
	$sitePath							= get_field('site_path', 'options');
	include($sitePath.'/resources/views/partials/blog-queries/query-header-blog.php');
}
add_shortcode('headerMeta', 'headerMeta_shortcode');

function sidebar_shortcode(){
	$includeSidebar 			= get_field('include_sidebar', 'options');
	$sitePath							= get_field('site_path', 'options');
	if($includeSidebar == 'yes'){
		$o .= '<div class="sidebar">';
		include($sitePath.'/resources/views/partials/blog-queries/query-sidebar-blog.php');
		$o .= '</div>';

		return $o;
	}
}
add_shortcode('sidebar', 'sidebar_shortcode');


/////
function blogPosts_shortcode(){
	$paged 						= (get_query_var("paged")) ? get_query_var("paged") : 1;
	$postPer 					= get_field('posts_per_page', 'options');
	query_posts($query_string."post_type=our-blog&post_status=publish&posts_per_page=$postPer&paged=".$paged);
	$count 						= $wp_query->found_posts;
	$published_posts 	= wp_count_posts()->publish;
	$posts_per_page 	= get_option('posts_per_page');
	$page_number_max 	= ceil($published_posts / $posts_per_page);
	$sitePath					= get_field('site_path', 'options');
	include($sitePath.'/resources/views/partials/blog-queries/query-blogfeed-main.php');
	echo 'test';
	wp_reset_query();
}
add_shortcode( 'blogPosts', 'blogPosts_shortcode' );

function blogMetaContent_shortcode(){
	$sitePath					= get_field('site_path', 'options');
	include($sitePath.'/resources/views/partials/blog-queries/query-blogmeta.php');
}
add_shortcode( 'blogMetaContent', 'blogMetaContent_shortcode' );


// posts by category
function postsByCategory() {
	$moreLinkAfter = get_field('more_link_after', 'options');
	$allcats = get_categories('child_of=0');
	echo '<ul class="cat-blocks">';
	foreach ($allcats as $cat){
		$args = array(
			'posts_per_page' => -1,
			'category__in' => array($cat->term_id),
			'orderby'    => 'ID',
    	'order'      => 'DESC',
		);

		$customInCatQuery = new WP_Query($args);

		echo '<li>';
		if ($customInCatQuery->have_posts()) {
			$perma = get_category_link($cat->term_id);
			echo '<h3><a href="'.$perma.'" title="'.$cat->name.'">'.$cat->name.'</a></h3>';
			echo '<ul>';
			while ($customInCatQuery->have_posts()) : $customInCatQuery->the_post();
				$permalink = get_the_permalink();
				$title		 = get_the_title();
				echo '<li><a href="'.$permalink.'" title="'.$title.'">'.$title.''.$moreLinkAfter.'</a></li>';
			endwhile;
			echo '</ul>';
			echo '<div class="all"><a href="'.$perma.'" title="'.$cat->name.'">View All'.$moreLinkAfter.'</a></div>';
		}
		echo '</li>';
		wp_reset_query();
	}
	echo '</ul>';

}
add_shortcode('postsByCategory', 'postsByCategory');
// add_filter('postsByCategory', 'postsByCategory_shortcode');

function internalBlogFeed_shortcode(){
	$sitePath							= get_field('site_path', 'options');
	include($sitePath.'/resources/views/partials/blog-queries/query-blogfeed-internal.php');
}
add_shortcode('internalBlogFeed', 'internalBlogFeed_shortcode');


// social sharing
function socialSharing() {
	$socialSharing .= '<ul class="share">';
	$socialSharing .= '<li><div class="button share-button facebook-share-button"><icon class="icon-solid-facebook"><span class="screen-reader-text">Share to Facebook</span></icon></div></li>';
	$socialSharing .= '<li><div class="button share-button twitter-share-button"><icon class="icon-sm-twitter"><span class="screen-reader-text">Share to Twitter</span></icon></div></li>';
	$socialSharing .= '<li><div class="button share-button email-share-button"><icon class="icon-solid-envelope"><span class="screen-reader-text">Share via Email</span></icon></div></li>';
	$socialSharing .= '<li><div class="button share-button sharethis-share-button"><icon class="icon-sharethis"><span class="screen-reader-text">Share this Article</span></icon></div></li>';
	$socialSharing .= '</ul>';
	//
	return $socialSharing;
}
add_shortcode('socialSharing', 'socialSharing');


function mainImage_shortcode(){
	$title 						= get_the_title();
	$ftImg 						= get_the_post_thumbnail('medium');
	$post_object      = get_field('default_image_category');
	$ctImg 						= get_field($customImg);
	$phImg 						= get_field('default_blog_image', 'options');

	// custom field override
	if($post_object != '') {
		$post = $post_object;
		setup_postdata( $post );
		$catImg = get_field('category_image', $post_object->ID);
		$o .= '<div class="article-img"><img src="'.$catImg['url'].'" alt="'.$title.'"></div>';
		wp_reset_postdata();
	} elseif($ctImg != ''){
		$o .= '<div class="article-img"><img src="'.$ctImg['url'].'" alt="'.$title.'"></div>';
	} else {
		$o .= '<div class="article-img"><img src="'.$phImg['sizes']['ph-blog-img'].'" alt="'.$title.'"></div>';
	}

	echo $o;
}
add_shortcode('mainImage', 'mainImage_shortcode');

// author closing tag
function authorTag_shortcode() {
	$post_object      = get_field('default_image_category');
	//
	if($post_object != '') {
		$post = $post_object;
		setup_postdata( $post );
		$catContact = get_field('category_contact_name', $post_object->ID);
		$catTitle		= get_field('contact_title', $post_object->ID);
		$catEmail		= get_field('category_contact_email', $post_object->ID);
		$catPhone		= get_field('category_contact_phone', $post_object->ID);
		$catProfile	= get_field('contact_image', $post_object->ID);
		$isStaff		= get_field('staff_person', $post_object->ID);
		//
		if( have_rows('layout_builder', 314) ){
			$defCount 	= '0';
			while ( have_rows('layout_builder', 314) ) : the_row();
				if( have_rows('staff') ){
					while ( have_rows('staff') ) : the_row();
						$staff_name 			= get_sub_field('staff_name');
						$headshotPH				= get_field('profile_placeholder_image', 'options');
						//echo $staff_name . '=' . $catContact. '<br>';
						if(($isStaff == 'yesStaff') && ($staff_name == $catContact)){
							$staff_title 			= get_sub_field('staff_title');
							$staff_email 			= get_sub_field('email_address');
							$staff_headshot		= get_sub_field('staff_image');
							echo $staff_image;
							//if headshot
							if($staff_headshot != ''){
								$submitter .= '<div class="staff-image">';
								$submitter .= '<img src="'.$staff_headshot['url'].'" alt="'.$staff_name.'">';
								$submitter .= '</div>';
							} else {
								$submitter .= '<div class="staff-image">';
								$submitter .= '<img src="'.$headshotPH['url'].'" alt="'.$staff_name.'">';
								$submitter .= '</div>';
							}

							$submitter .= '<div class="staff-info"><span class="submitted">Article Submitted by:</span><br>';
							// staff name
							$submitter .= '<span>'.$staff_name.'</span>';
								// title
								if($staff_title){
									$submitter .= '<span>, '.$staff_title.'</span>';
								}
								// email
								if($staff_email){
									$submitter .= '<span> | ' .$staff_email.'</span>';
								}
							$submitter .= '</div>';
						}
						// from category block
					endwhile;
				}
			endwhile;
		}

		if($submitter == ''){
			if($catContact != ''){
				//if headshot
				$default++;
				if($default == '1'){
					if($catProfile != ''){
						$submitted .= '<div class="staff-image">';
						$submitted .= '<img src="'.$catProfile['url'].'" alt="'.$catContact.'">';
						$submitted .= '</div>';
					} else {
						$submitted .= '<div class="staff-image">';
						$submitted .= '<img src="'.$headshotPH['url'].'" alt="'.$catContact.'">';
						$submitted .= '</div>';
					}

					$submitted .= '<div class="staff-info"><span class="submitted">Article Submitted by:</span><br>';
					// staff name
					$submitted .= '<span>'.$catContact.'</span>';
						// title
						if($catTitle){
							$submitted .= '<span>, '.$catTitle.'</span>';
						}
						// email
						if($catEmail){
							$submitted .= '<span> | ' .$catEmail.'</span>';
						}
						// phone
						if($catPhone){
							$submitted .= '<span> | ' .$catPhone.'</span>';
						}
					$submitted .= '</div>';
				}
			}
		}
		//
		$author .= '<section class="article-author">';
		$author .= $submitter;
		$author .= $submitted;
		$author .= '</section>';
	}
	return $author;
}
add_shortcode('authorTag', 'authorTag_shortcode');
?>
