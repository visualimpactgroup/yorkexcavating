<?php
//////////
//WOO SHORTCODES
//


// get top level categories
// function getCategories_shortcode(){
//   $orderby              = 'name';
//   $order                = 'asc';
//   $hide_empty           = false;
//   $defaultImage         = get_field('default_category_image', 'options');
//
//   $cat_args = array(
//     'post_type'         => 'product',
//     'orderby'           => $orderby,
//     'order'             => $order,
//     'hide_empty'        => $hide_empty,
//     'parent'            => 0,
//   );
//
//   $product_categories = get_terms( 'product_cat', $cat_args );
//
//   if( !empty($product_categories) ){
//     $cats .= '<section class="categories layout-builder">';
//     $cats .= '<div class="columns is-multiline is-mobile">';
//     foreach ($product_categories as $key => $category) {
//       //
//       $catSnippet       = get_field('category_snippet', $category);
//       $catSnippetBtn    = get_field('snippet_button', $category);
//       $catBackground    = get_field('category_image', $category);
//       //
//       if($catSnippet != ''){
//         $cats .= '<div class="column is-12-mobile is-6-tablet is-6-desktop is-6-widescreen">';
//         $cats .= '<div class="category-block parent-category">';
//         $cats .= '<div class="cont">';
//         $cats .= $catSnippet;
//         $cats .= '<div class="button-block">';
//         $cats .= '<a class="btn styled" href="'.get_term_link($category).'" title="Browse '.$category->name.'">';
//         if($catSnippetBtn != ''){
//           $cats .= $catSnippetBtn;
//         } else {
//           $cats .= 'Browse Products';
//         }
//         $cats .= '</a>';
//         $cats .= '</div>';
//         $cats .= '</div>';
//         $cats .= '<div class="category-shade"></div>';
//         if($catBackground != ''){
//           $cats .= '<div class="category-background" style="background-image: url('.$catBackground['url'].')"></div>';
//         } else {
//           $cats .= '<div class="category-background" style="background-image: url('.$defaultImage['url'].')"></div>';
//         }
//         $cats .= '</div>';
//         $cats .= '</div>';
//       }
//     }
//     $cats .= '</ul>';
//     $cats .= '</div>';
//     $cats .= '</section>';
//
//     echo $cats;
//   }
// }
// add_shortcode('getCategories', 'getCategories_shortcode');
function getCategories_shortcode(){
  $orderby              = 'name';
  $order                = 'asc';
  $hide_empty           = false;
  $defaultImage         = get_field('default_sub_category_image', 'options');
  $linkAfter            = get_field('more_link_after', 'options');

  $cat_args = array(
    'post_type'         => 'product',
    'orderby'           => $orderby,
    'order'             => $order,
    'hide_empty'        => $hide_empty,
    'parent'            => 0,
  );

  $product_categories = get_terms( 'product_cat', $cat_args );

  if( !empty($product_categories) ){
    $cats .= '<section class="categories layout-builder sub-categories">';
    $cats .= '<div class="columns is-multiline is-mobile">';
    foreach ($product_categories as $key => $category) {
      //
      $catSnippet       = get_field('category_snippet', $category);
      $catSnippetBtn    = get_field('snippet_button', $category);
      $catBackground    = get_field('category_image', $category);
      $redirectLink     = get_field('redirect_link', $category);
      if($redirectLink != ''){
        $link             = $redirectLink['url'];
        $linkTarget       = '_blank';
      } else {
        $link             = get_term_link($category);
        $linkTarget       = '';
      }

      $catImageSize     = 'sub-category-img';
      //$catImage         = wp_get_attachment_image_src( $catBackground, $catImageSize);
      $catImage         = $catBackground;

      if($catSnippet != ''){
        $cats .= '<div class="column is-6-mobile is-6-tablet is-4-desktop is-4-widescreen">';
        $cats .= '<div class="category-block sub-category">';
        $cats .= '<div class="category-image">';
        if($catBackground != ''){
          $cats .= '<a href="'.$link.'" title="Browse '.$category->name.'" target="'.$linkTarget.'"><img src="'.$catImage['sizes']['sub-category-img'].'" alt="'.$catBackground['alt'].'"></a>';
        } else {
          $cats .= '<a href="'.$link.'" title="Browse '.$category->name.'" target="'.$linkTarget.'"><img src="'.$defaultImage['url'].'" alt="Browse '.$category->name.'"></a>';
        }
        $cats .= '</div>';
        $cats .= '<div class="cont">';
        $cats .= '<h2><a href="'.$link.'" title="Browse '.$category->name.'" target="'.$linkTarget.'">'.$category->name.'</a></h2>';
        $cats .= $catSnippet;
        $cats .= '<div class="button-block">';
        $cats .= '<a class="btn" href="'.$link.'" title="Browse '.$category->name.'" target="'.$linkTarget.'">';
        if($catSnippetBtn != ''){
          $cats .= $catSnippetBtn . $linkAfter;
        } else {
          $cats .= 'Browse Products'.$linkAfter;
        }
        $cats .= '</a>';
        $cats .= '</div>';
        $cats .= '</div>';
        $cats .= '</div>';
        $cats .= '</div>';
      }
    }
    $cats .= '</ul>';
    $cats .= '</div>';
    $cats .= '</section>';

    echo $cats;
  }
}
add_shortcode('getCategories', 'getCategories_shortcode');

// get sub categories
function getSubCategories_shortcode(){
  $orderby              = 'name';
  $order                = 'asc';
  $hide_empty           = false;
  $term_id              = get_queried_object_id();
  $taxonomy             = 'product_cat';
  $defaultImage         = get_field('default_sub_category_image', 'options');
  $linkAfter            = get_field('more_link_after', 'options');

  $cat_args = array(
    'post_type'         => 'product',
    'orderby'           => $orderby,
    'order'             => $order,
    'hide_empty'        => $hide_empty,
    'parent'            => get_queried_object_id(),
  );

  $product_categories = get_terms( 'product_cat', $cat_args );

  if( !empty($product_categories) ){
    $cats .= '<section class="categories layout-builder sub-categories">';
    $cats .= '<div class="columns is-multiline is-mobile is-marginless">';
    foreach ($product_categories as $key => $category) {
      //
      $catSnippet       = get_field('category_snippet', $category);
      $catSnippetBtn    = get_field('snippet_button', $category);
      $catBackground    = get_field('category_image', $category);
      $catImageSize     = 'sub-category-img';
      //$catImage         = wp_get_attachment_image_src( $catBackground, $catImageSize);
      $catImage         = $catBackground;
      $redirectLink     = get_field('redirect_link', $category);
      if($redirectLink != ''){
        $link             = $redirectLink['url'];
        $linkTarget       = '_blank';
      } else {
        $link             = get_term_link($category);
        $linkTarget       = '';
      }

      if($catSnippet != ''){
        $cats .= '<div class="column is-6-mobile is-6-tablet is-4-desktop is-4-widescreen">';
        $cats .= '<div class="category-block sub-category">';
        $cats .= '<div class="category-image">';
        if($catBackground != ''){
          $cats .= '<a href="'.$link.'" title="Browse '.$category->name.'" target="'.$linkTarget.'"><img src="'.$catImage['sizes']['sub-category-img'].'" alt="'.$catBackground['alt'].'"></a>';
        } else {
          $cats .= '<a href="'.$link.'" title="Browse '.$category->name.'" target="'.$linkTarget.'"><img src="'.$defaultImage['url'].'" alt="Browse '.$category->name.'"></a>';
        }
        $cats .= '</div>';
        $cats .= '<div class="cont">';
        $cats .= '<h2><a href="'.$link.'" title="Browse '.$category->name.'" target="'.$linkTarget.'">'.$category->name.'</a></h2>';
        $cats .= $catSnippet;
        $cats .= '<div class="button-block">';
        $cats .= '<a class="btn" href="'.$link.'" title="Browse '.$category->name.'" target="'.$linkTarget.'">';
        if($catSnippetBtn != ''){
          $cats .= $catSnippetBtn . $linkAfter;
        } else {
          $cats .= 'Browse Products'.$linkAfter;
        }
        $cats .= '</a>';
        $cats .= '</div>';
        $cats .= '</div>';
        $cats .= '</div>';
        $cats .= '</div>';
      }
    }
    $cats .= '</ul>';
    $cats .= '</div>';
    $cats .= '</section>';

    echo $cats;
  }
}
add_shortcode('getSubCategories', 'getSubCategories_shortcode');


// get products
function getProductsList_shortcode(){
  $cate = get_queried_object();
  $cateID = $cate->term_id;
  $args = array(
    'post_type'       => 'product',
    'post_status'			=> 'publish',
    'posts_per_page'  => -1,
    'tax_query'             => array(
        array(
            'taxonomy'      => 'product_cat',
            'field'         => 'term_id',
            'terms'         => $cateID,
            'operator'      => 'IN'
        ),
    ),
  );

  $loop = new WP_Query( $args );

  $prod .= '<div class="columns is-mobile is-multiline product-build">';
  while ( $loop->have_posts() ) : $loop->the_post();
    global $product;
    // product fields
    $prodLogo   = get_field('colored_product_logo');
    $prodShort  = get_field('product_short_description');
    $defProdImg = get_field('default_product_image', 'options');
    $moreAfter  = get_field('more_link_after', 'options');
    $title      = get_the_title();
    $stripped   = preg_replace("/[^A-Za-z0-9]/", "", $title);
    // product image
    $images     = get_field('primary_images');
    $prodImg    = $images[0];
    // end fields
    $prod .= '<div class="column is-12-mobile is-5-tablet is-5-desktop is-5-widescreen img-side">';
    $prod .= '<a href="'.get_permalink().'" title="View '.get_the_title().'">';
    if($prodImg != ''){
      $prod .= '<img src="'.$prodImg['url'].'" alt="'.get_the_title().'" class="sm-img">';
    } else {
      $prod .= '<img src="'.$defProdImg['url'].'" alt="'.get_the_title().'" class="sm-img">';
    }
    $prod .= '</a>';
    $prod .= '</div>';
    $prod .= '<div class="column is-12-mobile is-7-tablet is-7-desktop is-7-widescreen">';
    $prod .= '<div class="prod-cont">';
    if($prodLogo != ''){
      $prod .= '<h3><a href="'.get_permalink().'" title="View '.get_the_title().'"><span>'.get_the_title().'</span><div class="prod-logo"><img src="'.$prodLogo['url'].'" alt="'.get_the_title().'"></div></a></h3>';
    } else {
      $prod .= '<h3><a href="'.get_permalink().'" title="View '.get_the_title().'">'.get_the_title().'</a></h3>';
    }
    $prod .= '<hr class="cb">';
    $prod .= $prodShort;
    $prod .= '<div class="button-block">';
    $prod .= '<a class="btn" href="'.get_permalink().'" title="">Learn More'.$moreAfter.'</a>';
    $prod .= '<a class="btn" href="/request-a-demo/?prod='.$stripped.'" title="">Request a Demo'.$moreAfter.'</a>';
    $prod .= '</div>';
    $prod .= '</div>';
    $prod .= '</div>';
  endwhile;
  $prod .= '</div>';

  echo $prod;

  wp_reset_query();
}
add_shortcode('getProductsList', 'getProductsList_shortcode');


// get simple product layout
function getSimpleProduct_shortcode(){

  global $product;
  // product fields
  $prodLogo   = get_field('colored_product_logo');
  $prodFull   = get_field('product_full_description');
  $defProdImg = get_field('default_product_image', 'options');
  $moreAfter  = get_field('more_link_after', 'options');
  $title      = get_the_title();
  $stripped   = preg_replace("/[^A-Za-z0-9]/", "", $title);

  // product image
  $images = get_field('primary_images');
  if( $images ):
    $imageGal .= '<ul class="product-slideshow">';
      foreach( $images as $image ):
        $imageGal .= '<li>';
        $imageGal .= '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
        $imageGal .= '</li>';
      endforeach;
    $imageGal .= '</ul>';
    $prodImg = $imageGal;
  endif;
  // end images

  // buttons
  if( have_rows('buttons') ):
    $buttons .= '<div class="button-block">';
    while ( have_rows('buttons') ) : the_row();
      $buttonData = get_sub_field('button');
      if($buttonData['url'] = 'request-a-demo'){
        $buttons .= '<a class="btn styled" href="'.$buttonData['url'].'?prod='.$stripped.'" title="'.$buttonData['title'].'" target="'.$buttonData['target'].'">'.$buttonData['title'].$moreAfter.'</a>';
      } else {
        $buttons .= '<a class="btn styled" href="'.$buttonData['url'].'" title="'.$buttonData['title'].'" target="'.$buttonData['target'].'">'.$buttonData['title'].$moreAfter.'</a>';
      }
    endwhile;
    $buttons .= '</div>';
    $btn .= $buttons;
  endif;
  // end buttons

  // social sharing & meta data
  $terms = get_the_terms( $post->ID, 'product_cat' );
  $nterms = get_the_terms( $post->ID, 'product_tag'  );
  foreach ($terms  as $term  ) {
    $product_cat_id = $term->term_id;
    $product_cat_name = $term->name;
    $product_cat_link = $term->slug;
    break;
  }
  $catName .= $product_cat_name;
  $catLink .= $product_cat_link;
  $socialS .= do_shortcode('[socialSharing]');

  $prodMeta .= '<div class="prod-meta">';
  if($catName != ''){
    //$prodMeta .= '<div class="data"><a href="'.$catLink.'" title="'.$catName.'">'.$catName.'</a></div>';
    $prodMeta .= '<div class="data">'.$catName.'</div>';
  }
  $prodMeta .= '<div class="data">';
  $prodMeta .= '<span>Share Product</span>';
  $prodMeta .= $socialS;
  $prodMeta .= '</div>';
  $prodMeta .= '</div>';
  //
  $prod .= '<section class="categories layout-builder simple-product single-prod">';
  $prod .= '<div class="columns is-mobile is-multiline product-build">';
  $prod .= '<div class="column is-12-mobile is-5-tablet is-5-desktop is-5-widescreen img-side">';
  if($prodImg != ''){
    $prod .= $prodImg;
  } else {
    $prod .= '<img src="'.$defProdImg['url'].'" alt="'.get_the_title().'">';
  }
  $prod .= '</div>';
  $prod .= '<div class="column is-12-mobile is-12-tablet is-7-desktop is-7-widescreen">';
  $prod .= '<div class="prod-cont">';
  $prod .= '<div class="mobile-image">'.$prodImg.'</div>';
  if($prodLogo != ''){
    $prod .= '<h2><span>'.get_the_title().'</span><div class="prod-logo"><img src="'.$prodLogo['url'].'" alt="'.get_the_title().'"></div></h2>';
  } else {
    $prod .= '<h2>'.get_the_title().'</h2>';
  }
  $prod .= '<hr class="cb">';
  $prod .= $prodMeta;
  $prod .= $prodFull;
  $prod .= $btn;
  $prod .= '</div>';
  $prod .= '</div>';
  $prod .= '</div>';
  $prod .= '</div>';
  $prod .= '</section>';

  echo $prod;

}
add_shortcode('getSimpleProduct', 'getSimpleProduct_shortcode');


// display replacement parts or accessories
function getReplacementAccessories_shortcode(){

  $opening .= '<ul class="filterbar full-width">';
  $closing .= '</ul>';

  // replacement parts
  if( have_rows('replacement_parts') ):
    $replacementTitle             .= '<li><a href="#tab-replacementParts">Replacement Parts</a></li>';
    $replacementContainerOpen     .= '<div class="tabcont" id="tab-replacementParts"><div class="columns">';
    $replacementContainerClose    .= '</div></div>';
    while ( have_rows('replacement_parts') ) : the_row();
      //$replacementPart = get_sub_field('replacement_part');
      $post_object = get_sub_field('replacement_part');
      if( $post_object ):
        $post = $post_object;
        setup_postdata( $post );
        //
        $catSnippet       = get_field('category_snippet', $category);
        $catSnippetBtn    = get_field('snippet_button', $category);
        $catBackground    = get_field('category_image', $category);
        $catImageSize     = 'sub-category-img';
        $catImage         = $catBackground;

        //
        // product fields
        $prodLogo   = get_field('colored_product_logo');
        $prodShort  = get_field('product_short_description');
        $prodTrim		= substr($prodShort, 0, 175);
        $defProdImg = get_field('default_product_image', 'options');
        $moreAfter  = get_field('more_link_after', 'options');
        // product image
        $images           = get_field('primary_images');
        $prodImg          = $images[0];
        $catBackground    = get_field('category_image', $category);
        $catImageSize     = 'sub-category-img';
        $catImage         = $catBackground;
        // end fields
        //
        $reppart .= '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
        $reppart .= '<div class="category-block sub-category">';
        $reppart .= '<div class="category-image">';
        if($prodImg != ''){
          $reppart .= '<a href="'.get_permalink().'" title="View '.get_the_title().'"><img src="'.$prodImg['url'].'" alt="'.get_the_title().'" ></a>';
        } else {
          $reppart .= '<a href="'.get_permalink().'" title="View '.get_the_title().'"><img src="'.$defaultImage['url'].'" alt="Browse '.$category->name.'"></a>';
        }
        $reppart .= '</div>';
        $reppart .= '<div class="cont prod-cont">';
        if($prodLogo != ''){
          $reppart .= '<h3><a href="'.get_permalink().'" title="View '.get_the_title().'"><span>'.get_the_title().'</span><div class="prod-logo"><img src="'.$prodLogo['url'].'" alt="'.get_the_title().'"></div></a></h3>';
        } else {
          $reppart .= '<h3><a href="'.get_permalink().'" title="View '.get_the_title().'">'.get_the_title().'</a></h3>';
        }
        $reppart .= '<hr class="cb">';
        $reppart .= $prodTrim.'...';
        $reppart .= '<div class="button-block">';
        $reppart .= '<a class="btn" href="'.get_permalink().'" title="View '.get_the_title().'">View Replacement Part'.$moreAfter.'</a>';
        $reppart .= '</div>';
        $reppart .= '</div>';
        $reppart .= '</div>';
        $reppart .= '</div>';
        //
        wp_reset_postdata();
      endif;

      $rep .= $reppart;
    endwhile;
  endif;
  // end replacement parts

  // accessories
  if( have_rows('accessories') ):
    $accessoryTitle               .= '<li><a href="#tab-accessory">Accessories</a></li>';
    $accessoryContainerOpen       .= '<div class="tabcont" id="tab-accessory"><div class="columns">';
    $accessoryContainerClose      .= '</div></div>';
    while ( have_rows('accessories') ) : the_row();
      $post_object = get_sub_field('accessory');
      if( $post_object ):
        $post = $post_object;
        setup_postdata( $post );
        //
        $catSnippet       = get_field('category_snippet', $category);
        $catSnippetBtn    = get_field('snippet_button', $category);
        $catBackground    = get_field('category_image', $category);
        $catImageSize     = 'sub-category-img';
        $catImage         = $catBackground;

        //
        // product fields
        $prodLogo   = get_field('colored_product_logo');
        $prodShort  = get_field('product_short_description');
        $prodTrim		= substr($prodShort, 0, 175);
        $defProdImg = get_field('default_product_image', 'options');
        $moreAfter  = get_field('more_link_after', 'options');
        // product image
        $images           = get_field('primary_images');
        $prodImg          = $images[0];
        $catBackground    = get_field('category_image', $category);
        $catImageSize     = 'sub-category-img';
        $catImage         = $catBackground;
        // end fields
        //
        $accessoryprod .= '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
        $accessoryprod .= '<div class="category-block sub-category">';
        $accessoryprod .= '<div class="category-image">';
        if($prodImg != ''){
          $accessoryprod .= '<a href="'.get_permalink().'" title="View '.get_the_title().'"><img src="'.$prodImg['url'].'" alt="'.get_the_title().'" ></a>';
        } else {
          $accessoryprod .= '<a href="'.get_permalink().'" title="View '.get_the_title().'"><img src="'.$defaultImage['url'].'" alt="Browse '.$category->name.'"></a>';
        }
        $accessoryprod .= '</div>';
        $accessoryprod .= '<div class="cont prod-cont">';
        if($prodLogo != ''){
          $accessoryprod .= '<h3><a href="'.get_permalink().'" title="View '.get_the_title().'"><span>'.get_the_title().'</span><div class="prod-logo"><img src="'.$prodLogo['url'].'" alt="'.get_the_title().'"></div></a></h3>';
        } else {
          $accessoryprod .= '<h3><a href="'.get_permalink().'" title="View '.get_the_title().'">'.get_the_title().'</a></h3>';
        }
        $accessoryprod .= '<hr class="cb">';
        $accessoryprod .= $prodTrim.'...';
        $accessoryprod .= '<div class="button-block">';
        $accessoryprod .= '<a class="btn" href="'.get_permalink().'" title="View '.get_the_title().'">View Accessory'.$moreAfter.'</a>';
        $accessoryprod .= '</div>';
        $accessoryprod .= '</div>';
        $accessoryprod .= '</div>';
        $accessoryprod .= '</div>';
        //
        wp_reset_postdata();
      endif;

      $access .= $accessoryprod;
    endwhile;
  endif;
  // end accessories

  if(( have_rows('replacement_parts') ||  (have_rows('accessories')))){
    echo '<div id="productAttributes" class="categories layout-builder">';
    //echo '<div class="columns">';
    echo $opening;
    echo $replacementTitle;
    echo $accessoryTitle;
    echo $closing;
    //echo '</div>';
    //
    echo $replacementContainerOpen;
    echo $reppart;
    echo $replacementContainerClose;
    //
    echo $accessoryContainerOpen;
    echo $access;
    echo $accessoryContainerClose;
    echo '</div>';
  }

}
add_shortcode('getReplacementAccessories', 'getReplacementAccessories_shortcode');


// display related products
function getRelatedProduct_shortcode(){

  // related products
  if( have_rows('related_products') ):
    $relatedprods .= '<section class="related-products layout-builder">';
    $relatedprods .= '<div class="columns is-multiline">';
    $relatedprods .= '<div class="columns is-12"><div class="block-title">Related Products</div></div>';
    while ( have_rows('related_products') ) : the_row();
      $post_object = get_sub_field('related_product');
      if( $post_object ):
        $post = $post_object;
        setup_postdata( $post );
        //
        // product fields
        $prodLogo   = get_field('colored_product_logo');
        $prodShort  = get_field('product_short_description');
        $prodTrim		= substr($prodShort, 0, 175);
        $defProdImg = get_field('default_product_image', 'options');
        $moreAfter  = get_field('more_link_after', 'options');
        // product image
        $images     = get_field('primary_images');
        $prodImg    = $images[0];
        // end fields
        $prod .= '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen product-build">';
        $prod .= '<a href="'.get_permalink().'" title="View '.get_the_title().'">';
        if($prodImg != ''){
          $prod .= '<img src="'.$prodImg['url'].'" alt="'.get_the_title().'" class="sm-img">';
        } else {
          $prod .= '<img src="'.$defProdImg['url'].'" alt="'.get_the_title().'" class="sm-img">';
        }
        $prod .= '</a>';
        $prod .= '<div class="prod-cont">';
        if($prodLogo != ''){
          $prod .= '<h3><a href="'.get_permalink().'" title="View '.get_the_title().'"><span>'.get_the_title().'</span><div class="prod-logo"><img src="'.$prodLogo['url'].'" alt="'.get_the_title().'"></div></a></h3>';
        } else {
          $prod .= '<h3><a href="'.get_permalink().'" title="View '.get_the_title().'">'.get_the_title().'</a></h3>';
        }
        $prod .= '<hr class="cb">';
        $prod .= $prodTrim.'...';
        $prod .= '<div class="button-block">';
        $prod .= '<a class="btn" href="#" title="">Learn More'.$moreAfter.'</a>';
        $prod .= '</div>';
        $prod .= '</div>';
        //
        wp_reset_postdata();
      endif;

      $relatedprod .= $prod;
    endwhile;
    $relatedprods .= $relatedprod;
    $relatedprods .= '</div>';
    $relatedprods .= '</section>';
  endif;
  // end related products

  echo $relatedprods;

}
add_shortcode('getRelatedProduct', 'getRelatedProduct_shortcode');


// promo product hero
function promoProductHero_shortcode(){
  // fields
  $title      = get_the_title();
  $heroImg    = get_field('hero_image');
  $heroLogoW  = get_field('colored_product_logo');
  $frontpage  = get_option('page_on_front');
  $hideShadow = get_field('hide_shadow');
  $heroSizer	= get_field('default_product_hero_image', 'options');
  $images     = get_field('primary_images');
  $prodImg    = $images[0];
  //
  if($heroLogoW != ''){
    $logo .= '<div class="hero-logo animated fadeInUp"><img src="'.$heroLogoW['url'].'" alt="'.$title.'"></div>';
  }
  //
  $promo .= '<section class="hero layout-builder homepage-hero bg-img align-centerAligned" style="background: url('.$heroImg["url"].') no-repeat" data-type="parallax" data-speed="-5">';
  // $promo .= '<div class="columns">';
  // $promo .= '<div class="column is-2"></div>';
  // $promo .= '<div class="column is-8">';
  // $promo .= '<div class="hero-content">';
  // $promo .= $logo;
  // $promo .= '</div>';
  // $promo .= '</div>';
  // $promo .= '<div class="column is-2"></div>';
  //$promo .= '</div>';
  //
    $promo .= '<div class="mobile-image" style="background-image: url('.$prodImg['url'].')" data-type="parallax" data-speed="-2"></div>';
    $promo .= '<div class="columns is-mobile">';
    $promo .= '<div class="column is-12-mobile is-hidden-tablet is-hidden-desktop is-hidden-widescreen">';
    $promo .= $logo;
    $promo .= '</div>';
    $promo .= '</div>';

    $promo .= '<div class="shadow">';
    if($hideShadow != 'yesHide'){
      $promo .= '<div class="header-shadow"></div>';
    }
    $promo .= '</div>';
    if($hideShadow != 'yesHide'){
      $promo .= '<div class="shade"></div>';
    }

  $promo .= '<div class="hero-size"><img src="'.$heroSizer['url'].'"></div>';
  $promo .= '</section>';

  echo $promo;
}
add_shortcode('promoProductHero', 'promoProductHero_shortcode');


// promo product intro
function promoProductIntro_shortcode(){
  global $product;
  // product fields
  $title      = get_the_title();
  $stripped   = preg_replace("/[^A-Za-z0-9]/", "", $title);
  $prodFull   = get_field('product_full_description');
  $defProdImg = get_field('default_product_image', 'options');
  $moreAfter  = get_field('more_link_after', 'options');
  // product image
  $images = get_field('primary_images');
  if( $images ):
    $imageGal .= '<ul class="product-slideshow">';
      foreach( $images as $image ):
        $imageGal .= '<li>';
        $imageGal .= '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
        $imageGal .= '</li>';
      endforeach;
    $imageGal .= '</ul>';
    $prodImg = $imageGal;
  endif;
  // end images

  // buttons
  if( have_rows('buttons') ):
    $buttons .= '<div class="button-block">';
    while ( have_rows('buttons') ) : the_row();
      $buttonData = get_sub_field('button');
      if($buttonData['url'] = 'request-a-demo'){
        $buttons .= '<a class="btn styled" href="'.$buttonData['url'].'?prod='.$stripped.'" title="'.$buttonData['title'].'" target="'.$buttonData['target'].'">'.$buttonData['title'].$moreAfter.'</a>';
      } else {
        $buttons .= '<a class="btn styled" href="'.$buttonData['url'].'" title="'.$buttonData['title'].'" target="'.$buttonData['target'].'">'.$buttonData['title'].$moreAfter.'</a>';
      }
    endwhile;
    $buttons .= '</div>';
    $btn .= $buttons;
  endif;
  // end buttons

  // get promo video/featured
  if( have_rows('product_videos') ):
    $vidCount = 0;
    $youtubeAPI       = get_field('youtube_api', 'options');
    $playBtnIcon      = get_field('play_button', 'options');
    while ( have_rows('product_videos') ) : the_row();
      $videoPromoTitle  = get_sub_field('video_title');
      $video            = get_sub_field('video_url'); //Embed Code
      $video_url        = get_sub_field('video_url', FALSE, FALSE); //URL
      $video_thumb_url  = get_video_thumbnail_uri($video_url);
      $video_id_conversion = parse_str( parse_url( $video_url, PHP_URL_QUERY ), $vars );
      $video_id             = $vars['v'];
      $vidVis           = get_sub_field('visible');
      $vidPrimary       = get_sub_field('primary');
      //
      if(($vidPrimary == 'yesPrimary') && ($vidVis == 'yesVisible')) {
        $vidCount++;
        if($vidCount == '1'){
          //
          $videoid        = $video_id;
          $apikey         = $youtubeAPI;
          $json           = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=' . $videoid . '&key=' . $apikey . '&part=snippet,contentDetails,statistics,status');
          $data           = json_decode($json, true);
          $videoTitle     = $data['items'][0]['snippet']['title'];
          $videoDuration  = $data['items'][0]['contentDetails']['duration'];
          $time           = covtime($videoDuration);
          //print_r($data);
          $promovid .= '<div class="promo-video video columns">';
          $promovid .= '<div class="columns is-mobile is-multiline">';
          $promovid .= '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen is-paddingless">';
          $promovid .= '<a class="vidlink animated fadeInUp" data-fancybox="" href="'.$video_url.'">';
          $promovid .= '<div class="video-block">';
          $promovid .= $playBtnIcon;
          $promovid .= '<img class="video-link" src="'.$video_thumb_url.'">';
          $promovid .= '</div>';
          $promovid .= '</a>';
          $promovid .= '</div>';
          $promovid .= '<div class="column is-12-mobile is-8-tablet is-8-desktop is-8-widescreen is-paddingless">';
          if($videoPromoTitle != ''){
            $promovid .= '<div class="video-title">';
            $promovid .= '<a class="vidlink" data-fancybox="" href="'.$video_url.'">';
            $promovid .= $videoPromoTitle;
            $promovid .= '<span>'.$playBtnIcon.$videoTitle.' '.$time.'</span>';
            $promovid .= '</a>';
            $promovid .= '</div>';
          }
          $promovid .= '</div>';
          $promovid .= '</div>';
          $promovid .= '</div>';
          $pvideo   .= $promovid;
        }
      }
    endwhile;
  endif;
  //
  if($prodImg != ''){
    $prodImage .= $prodImg;
  } else {
    $prodImage .= '<img src="'.$defProdImg['url'].'" alt="'.get_the_title().'">';
  }
  //
  $prod .= '<section class="categories layout-builder promo-product single-prod">';
  $prod .= '<div class="columns is-mobile is-multiline product-build">';
  $prod .= '<div class="column is-12-mobile is-12-tablet is-5-desktop is-5-widescreen img-side">';
  $prod .= $prodImage;
  $prod .= '</div>';
  $prod .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-1-desktop is-1-widescreen"></div>';
  $prod .= '<div class="column is-12-mobile is-12-tablet is-6-desktop is-6-widescreen">';
  $prod .= '<div class="prod-cont">';
  $prod .= '<div class="mobile-image">'.$prodImg.'</div>';
  $prod .= $prodFull; // product description
  $prod .= $pvideo; // if promo video is defined
  //$prod .= '<div class="mobile-image">'.$prodImage.'</div>';
  $prod .= $btn; // buttons
  $prod .= '</div>';
  $prod .= '</div>';
  $prod .= '</div>';
  $prod .= '</div>';
  $prod .= '</section>';

  echo $prod;
}
add_shortcode('promoProductIntro', 'promoProductIntro_shortcode');


// promo product features
function promoProductFeatures_shortcode(){
  $title      = get_the_title();
  $heroImg    = get_field('hero_image');
  $heroLogoW  = get_field('white_product_logo');

  // white logo
  if($heroLogoW != ''){
    $logo .= '<div class="columns is-multiline is-mobile highlight-title-block">';
    $logo .= '<div class="column is-12">';
    $logo .= '<span>Meet the <strong>'.$title.'</strong></span>';
    //$logo .= '<div class="logo"><img src="'.$heroLogoW['url'].'" alt="'.$title.'"></div>';
    $logo .= '</div>';
    $logo .= '</div>';
  }

  // highlight fields
  $highlightImage = get_field('highlight_image');
  $highlightCont  = get_field('highlight_content');
  $hideDots       = get_field('hide_highlight_dots');

  // highlights
  $count = 0;
  if( have_rows('highlights') ):
    $highlightImg .= '<div class="highlight-container '.$hideDots.'">';
    while ( have_rows('highlights') ) : the_row();
      $coords = explode( ',', get_sub_field('highlight') );
      $title  = get_sub_field('highlight_title');
      $count++;
      $highlightLI  .= '<li id="feature-'.$count.'"><span class="circle">'.$count.'</span>'.$title.'</li>';
      $highlightImg .= '<div class="feature feature-'.$count.'" style="left:'.$coords[0].'; top:'.$coords[1].';" data-title="' . $title . '-' . $count . '">' . $count . '</div>';
    endwhile;
    $highlightImg .= '<div class="highlight-img"><img src="'.$highlightImage['url'].'"></div>';
    $highlightImg .= '</div>';
  endif;

  $highlight .= '<section class="highlights layout-builder">';
  $highlight .= $logo; // grabs white logo if exists
  $highlight .= '<div class="columns is-multiline is-mobile is-reversed">';
  $highlight .= '<div class="column is-12-mobile is-7-tablet is-7-desktop is-7-widescreen">';
  $highlight .= $highlightImg; // grabs main image
  $highlight .= '</div>';
  $highlight .= '<div class="column is-12-mobile is-5-tablet is-5-desktop is-5-widescreen">';
  $highlight .= $highlightCont; // grabs highlight content paragraph
  $highlight .= '<ul class="highlight-list">';
  $highlight .= $highlightLI; // grabs highlight titles in list format
  $highlight .= '</ul>';
  $highlight .= '</div>';
  $highlight .= '</div>';
  $highlight .= '</section>';
  // end highlight section

  if( have_rows('highlights') ):
    echo $highlight;
  endif;
}
add_shortcode('promoProductFeatures', 'promoProductFeatures_shortcode');

// promo product selling points
function promoProductSellingPoints_shortcode(){
  $title                = get_the_title();
  $sellingPointImage    = get_field('selling_point_image');
  $sellingPointContent  = get_field('selling_point_content');
  $sellingPointDisc     = get_field('selling_point_content_disclaimer');

  // main image logo
  if($sellingPointImage != ''){
    $mainImage .= '<img src="'.$sellingPointImage['url'].'" alt="'.$sellingPointImage['alt'].'" class="selling-image">';
  }

  // selling points
  if( have_rows('selling_points') ):
    $sellingOpen .= '<section class="selling-points layout-builder">';
    $sellingOpen .= '<div class="columns is-mobile is-multiline">';
    $sellingClose .= '</div>';
    $sellingClose .= '</section>';

    while ( have_rows('selling_points') ) : the_row();
      if( get_row_index() % 2 == 0 ){
        $even         = array();
        $pointTitle   = get_sub_field('point_title');
        $pointIcon    = get_sub_field('point_icon');
        //even
        $liEven .= '<li>';
        $liEven .= '<div class="icon-block"><img src="'.$pointIcon['url'].'" alt="'.$pointIcon['alt'].'"></div>';
        $liEven .= $pointTitle;
        $liEven .= '</li>';
        $even[] = $liEven;
      } else {
        $odd          = array();
        $pointTitle   = get_sub_field('point_title');
        $pointIcon    = get_sub_field('point_icon');
        //odd
        $liOdd .= '<li>';
        $liOdd .= '<div class="icon-block"><img src="'.$pointIcon['url'].'" alt="'.$pointIcon['alt'].'"></div>';
        $liOdd .= $pointTitle;
        $liOdd .= '</li>';
        $odd[] = $liOdd;
      }
    endwhile;

    //
    echo $sellingOpen;
    if($sellingPointContent != ''){ // displayed on tablet & mobile
      echo '<div class="column is-12-mobile is-12-tablet is-hidden-desktop is-hidden-widescreen">';
      echo '<div class="sec-title">'.$sellingPointContent.'</div>';
      echo '</div>';
    }
    echo '<div class="column is-12-mobile is-6-tablet is-4-desktop is-4-widescreen"><ul class="sellings">'.implode( '</li><li>', $even).'</ul></div>';
    echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-4-desktop is-4-widescreen">'.$mainImage.'</div>';
    echo '<div class="column is-12-mobile is-6-tablet is-4-desktop is-4-widescreen"><ul class="sellings">'.implode( '</li><li>', $odd).'</ul></div>';
    if($sellingPointContent != ''){ // displayed on desktop
      echo '<div class="column is-hidden-mobile is-hidden-tablet-only is-12-desktop is-12-widescreen">';
      echo '<div class="sec-title">'.$sellingPointContent.'</div>';
      echo '</div>';
    }

    if($sellingPointDisc != ''){
      echo '<div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">';
      echo '<div class="sec-disclaimer">'.$sellingPointDisc.'</div>';
      echo '</div>';
    }
    echo $sellingClose;
    //
  endif;
}
add_shortcode('promoProductSellingPoints', 'promoProductSellingPoints_shortcode');


// display promo product assets
function promoProductAssets_shortcode(){
  $downloadico = get_field('download_icon', 'options');
  $opening .= '<ul class="filterbar full-width">';
  $closing .= '</ul>';

  // product gallery
  if( have_rows('product_gallery') ):
    $galleryTitle             .= '<li><a href="#tab-productGallery">Product Gallery</a></li>';
    $galleryContainerOpen     .= '<div class="tabcont" id="tab-productGallery"><div class="columns is-multiline is-mobile">';
    $galleryContainerClose    .= '</div></div>';
    $galleryContain           .= '<div class="column is-12-mobile is-9-tablet is-8-desktop is-8-widescreen"><div class="product-assets-gallery">';
    $galleryContainClose      .= '</div></div>';
    $subgalleryContain        .= '<div class="column is-hidden-mobile is-hidden-tablet-only is-4-desktop is-4-widescreen"><div class="product-assets-gallery-thumbnails">';
    $subgalleryContainClose   .= '</div></div>';
    $galCount                 = 0;
    while ( have_rows('product_gallery') ) : the_row();
      $image                  = get_sub_field('image');
      $thumbImageSize         = 'product-asset-thumbnail';
      $imgVisible             = get_sub_field('visible');
      // end fields

      // main gallery
      if($imgVisible == 'yesVisible') {
        $galCount++;
        $mgal .= '<figure>';
        $mgal .= '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
        if($image['title'] != ''){
          $mgal .= '<figcaption>';
          $mgal .= $image['caption'];
          $mgal .= '<div><a href="'.$image['url'].'" title="Download Image" download>'.$downloadico.'Download Image</a></div>';
          $mgal .= '</figcaption>';
        }
        $mgal .= '</figure>';

        $tgal .= '<a class="thumb-image" href="#" data-slide="'.$galCount.'">';
        $tgal .= '<img src="'.$image['sizes']['product-asset-thumbnail'].'" alt="'.$image['product-asset-thumbnail'].'">';
        $tgal .= '</a>';
      }
      // end main gallery
    endwhile;
    $gallery .= $galleryContain;
    $gallery .= $mgal;
    $gallery .= $galleryContainClose;

    $gallery .= $subgalleryContain;
    $gallery .= $tgal;
    $gallery .= $subgalleryContainClose;
  endif;
  // end replacement parts

  // literature
  if( have_rows('product_literature') ):
    $litTitle               .= '<li><a href="#tab-literature">Literature</a></li>';
    $litContainerOpen       .= '<div class="tabcont" id="tab-literature"><div class="columns is-multiline is-mobile">';
    $litContainerClose      .= '</div></div>';
    while ( have_rows('product_literature') ) : the_row();
      $litVisible           = get_sub_field('visible');
      $litImage             = get_sub_field('image');
      $litUpdate            = get_sub_field('update_date');
      $litFile              = get_sub_field('literature_file');
      $defaultImage         = get_field('default_literature_image', 'options');
      $moreAfter            = get_field('more_link_after', 'options');

      $litBlock .= '<div class="column is-12-mobile is-4-tablet is-4-desktop is-4-widescreen">';
      $litBlock .= '<div class="lit-block">';
      $litBlock .= '<div class="lit-image">';
      if($litImage != ''){
        $litBlock .= '<a href="'.$litFile['url'].'" title="Download '.$litFile['title'].'" download><img src="'.$litImage['url'].'" alt="Download '.$litFile['title'].'"><div class="shadow"></div></a>';
      } else {
        $litBlock .= '<a href="'.$litFile['url'].'" title="Download '.$litFile['title'].'" download><img src="'.$defaultImage['url'].'" alt="Download '.$litFile['title'].'"><div class="shadow"></div></a>';
      }
      $litBlock .= '</div>';
      $litBlock .= '<div class="cont prod-cont">';
      $litBlock .= '<div class="lit-title"><a href="'.$litFile['url'].'" title="Download '.$litFile['title'].'" download>'.$litFile['title'].'</a></div>';
      $litBlock .= '<hr class="cb">';
      if($litUpdate != ''){
        $litBlock .= '<span class="update">last updated '.$litUpdate.'</span>';
      }
      $litBlock .= '<div class="button-block">';
      $litBlock .= '<a class="btn" href="'.$litFile['url'].'" title="Download '.$litFile['title'].'" download>Download'.$moreAfter.'</a>';
      $litBlock .= '</div>';
      $litBlock .= '</div>';
      $litBlock .= '</div>';
      $litBlock .= '</div>';
    endwhile;
    $literature .= $litBlock;
  endif;
  // end literature

  // videos
  if( have_rows('product_videos') ):
    $youtubeAPI       = get_field('youtube_api', 'options');
    $playBtnIcon      = get_field('play_button', 'options');
    //
    $vidTitle               .= '<li><a href="#tab-videos">Videos</a></li>';
    $vidContainerOpen       .= '<div class="tabcont" id="tab-videos"><div class="columns is-multiline is-mobile">';
    $vidContainerClose      .= '</div></div>';
    while ( have_rows('product_videos') ) : the_row();
      $video                = get_sub_field('video_url'); //Embed Code
      $video_url            = get_sub_field('video_url', FALSE, FALSE); //URL
      $video_thumb_url      = get_video_thumbnail_uri($video_url);
      $video_id_conversion  = parse_str( parse_url( $video_url, PHP_URL_QUERY ), $vars );
      $video_id             = $vars['v'];
      $vidVis               = get_sub_field('visible');
      $vidPrimary           = get_sub_field('primary');

      if(($vidPrimary == 'yesPrimary') && ($vidVis == 'yesVisible')) {
        $videoid        = $video_id;
        $apikey         = $youtubeAPI;
        $json           = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=' . $videoid . '&key=' . $apikey . '&part=snippet,contentDetails,statistics,status');
        $data           = json_decode($json, true);
        $videoTitle     = $data['items'][0]['snippet']['title'];
        $videoDuration  = $data['items'][0]['contentDetails']['duration'];
        $time           = covtime($videoDuration);
        //
        $vid            .= '<div class="columns">';
        $vid            .= '<div class="column is-6-mobile is-4-tablet is-3-desktop is-3-widescreen">';
        $vid            .= '<div class="video">';
        $vid            .= '<a class="vidlink" data-fancybox="" href="'.$video_url.'">';
        $vid            .= '<div class="video-block">';
        $vid            .= $playBtnIcon;
        $vid            .= '<img class="video-link" src="'.$video_thumb_url.'">';
        $vid            .= '</div>';
        $vid            .= '<div class="video-title">';
        $vid            .= $videoTitle;
        $vid            .= '<span>'.$time.'</span>';
        $vid            .= '</div>';
        $vid            .= '</a>';
        $vid            .= '</div>';
        $vid            .= '</div>';
        $vid            .= '</div>';
        $vid            .= '</div>';
      }
    endwhile;
    $videoBlock              .= $vid;
  endif;
  // end videos

  if(( have_rows('product_videos') ||  (have_rows('product_literature')) || (have_rows('product_gallery')))){
      echo '<div id="productAssets" class="categories layout-builder">';
      //echo '<div class="columns">';
      echo $opening;
      echo $galleryTitle;
      echo $litTitle;
      echo $vidTitle;
      echo $closing;
      //echo '</div>';

      // gallery
      echo $galleryContainerOpen;
      echo $gallery;
      echo $galleryContainerClose;

      // literature
      echo $litContainerOpen;
      echo $literature;
      echo $litContainerClose;

      // video
      echo $vidContainerOpen;
      echo $videoBlock;
      echo $vidContainerClose;
      //
      echo '</div>';
    }

}
add_shortcode('promoProductAssets', 'promoProductAssets_shortcode');
?>
