<section class="map-block">
  <?php
    $map = get_field('map', 'options');

    $o .= '<div class="acf-map">';
    $o .= '<div class="marker" data-lat="'.$map['lat'].'" data-lng="'.$map['lng'].'"></div>';
    $o .= '</div>';

    echo $o;


    $location = get_field('map', 'options');
    if( $location ){
    ?>
        <div class="acf-map" data-zoom="16">
            <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
        </div>
    <?php      
    }
  ?>
</section>
