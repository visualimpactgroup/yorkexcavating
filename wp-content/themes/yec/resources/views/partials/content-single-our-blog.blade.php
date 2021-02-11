<div class="main-content internal-content">
  <div class="columns is-multiline is-mobile">
    @if(get_field('include_sidebar', 'options') == 'yes')
    <div class="column is-12-mobile is-12-tablet is-8-desktop is-8-widescreen">
      <article @php post_class() @endphp class="blog-article">
        <div class="entry-content">
          @if(get_field('article_image') != '')
          <img src="{!! get_field('article_image')['url'] !!}" alt="{!! the_title !!}" class="master-image">
          @endif
          @php the_content() @endphp
        </div>
        {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
      </article>
    </div>
    <div class="column is-12-mobile is-12-tablet is-4-desktop is-4-widescreen">
      <?php
        echo do_shortcode('[sidebar]');
      ?>
    </div>
    @else
    <div class="column is-12-mobile is-12-tablet is-{!! get_field('blog_width', 'options') !!}-desktop is-{!! get_field('blog_width', 'options') !!}-widescreen">
      <article @php post_class() @endphp class="blog-article">
        <div class="entry-content">
          @php the_content() @endphp
        </div>
        {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
      </article>
    </div>
    @endif
  </div>
  @php
    echo do_shortcode('[newJobsBlock]');
  @endphp
</div>
