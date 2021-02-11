@extends('layouts.app')
@section('content')
  @while(have_posts()) @php the_post() @endphp
  <div id="site-content" class="site-container">
    <main class="main">
      <div class="main-content internal-content" <div class="main-content" id="main-content">
        <div class="hero-shape">
          <section class="hero layout-builder internal-hero additional-padding align-rightAligned">
            @if(get_field('hero_media_type') == 'imageHero')
            <div class="hero-img" style="background: url({!! get_field('hero_image')['url'] !!}) #000" data-type="parallax" data-speed="-2"></div>
            @else
            <div class="vid hero-img">
							<video width="100%" height="100%" class="video" muted="" loop="" playsinline="" autoplay="">
								<source src="{!! get_field('hero_video')['url'] !!}" type="video/mp4">
							</video>
						</div>
            @endif
            <div class="columns is-multiline is-mobile">
                <div class="column is-hidden-mobile is-hidden-tablet-only is-7-mobile is-7-widescreen"></div>
                <div class="column is-12-mobile is-12-tablet is-5-desktop is-5-widescreen is-5-widescreen">
                  <div class="content animated fadeInUp ">
                    @php
                      //echo do_shortcode('[breadcrumb]');
                    @endphp
                    <h1>{!! the_title() !!}</h1>
                    @php
                    $location		= get_field('project_location');
                    $budget		  = get_field('project_value');
                    $locationIc = get_field('location_icon', 'options');
                    $o .= '<div class="meta">';
              			if($location){
              				$o .= '<div>'.$locationIc.$location.'</div>'; // location
              			}
                    if($budget){
              				$o .= '<div><icon class="icon-icon-dollar-sign"></icon>Valued at '.$budget.'</div>'; // budget
              			}
              			$o .= '<hr class="cb"></div>';
                    echo $o;
                    @endphp
                    {!! get_field('project_summary') !!}
                  </div>
                </div>
            </div>
          </section>
        </div>
      </div>
      <!--main content-->
      <section class="threequarter layout-builder leftalign">
        <div class="columns is-multiline is-mobile layout-builder">
          <div class="column is-12">
            {!! get_field('project_description') !!}
            @include('partials.sitespecific.layoutpieces.button-block')
          </div>

          @if(get_field('project_gallery') != '')
            @php
              $images = get_field('project_gallery');
              if($images){
                $gallery .= '<div class="column is-12">';
                $gallery .= '<ul class="gallery">';
                foreach( $images as $image ){
                  $img .= '<li>';
                  $img .= '<a data-fancybox="images" data-caption="'.$image['title'].'" href="'.$image['url'].'">';
                  $img .= '<img src="'.$image['sizes']['gal-image'].'" alt="'.$image['alt'].'">';
                  $img .= '</a>';
                  $img .= '</li>';
                }
                $gallery .= $img;
                $gallery .= '</ul>';
                $gallery .= '</div>';

                echo $gallery;
              }
            @endphp
          @endif
        </div>
      </section>
    </main>
  </div>
  @endwhile

@endsection
