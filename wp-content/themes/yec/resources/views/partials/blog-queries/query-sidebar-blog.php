<?php
$sitePath							= get_field('site_path', 'options');
include($sitePath.'/resources/views/partials/query-blogmeta.php');

// sidebar statements
$SidebarshowDate     = 'false';
$SidebarshowAuthor   = 'false';
$SidebarshowCat      = 'false';
$SidebarshowExc      = 'false';


//enews
//if($newsletterForm){
$newsletterCont       = get_field('newsletter_content', 'options');
$newsletterForm       = get_field('newsletter_shortcode', 'options');
$o .= '<div class="enew-block">';
$o .= $newsletterCont;
$o .= do_shortcode($newsletterForm);
$o .= '</div>';
//}
//

// sidebar
if (have_rows('sidebar_blocks', 'options')) {
  while(have_rows('sidebar_blocks', 'options')) : the_row();
  $value                = get_sub_field('post_includes', 'options');
  $blockType            = get_sub_field('block_type','options');
  $blockTitle           = get_sub_field('block_title','options');
  $listStyle            = get_sub_field('list_style_type', 'options');
  $postInclu            = get_sub_field('post_includes', 'options');
  $listForm	            = get_sub_field('list_format', 'options');
  $border               = get_sub_field('border', 'options');
  $borderSty            = get_sub_field('border_type', 'options');
  $excerptTrim			    = get_sub_field('trim_excerpt', 'options');
  $excerptChars         = get_sub_field('excerpt_character_limit', 'options');
  $imgLookup            = get_field('featured_image_lookup', 'options');
  $customImg            = get_field('custom_image_field_name', 'options');


    $o .= '<div class="block style-'.$listStyle.' '.$border.'-'.$borderSty.'">';
    if($blockTitle != ''){
      $o .= '<div class="b-title recent">'.$blockTitle.'</div>';
    }
    //
    if($blockType == 'recentPosts'){
      $args = array(
    		'post_type'       => 'our-blog',
    		'post_status'     => 'publish',
    		'numberposts'			=> '5',
    	);

      $recent_posts = wp_get_recent_posts( $args );

      $o .= '<ul>';
      foreach( $recent_posts as $recent ){
    		//fields
    		$link 						= get_the_permalink($recent["ID"]);
        $title 						= get_the_title($recent["ID"]);
        $ftImg 						= get_the_post_thumbnail($recent["ID"], 'medium');
        $ctImg 						= get_field($customImg, $recent["ID"]);
        $phImg 						= get_field('default_blog_image', 'options');


        $listStyle        = get_sub_field('list_style_type', 'options');
    		$o .= '<li>';
        //echo '<a href="'.$link.'" title="'.$title.'">';

        if($listStyle == 'featImg'){
          echo '<a href="'.$link.'" title="'.$title.'">';
          if($imgLookup == 'featuredImg'){
            // standard featured image
            if($ftImg != ''){
              $o .= '<div class="img"><img src="'.$ftImg['url'].'" alt="'.$title.'"></div>';
            } else {
              $o .= '<div class="img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
            }
          } else {
            // custom field override
            if($ctImg != ''){
              $o .= '<div class="img"><img src="'.$ctImg['url'].'" alt="'.$title.'"></div>';
            } else {
              $o .= '<div class="img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
            }
          }
          $o .= '</a>';
        }

        $o .= '
        <div class="cont">
          <div class="cont-title"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div>
        ';
    		//

        $o .= $mdo;

        if(in_array('date', $value) && ($blockType == 'recentPosts') ){
          $SidebarshowDate = 'true';
          if($SidebarshowDate == 'true'){
            $o .= $mdd;
          }
        }


        if(in_array('author', $value) && ($blockType == 'recentPosts') ){
          $SidebarshowAuthor = 'true';
          if($SidebarshowAuthor == 'true'){
            $o .= $mda;
          }
        }

        if(in_array('categories', $value) && ($blockType == 'recentPosts') ){
          $SidebarshowCat = 'true';
          if($SidebarshowCat == 'true'){
            $o .= $mdc;
          }
        }

        if(in_array('excerpt', $value) && ($blockType == 'recentPosts') ){
          $SidebarshowExc = 'true';
          if($SidebarshowExc == 'true'){
            if($excerptTrim == 'yes'){
              $excerptTrimmed	 = substr($excerpt, 0, $excerptChars);
              $o .= '<p class="exc">'.$excerptTrimmed.'...</p>';
            } else {
              $o .= $mex;
            }
          }
        }
        $o .= $mdc;
        //
        $o .= '</div>';
        //echo '</a>';
    		$o .= '</li>';
    	}
      $o .= '</ul>';
    }

    //


    //by category
    // if($blockType == 'categories'){
    //   $args = array(
    //    'taxonomy'   => 'category',
    //    'orderby'    => 'name',
    //    'order'      => 'ASC',
    //    'exclude'    => 1,
    //   );
    //
    //   $cats = get_categories($args);
    //
    //   $o .= '<ul>';
    //   foreach($cats as $cat) {
    //     $o .= '<li><a href="'.$cat->link.'">'.$cat->name.'</a></li>';
    //   }
    //   $o .= '</ul>';
    // }

    $o .= '</div>';

  endwhile;
}
// Close Sidebar
?>
