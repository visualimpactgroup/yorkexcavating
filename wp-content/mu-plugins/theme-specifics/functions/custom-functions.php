<?php
function my_acf_google_map_api($api) {
    $api['key'] = 'AIzaSyDgyhJOU67jM3wK8gbi-0BtAfhFTQUhc0c';
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyDgyhJOU67jM3wK8gbi-0BtAfhFTQUhc0c');
}

//remove "posts" from WP Admin
function post_remove(){
   remove_menu_page('edit.php');
}
add_action('admin_menu', 'post_remove');


//custom continue link excerpt
function new_excerpt_more($more) {
  global $post;
  $more_after = get_field('more_link_after', 'options');
  $more_text = get_field('excerpt_link_text', 'options');
  $more = $more_text . $more_after;
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more', 11);


function generate_taxonomy_rewrite_rules( $wp_rewrite ) {

    $rules = array();

    $post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );
    $taxonomies = get_taxonomies( array( 'public' => true, '_builtin' => false ), 'objects' );

    foreach ( $post_types as $post_type ) {
        $post_type_name = $post_type->name;
        $post_type_slug = $post_type->rewrite['slug'];

        foreach ( $taxonomies as $taxonomy ) {
            if ( $taxonomy->object_type[0] == $post_type_name ) {
                $terms = get_categories( array( 'type' => $post_type_name, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0 ) );
                foreach ( $terms as $term ) {
                    $rules[$post_type_slug . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
                    $rules[$post_type_slug . '/' . $term->slug . '/page/?([0-9]{1,})/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug . '&paged=' . $wp_rewrite->preg_index( 1 );
                }
            }
        }
    }

    $wp_rewrite->rules = $rules + $wp_rewrite->rules;

}

add_action('generate_rewrite_rules', 'generate_taxonomy_rewrite_rules');



function get_video_thumbnail_uri( $video_uri ) {
	$thumbnail_uri = '';

	// determine the type of video and the video id
	$video = parse_video_uri( $video_uri );

	// get youtube thumbnail
	if ( $video['type'] == 'youtube' )
		$thumbnail_uri = 'http://img.youtube.com/vi/' . $video['id'] . '/mqdefault.jpg';
	// get vimeo thumbnail
	if( $video['type'] == 'vimeo' )
		$thumbnail_uri = get_vimeo_thumbnail_uri( $video['id'] );
	// get wistia thumbnail
	if( $video['type'] == 'wistia' )
		$thumbnail_uri = get_wistia_thumbnail_uri( $video_uri );
	// get default/placeholder thumbnail
	if( empty( $thumbnail_uri ) || is_wp_error( $thumbnail_uri ) )
		$thumbnail_uri = '';

	//return thumbnail uri
	return $thumbnail_uri;

}


/**
 * Parse the video uri/url to determine the video type/source and the video id
 */
function parse_video_uri( $url ) {

	// Parse the url
	$parse = parse_url( $url );

	// Set blank variables
	$video_type = '';
	$video_id = '';

	// Url is http://youtu.be/xxxx
	if ( $parse['host'] == 'youtu.be' ) {

		$video_type = 'youtube';

		$video_id = ltrim( $parse['path'],'/' );

	}

	// Url is http://www.youtube.com/watch?v=xxxx
	// or http://www.youtube.com/watch?feature=player_embedded&v=xxx
	// or http://www.youtube.com/embed/xxxx
	if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) {

		$video_type = 'youtube';

		parse_str( $parse['query'] );

		$video_id = $v;

		if ( !empty( $feature ) )
			$video_id = end( explode( 'v=', $parse['query'] ) );

		if ( strpos( $parse['path'], 'embed' ) == 1 )
			$video_id = end( explode( '/', $parse['path'] ) );

	}

	// Url is http://www.vimeo.com
	if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) {

		$video_type = 'vimeo';

		$video_id = ltrim( $parse['path'],'/' );

	}
	$host_names = explode(".", $parse['host'] );
	$rebuild = ( ! empty( $host_names[1] ) ? $host_names[1] : '') . '.' . ( ! empty($host_names[2] ) ? $host_names[2] : '');
	// Url is an oembed url wistia.com
	if ( ( $rebuild == 'wistia.com' ) || ( $rebuild == 'wi.st.com' ) ) {

		$video_type = 'wistia';

		if ( strpos( $parse['path'], 'medias' ) == 1 )
				$video_id = end( explode( '/', $parse['path'] ) );

	}

	// If recognised type return video array
	if ( !empty( $video_type ) ) {
		$video_array = array(
			'type' => $video_type,
			'id' => $video_id
		);
		return $video_array;
	} else {
		return false;
	}
}

function get_youtube_title($video_id){
  $youtubeAPI = get_field('youtube_api', 'options');
  $html = '//www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key='.$youtubeAPI.'&part=snippet';
  $response = file_get_contents($html);
  $decoded = json_decode($response, true);
  foreach ($decoded['items'] as $items) {
    $title = $items['snippet']['title'];
    return $title;
  }
}

function covtime($youtube_time){
  preg_match_all('/(\d+)/',$youtube_time,$parts);
  $hours = $parts[0][0];
  $minutes = $parts[0][1];
  $seconds = $parts[0][2];
  if($seconds != 0) {
    return '('.$hours.':'.$minutes.':'.$seconds.')';
  } else {
    return '('.$hours.':'.$minutes.')';
  }
}


// pagination
function enollo_pagination($args = array()) {
  $defaults = array(
    'echo' => true,
    'query' => $GLOBALS['wp_query'],
    'show_all' => false,
    'prev_next' => true,
    'prev_text' => __('Previous', 'enollo'),
    'next_text' => __('Next Page', 'enollo'),
  );

  $args = wp_parse_args($args, $defaults);
  extract($args, EXTR_SKIP);
  // Stop execution if there's only 1 page
  if ($query->max_num_pages <= 1) {
    return;
  }

  $pagination = '';
  $links = array();

  $paged = max(1, absint($query->get('paged')));
  $max = intval($query->max_num_pages);

  if ($show_all) {
    $links = range(1, $max);
  } else {
  // Add the pages before the current page to the array
  if ($paged >= 2 + 1) {
    $links[] = $paged - 2;
    $links[] = $paged - 1;
  }

  // Add current page to the array
  if ($paged >= 1) {
    $links[] = $paged;
  }

  // Add the pages after the current page to the array
  if (( $paged + 2 ) <= $max) {
    $links[] = $paged + 1;
    $links[] = $paged + 2;
  }
  }

  $pagination .= "\n" . '<nav class="pagination is-left" role="navigation" aria-label="pagination">' . "\n";
  // Previous Post Link
  if ($prev_next && get_previous_posts_link()) {
    $pagination .= sprintf('<div class="pagination-previous">%s</div>', get_previous_posts_link($prev_text . '<span class="screen-reader-text">' . $prev_text . '</span>'));
    //$pagination .= sprintf( '<a class="pagination-previous prev">' . $prev_text . '</a>', get_previous_posts_link('<span class="screen-reader-text">' . $prev_text . '</span>') );
  }

    // Next Post Link
    if ($prev_next && get_next_posts_link() && $paged <= $max) {
      $pagination .= sprintf('<div class="pagination-next">%s</div>' . "\n", get_next_posts_link($next_text . '<span class="screen-reader-text">' . $next_text . '</span>'));
    }

    $pagination .= "\n" . '<ul class="pagination-list">';
    // Link to first page, plus ellipses if necessary
    if (!in_array(1, $links)) {
      $class = 1 == $paged ? ' class="active"' : '';
      $pagination .= sprintf('<li%s><a class="pagination-link" href="%s">%s</a></li>', $class, esc_url(get_pagenum_link(1)), '1');
      $pagination .= "\n";
      if (!in_array(2, $links)) {
          $pagination .= '<li class="ellipsis"><span>' . __('&hellip;') . '</span></li>';
      }
      $pagination .= "\n";
    }
    // Link to current page, plus $mid_size pages in either direction if necessary
    sort($links);
    foreach ((array) $links as $link) {
      $class = $paged == $link ? ' class="active"' : '';
      $pagination .= sprintf('<li%s><a class="pagination-link" href="%s">%s</a></li>', $class, esc_url(get_pagenum_link($link)), $link);
      $pagination .= "\n";
    }
    // Link to last page, plus ellipses if necessary
    if (!in_array($max, $links)) {
      if (!in_array($max - 1, $links)) {
        $pagination .= '<li><span class="pagination-ellipsis">' . __('&hellip;') . '</span></li>';
        $pagination .= "\n";
      }
      $class = $paged == $max ? ' class="active"' : '';
      $pagination .= sprintf('<li%s><a class="pagination-link" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
      $pagination .= "\n";
    }

    $pagination .= "</ul></nav><!-- /.pagination -->\n";

    return $pagination;
}

// Custom Wordpress WYSIWYG Editor Options
function add_style_select_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'add_style_select_buttons' );


function site_custom_styles( $init_array ) {

    $style_formats = array(
        // These are the custom styles
        array(
            'title' => 'Video Snippet',
            'block' => 'span',
            'classes' => 'video-snippet',
            'wrapper' => false,
        ),
        array(
            'title' => 'Dual Column UL',
            'block' => 'ul',
            'classes' => 'dual-column',
            'wrapper' => true,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'site_custom_styles' );
add_filter( 'run_wptexturize', '__return_false' );



// login styles
function custom_login(){
  $bgColor      = get_field('background_color', 'options');
  $logo         = get_field('logo', 'options');
  $primaryLogo  = get_field('colored_logo', 'options');
  $whiteLogo    = get_field('white_logo', 'options');

  echo '<link rel="stylesheet" type="text/css" href="'. get_bloginfo('stylesheet_directory') . '/login.css" />';
  // background color
  if($bgColor != ''){
    echo '<style>body.login { background-color: '.$bgColor.'; }</style>';
  }

  // logo
  if($logo == 'primaryLogo'){
    echo '<style>body.login div#login h1 a { background-image: url('.$primaryLogo['url'].'); }</style>';
  } else {
    echo '<style>body.login div#login h1 a { background-image: url('.$whiteLogo['url'].'); }</style>';
  }
}
add_action('login_head', 'custom_login');


function post_search( $form, $value = "What Can We Help You With", $post_type = 'post' ) {
    $form_value = (isset($value)) ? $value : attribute_escape(apply_filters('the_search_query', get_search_query()));
    $searchicon = get_field('search_icon', 'options');

	ob_start();
?>
    <form class="search-styles" method="get" id="post-searchform" action="<?= get_option('home') ?>/">
      <div class="form-classes">
        <div class="field search-field">
          <input type="hidden" name="post_type" value="<?php echo $post_type; ?>" />
          <input type="search" class="search-field input input--search" placeholder="<?= $form_value ?>" id="s" value="" name="s" title="What Can We Help You With?">
          <button class="submit-search" type="submit" id="searchsubmit">
            <?= $searchicon ?>
            <span class="screen-reader-text">Search</span>
          </button>
        </div>
      </div>
    </form>
<?php
  $form = ob_get_clean();
  return $form;
}
?>
