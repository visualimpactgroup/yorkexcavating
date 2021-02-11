<?php
$sitePath					= get_field('site_path', 'options');
include($sitePath.'/resources/views/partials/blog-queries/query-blogmeta.php');

// feed statements
$FeedshowDate           = 'false';
$FeedshowAuthor         = 'false';
$FeedshowCat            = 'false';
$FeedshowExc            = 'false';
// Open Blog Feed
if (have_posts()){
  // Blog Layout
  $blogLayout         = get_field('blog_layout', 'options');
  $value              = get_field('feed_meta_data_settings', 'options');
  $imgLookup          = get_field('featured_image_lookup', 'options');
  $customImg          = get_field('custom_image_field_name', 'options');
  $continueLinkIcon   = get_field('more_link_after', 'options');
  $postCount           = 0;
  //

  while ( have_posts() ) : the_post();
    $postInclu        = get_field('feed_meta_data_settings', 'options');
    //
    $permalink 				= get_the_permalink();
    $title 						= get_the_title();
    $ftImg 						= get_the_post_thumbnail('medium');
    $ctImg 						= get_field($customImg);
    $phImg 						= get_field('default_blog_image', 'options');
    //
    $featSize         = "featured-blog-img";
    $image            = wp_get_attachment_image_src( $ctImg['id'], $featSize );
    //

    $postCount++;
    if($postCount == '1'){
      $o .= '<div class="featured-blog">';
      $o .= '<div class="columns is-mobile is-multiline is-paddingless">';
      $o .= '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
      $o .= '<div class="blog-article featured-article">';
      $o .= '<div class="article-content">';
      $o .= '<span class="feat">Featured Article</span>';
      // date
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
      $o .= $mdc;
      // title
      $o .= '<div class="article-title">';
      $o .= '<a href="'.$permalink.'" title="'.$title.'">';
      $o .= $title;
      $o .= '</a>';
      $o .= '</div>';

      //excerpt
      if(in_array('excerpt', $value)){
        $FeedshowExc = 'true';
        if($FeedshowExc == 'true'){
          $excerpt = get_the_excerpt();
          $o .= '<div class="excerpt">';
          $o .= '<p>'.$excerpt.'</p>';
          $o .= '</div>';
        }
      }
      //

      // continue link
      if($continueLink != ''){
        $o .= '<a class="continue" href="'.$permalink.'" title="'.$continueLink.'">'.$continueLink.$continueLinkIcon.'</a>';
      } else {
        $o .= '<a class="continue" href="'.$permalink.'" title="'.$continueLink.'">Continue'.$continueLinkIcon.'</a>';
      }
      //
      $o .= '</div>';

      // $o .= '<div class="column is-12-mobile is-5-tablet is-3-desktop is-3-widescreen">';
      // $o .= include($sitePath.'/resources/views/partials/blog-queries/query-sidebar-blog.php');

      // image
      $o .= '<a href="'.$permalink.'" title="'.$title.'">';
      if($imgLookup == 'featuredImg'){
        // standard featured image
        if($ftImg != ''){
          $o .= '<div class="article-img"><img src="'.$ftImg['url'].'" alt="'.$title.'"></div>';
        } else {
          $o .= '<div class="article-img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
        }
      } else {
        // custom field override
        if($ctImg != ''){
          $o .= '<div class="article-img"><img src="'.$image['0'].'" alt="'.$title.'"></div>';
        } else {
          $o .= '<div class="article-img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
        }
      }

      $o .= '</a>';
      // end image
      $o .= '</div>';
      $o .= '</div>';
      $o .= '</div>';
      $o .= '</div>';
      $o .= '</div>';
  }
  endwhile;

}



// internal posts
// Open Blog Feed
if (have_posts()){
  // Blog Layout
  $blogLayout = get_field('blog_layout', 'options');
  $value      = get_field('feed_meta_data_settings', 'options');
  $imgLookup  = get_field('featured_image_lookup', 'options');
  $customImg  = get_field('custom_image_field_name', 'options');
  $postCount  = 0;
  //
  $o .= '<section class="pagi">';
  $o .= '<div class="columns is-mobile is-multiline is-paddingless">';
  $o .= '<div class="column is-12-mobile is-8-tablet is-8-desktop is-8-widescreen">';
  $o .= '<div class="recent">Recent Posts</div>';
  while ( have_posts() ) : the_post();
    $postInclu        = get_field('feed_meta_data_settings', 'options');
    //
    $permalink 				= get_the_permalink();
    $title 						= get_the_title();
    $ftImg 						= get_the_post_thumbnail('medium');
    $ctImg 						= get_field($customImg);
    $phImg 						= get_field('default_blog_image', 'options');
    //
    $featSize         = "featured-blog-img";
    $image            = wp_get_attachment_image_src( $ctImg['id'], $featSize );
    //
    $postCount++;
    if($postCount != '1'){

      $o .= '<div class="blog-article small-article">';
      // image
      $o .= '<a href="'.$permalink.'" title="'.$title.'">';
      if($imgLookup == 'featuredImg'){
        // standard featured image
        if($ftImg != ''){
          $o .= '<div class="article-img"><img src="'.$ftImg['url'].'" alt="'.$title.'"></div>';
        } else {
          $o .= '<div class="article-img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
        }
      } else {
        // custom field override
        if($ctImg != ''){
          $o .= '<div class="article-img"><img src="'.$image['0'].'" alt="'.$title.'"></div>';
        } else {
          $o .= '<div class="article-img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
        }

      $o .= '</a>';
      // end image

      $o .= '<div class="article-content">';
      // title
      $o .= '<div class="article-title">';
      $o .= '<a href="'.$permalink.'" title="'.$title.'">';
      $o .= $title;
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

      //excerpt
      if(in_array('excerpt', $value)){
        $FeedshowExc = 'true';
        if($FeedshowExc == 'true'){
          $excerpt = get_the_excerpt();
          $perma = get_the_permalink();
          $excerptTrimmed	 = substr($excerpt, 0, 150);
          $o .= '<div class="excerpt">';
          $o .= '<p>'.$excerptTrimmed.'...<br><a class="continue" href="'.$perma.'" title="Continue Reading">Continue'.$moreLinkAfter.'</a>';
          $o .= '</div>';
        }
      } else {
        $o .= '<p>'.$excerptMore.$moreLinkAfter;
        // continue link
        if($continueLink != ''){
          $o .= '<a class="continue" href="'.$permalink.'" title="'.$continueLink.'">'.$continueLink.$continueLinkIcon.'</a>';
        } else {
          $o .= '<a class="continue" href="'.$permalink.'" title="'.$continueLink.'">Continue Reading'.$continueLinkIcon.'</a>';
        }
        $o .= '</p>';
        //
      }

      $o .= '';
      //

      $o .= '</div>';
      $o .= '</div>';

    }
  }
  endwhile;
  $o .= '</div>';
  $o .= '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
  $o .= '<div class="sidebar">';
  include($sitePath.'/resources/views/partials/blog-queries/query-sidebar-blog.php');
  $o .= '</div>';
  $o .= '</div>';
  $o .= '</div>';
  $o .= '</section>';
}
// end first page layout

// secondary page  layout
if (have_posts()){
  // Blog Layout
  $blogLayout = get_field('blog_layout', 'options');
  $desktopCol = get_field('desktop_blog_column_width', 'options');
  $tabletCol  = get_field('tablet_blog_column_width', 'options');
  $mobileCol  = get_field('mobile_blog_column_width', 'options');
  $dualCol    = get_field('dual_column_size', 'options');
  $value      = get_field('feed_meta_data_settings', 'options');
  $imgLookup  = get_field('featured_image_lookup', 'options');
  $customImg  = get_field('custom_image_field_name', 'options');
  //
  $o2 .= '<section class="pagenavigation layout-builder"><div class="columns is-mobile is-multiline is-paddingless">';
    while ( have_posts() ) : the_post();
      $postInclu        = get_field('feed_meta_data_settings', 'options');
      //
      $permalink 				= get_the_permalink();
      $title 						= get_the_title();
      $ftImg 						= get_the_post_thumbnail('medium');
      $ctImg 						= get_field($customImg);
      $phImg 						= get_field('default_blog_image', 'options');
      //

      // open post
      if($blogLayout == 'is-12'){
        // full width
        $o2 .= '<div class="column '.$mobileCol.'-mobile '.$tabletCol.'-tablet '.$desktopCol.'-desktop '.$desktopCol.'-widescreen">';
        $o2 .= '<div class="blog-article featured-article">';
        // image
        $o2 .= '<a href="'.$permalink.'" title="'.$title.'">';
        if($imgLookup == 'featuredImg'){
          // standard featured image
          if($ftImg != ''){
            $o2 .= '<div class="article-img"><img src="'.$ftImg['url'].'" alt="'.$title.'"></div>';
          } else {
            $o2 .= '<div class="article-img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
          }
        } else {
          // custom field override
          if($ctImg != ''){
            $o2 .= '<div class="article-img"><img src="'.$ctImg['url'].'" alt="'.$title.'"></div>';
          } else {
            $o2 .= '<div class="article-img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
          }
        }

        $o2 .= '</a>';
        // end image
        // title
        $o2 .= '<div class="article-title">';
        $o2 .= '<a href="'.$permalink.'" title="'.$title.'">';
        $o2 .= $title;
        $o2 .= '</a>';
        $o2 .= '</div>';
        // meta
        $o2 .= $mdo;
        if(in_array('date', $value)){
          $FeedshowDate = 'true';
          if($FeedshowDate == 'true'){
            $o2 .= $mdd;
          }
        }

        if(in_array('author', $value)){
          $FeedshowAuthor = 'true';
          if($FeedshowAuthor == 'true'){
            $o2 .= $mda;
          }
        }

        if(in_array('categories', $value)){
          $FeedshowCat = 'true';
          if($FeedshowCat == 'true'){
            $o2 .= $mdc;
          }
        }

        $o2 .= $mdc;
        //end meta

        //excerpt
        if(in_array('excerpt', $value)){
          $FeedshowExc = 'true';
          if($FeedshowExc == 'true'){
            $excerpt = get_the_excerpt();
            $o2 .= '<div class="excerpt">';
            $o2 .= '<p>'.$excerpt.'</p>';
            $o2 .= '</div>';
          }
        }
        //

        $o2 .= '</div>';
      } else {
        // if dual-column or half
        if($dualCol == 'three-quarter'){
          $o2 .= '<div class="column is-12-mobile is-5-tablet is-4-desktop is-4-widescreen">';
        } else {
          $o2 .= '<div class="column is-12-mobile is-6-tablet is-6-desktop is-6-widescreen">';
        }

        $o2 .= '<div class="blog-article small-article">';
        // image
        $o2 .= '<a href="'.$permalink.'" title="'.$title.'">';
        if($imgLookup == 'featuredImg'){
          // standard featured image
          if($ftImg != ''){
            $o2 .= '<div class="article-img"><img src="'.$ftImg['url'].'" alt="'.$title.'"></div>';
          } else {
            $o2 .= '<div class="article-img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
          }
        } else {
          // custom field override
          if($ctImg != ''){
            $o2 .= '<div class="article-img"><img src="'.$ctImg['url'].'" alt="'.$title.'"></div>';
          } else {
            $o2 .= '<div class="article-img"><img src="'.$phImg['url'].'" alt="'.$title.'"></div>';
          }
        }
        $o2 .= '</a>';
        // end image
        $o2 .= '</div>';
        $o2 .= '</div>';
        if($dualCol == 'three-quarter'){
          $o2 .= '<div class="column is-12-mobile is-7-tablet is-8-desktop is-8-widescreen">';
        } else {
          $o2 .= '<div class="column is-12-mobile is-6-tablet is-6-desktop is-6-widescreen">';
        }
        $o2 .= '<div class="blog-article small-article">';
        // title
        $o2 .= '<div class="article-title">';
        $o2 .= '<a href="'.$permalink.'" title="'.$title.'">'.$title.'</a>';
        $o2 .= '</div>';
        //
        $o2 .= $mdo;
        if(in_array('date', $value)){
          $FeedshowDate = 'true';
           if($FeedshowDate == 'true'){
             $o2 .= '<div class="data date">';
             // icon only
             if($dateType == 'icon'){
               $o2 .= '<div class="meta-icon">'.$dateIcon.' '.get_the_date($postDate).'</div>';
             }
             // text only
             if($dateType == 'text'){
               $o2 .= '<div class="meta-text">'.$dateText.' '.get_the_date($postDate).'</div>';
             }
             // both
             if($dateType == 'both'){
               $o2 .= '<div class="meta-icon">'.$dateIcon.'</div><div class="meta-text">'.$dateText.' '.get_the_date($postDate).'</div>';
             }
             $o2 .= '</div>';
           }
        }

        if(in_array('author', $value)){
          $FeedshowAuthor = 'true';
          if($FeedshowAuthor == 'true'){
            //$o .= $mda;
            $postAuthor = get_the_author('post_author');
            $o2 .= '<div class="data author">';
            // icon only
            if($authorType == 'icon'){
              $o2 .= '<div class="meta-icon">'.$authorIcon.' '.$postAuthor.'</div>';
            }
            // text only
            if($authorType == 'text'){
              $o2 .= '<div class="meta-text">'.$authorText.' '.$postAuthor.'</div>';
            }
            // both
            if($authorType == 'both'){
              $o2 .= '<div class="meta-icon">'.$authorIcon.'</div><div class="meta-text">'.$authorText.' '.$postAuthor.'</div>';
            }
            $o2 .= '</div>';
          }
        }
        $o2 .= $mdc;

        //excerpt
        if(in_array('excerpt', $value)){
          $FeedshowExc = 'true';
          if($FeedshowExc == 'true'){
            $excerpt = get_the_excerpt(false, false);
            $o2 .= '<div class="excerpt">';
            $o2 .= '<p>'.$excerpt.'</p>';
            $o2 .= '</div>';
          }
        }
        //
        $o2 .= '</div>';
      }
      $o2 .= '</div>';

    endwhile;
  // Close Blog Feed
  $o2 .=  '</div></section>';
	// pagination
	//echo '<div class="columns"><div class="column is-12">'.enollo_pagination().'</div></div>';
}
// end secondary page layouts


if( $paged == 1 ) {
  echo $o;
} else {
  echo $o2;
}
echo '<div class="columns"><div class="column is-12"><hr class="cb">'.enollo_pagination().'</div></div>';
?>