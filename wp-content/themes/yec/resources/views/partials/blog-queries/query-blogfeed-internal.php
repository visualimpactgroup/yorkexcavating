<?php
$sitePath					  = get_field('site_path', 'options');

// feed statements
$FeedshowDate         = 'false';
$FeedshowAuthor       = 'false';
$FeedshowCat          = 'false';
$FeedshowExc          = 'false';
// Open Blog Feed
$postCount            = get_field('number_of_posts', 'options');
$feedAlignment        = get_field('internal_blog_feed_alignment', 'options');
$continueLinkIcon     = get_field('more_link_after', 'options');

$args = array(
  'post_type'         => 'our-blog',
  'posts_per_page'    => $postCount,
  'post_status'       => 'publish',
  'orderby'           => 'date',
  'order'             => 'DESC',
);
$category_posts = new WP_Query($args);

if($category_posts->have_posts()) :
  // blog feed title
  $feedTitle          = get_field('internal_blog_title', 'options');
  $feedLink           = get_field('link_to_blog', 'options');
  if($feedTitle != ''){
    $o .= '<div class="column is-12 blogtitle">';
    $o .= '<div class="blog-title">'.$feedTitle.'</div>';
    if($feedLink != ''){
      $o .= '<a class="more" href="'.$feedLink['url'].'" title="'.$feedLink['title'].'" target="'.$feedLink['target'].'">'.$feedLink['title'].$continueLinkIcon.'</a>';
    }
    $o .= '</div>';
  }
  //

  $value              = get_field('feed_meta_data_settings', 'options');
  $loopCount          = 0;
  while($category_posts->have_posts()) :
     $category_posts->the_post();
     include($sitePath.'/resources/views/partials/blog-queries/query-blogmeta.php');
     // Blog Layout
     $imgLookup         = get_field('featured_image_lookup', 'options');
     $customImg         = get_field('custom_image_field_name', 'options');
     // start loop
     $postInclu         = get_field('feed_meta_data_settings', 'options');
     //
     $permalink 				= get_the_permalink();
     $posttitle 				= get_the_title();
     $postId            = get_the_id();
     $ftImg 						= get_the_post_thumbnail('medium');
     $ctImg 						= get_field('article_image', $postId);
     $phImg 						= get_field('default_blog_image', 'options');
     $featSize          = "project-image";
     $imageStandard     = wp_get_attachment_image_src( $ftImg['id'], $featSize );
     $imageFeatured     = wp_get_attachment_image_src( $ctImg['id'], $featSize );
     $imagePlaceholder  = wp_get_attachment_image_src( $phImg['id'], $featSize );
     //
     if($postCount == '4'){
       $o .= '<div class="column is-12-mobile is-6-tablet is-3-desktop is-3-widescreen">';
     } else {
       $o .= '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
     }

     $o .= '<div class="blog-article">';
     // image
     $o .= '<a href="'.$permalink.'" title="'.$posttitle.'">';
     if($imgLookup == 'featuredImg'){
       // standard featured image
       if($ftImg != ''){
         $o .= '<div class="article-img"><img src="'.$imageStandard[0].'" alt="'.$posttitle.'"></div>';
       } else {
         $o .= '<div class="article-img"><img src="'.$imagePlaceholder[0].'" alt="'.$posttitle.'"></div>';
       }
     } else {
       // custom field override
       if($ctImg != ''){
         $o .= '<div class="article-img"><img src="'.$imageFeatured[0].'" alt="'.$posttitle.'"></div>';
       } else {
         $o .= '<div class="article-img"><img src="'.$imagePlaceholder[0].'" alt="'.$posttitle.'"></div>';
       }
     }

     $o .= '</a>';
     // end image
     // title
     $o .= '<div class="article-title">';
     $o .= '<a href="'.$permalink.'" title="'.$posttitle.'">';
     $o .= $posttitle;
     $o .= '</a>';
     $o .= '</div>';
     // meta
     $o .= $mdo;

     if(in_array('date', $value)){
       $FeedshowDate = 'true';
       if($FeedshowDate == 'true'){
         $o .= '<div class="data date">';
         // icon only
         if($dateType == 'icon'){
           $o .= '<div class="meta-icon">'.$dateIcon.' '.get_the_date($postDate).'</div>';
         }
         // text only
         if($dateType == 'text'){
           $o .= '<div class="meta-text">'.$dateText.' '.get_the_date($postDate).'</div>';
         }
         // both
         if($dateType == 'both'){
           $o .= '<div class="meta-icon">'.$dateIcon.'</div><div class="meta-text">'.$dateText.' '.get_the_date($postDate).'</div>';
         }
         $o .= '</div>';
       }
     }

     if(in_array('author', $value)){
       $FeedshowAuthor = 'true';
       if($FeedshowAuthor == 'true'){
         $o .= $mda;
       }
     }

     if(in_array('categories', $value)){
       $FeedshowCat = 'true';
       if($FeedshowCat == 'true'){
         $o .= $mdc;
       }
     }

     $o .= $mdc;
     //end meta


     $o .= '<div class="article-cont">';
     //excerpt
     if(get_field('article_excerpt')){
       $FeedshowExc       = 'true';
       if($FeedshowExc == 'true'){
         $excerpt         = get_field('article_excerpt');
         $continueLink    = get_field('continue_link_title', 'options');

         $o .= '<div class="excerpt">';
         $o .= '<p>';
         $o .= wp_trim_words( $excerpt, 20, '...' );
         $o .= '</p>';
         $o .= '</div>';
       }
     }
     //

     if($continueLink != ''){
       $o .= '<a class="continue" href="'.$permalink.'" title="'.$continueLink.'">'.$continueLink.$continueLinkIcon.'</a>';
     } else {
       $o .= '<a class="continue" href="'.$permalink.'" title="'.$continueLink.'">Continue'.$continueLinkIcon.'</a>';
     }
     $o .= '</div>';
     $o .= '</div>';
     $o .= '</div>';

  endwhile;
  // end loop

  echo '<section class="internal-blog-feed blog-feed-items '.$feedAlignment.'"><div class="columns is-mobile is-multiline is-paddingless">';
  echo $o;
  echo '</div></section>';
  wp_reset_postdata();
endif;
// Close Blog Feed

?>
