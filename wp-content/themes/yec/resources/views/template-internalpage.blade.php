{{--
  Template Name: Internal page Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="main-content internal-content" id="main-content">
      <?php
        echo do_shortcode('[layoutBuilder]');
      ?>
    </div>
  @endwhile
@endsection
