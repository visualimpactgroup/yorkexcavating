@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="main-content">
      @php
        do_shortcode('[layoutBuilder]');
      @endphp
    </div>
  @endwhile
@endsection