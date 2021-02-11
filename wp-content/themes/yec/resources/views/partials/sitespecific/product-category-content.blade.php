<!-- Category Content -->
<section class="categories layout-builder internal-categories">
{!! get_field('category_content') !!}
@php
  $cate = get_queried_object();
  $cateID = $cate->term_id;
  $displayType = woocommerce_get_loop_display_mode($cateID);
  if($displayType == 'products'){
    echo do_shortcode('[getProductsList]');
  } else {
    echo do_shortcode('[getSubCategories]');
  }
@endphp
</section>
<!--/Category Content -->
