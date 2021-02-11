@extends('layouts.app')

@section('content')

  <div class="hero single">
    <div class="columns is-multiline is-mobile">
      <div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">
        <div class="hero-content">
          <div class="hero-text-cont">
            @while(have_posts()) @php the_post() @endphp
            <h1>{{ the_title() }}</h1>
            <?php
            if (! is_singular( 'portal' ) ) {
              echo do_shortcode('[headerMeta]');
            }
            ?>
            @endwhile
          </div>
        </div>
      </div>
    </div>
  </div>

  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-single-'.get_post_type())
  @endwhile
@endsection
