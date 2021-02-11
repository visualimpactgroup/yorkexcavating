<article class="article-archive" @php post_class() @endphp>
  <h2><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
  @php
    the_excerpt();
  @endphp
</article>
