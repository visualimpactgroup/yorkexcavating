<div class="main-content internal-content layout-builder blog-layout">
  <div class="columns is-multiline is-mobile">
    <div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen header-section">
      <h1>{!! the_title !!}</h1>
      @if(get_field('article_image') != '')
        <img src="{!! get_field('article_image')['url'] !!}" alt="{!! the_title !!}" class="master-image">
      @endif
    </div>

    @if(get_field('include_sidebar', 'options') == 'yes')
    <div class="column is-12-mobile is-12-tablet is-9-desktop is-9-widescreen">
      <article @php post_class() @endphp class="blog-article">
        <div class="entry-content">
          @if(get_field('post_image') != '')
          <img src="{!! get_field('post_image')['url'] !!}" alt="{!! get_field('post_article_subtitle_lead_in') !!}" class="master-image">
          @else
          <img src="{!! get_field('post_image')['url'] !!}" alt="{!! get_field('post_article_subtitle_lead_in') !!}" class="master-image">
          @endif

          {!! the_content() !!}

          @if(get_field('post_article_subtitle_lead_in') != '')
          <div class="signoff">
            <div class="title">{!! get_field('post_signoff_title') !!}</div>
            {!! get_field('post_signoff_content') !!}

            @if (have_rows('signoff_buttons'))
            <div class="button-block">
              @while(have_rows('signoff_buttons')) @php(the_row())
                <a class="btn {!! get_sub_field('button_type') !!}" href="{!! get_sub_field('button')['url'] !!}" title="{!! get_sub_field('button')['title'] !!}" target="{!! get_sub_field('button')['target'] !!}">{!! get_sub_field('button')['title'] !!}{!! $globalvalue->morelinkafter !!}</a>
              @endwhile
            </div>
            @endif
          </div>
          @endif
        </div>
        {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
      </article>
    </div>
    <div class="column is-12-mobile is-12-tablet is-3-desktop is-3-widescreen">
      <?php
        echo do_shortcode('[sidebar]');
      ?>
    </div>
    @else
    <div class="column is-12-mobile is-12-tablet is-{!! get_field('blog_width', 'options') !!}-desktop is-{!! get_field('blog_width', 'options') !!}-widescreen">
      <article class="blog-article">
        <div class="entry-content">
          @if(get_field('post_image') != '')
          <img src="{!! get_field('post_image')['url'] !!}" alt="{!! get_field('post_article_subtitle_lead_in') !!}" class="master-image">
          @else
          <img src="{!! get_field('post_image')['url'] !!}" alt="{!! get_field('post_article_subtitle_lead_in') !!}" class="master-image">
          @endif

          {!! the_content() !!}

          @if(get_field('post_article_subtitle_lead_in') != '')
          <div class="signoff">
            <div class="title">{!! get_field('post_signoff_title') !!}</div>
            {!! get_field('post_signoff_content') !!}

            @if (have_rows('signoff_buttons'))
            <div class="button-block">
              @while(have_rows('signoff_buttons')) @php(the_row())
                <a class="btn {!! get_sub_field('button_type') !!}" href="{!! get_sub_field('button')['url'] !!}" title="{!! get_sub_field('button')['title'] !!}" target="{!! get_sub_field('button')['target'] !!}">{!! get_sub_field('button')['title'] !!}{!! $globalvalue->morelinkafter !!}</a>
              @endwhile
            </div>
            @endif
          </div>
          @endif
        </div>
      </article>
    </div>
    @endif
  </div>
</div>
