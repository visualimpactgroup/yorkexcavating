<div class="main-content internal-content layout-builder">
  <div class="columns is-multiline is-mobile">
    <div class="column is-12-mobile is-12-tablet is-{!! get_field('blog_width', 'options') !!}-desktop is-{!! get_field('blog_width', 'options') !!}-widescreen">
      <article @php post_class() @endphp class="blog-article">
        <div class="entry-content">
          @php
            echo do_shortcode('[career_single]');
          @endphp
        </div>
      </article>
    </div>
    @if(get_field('employment_eoe_note', 'options') != '')
    <div class="column is-12-mobile is-12-tablet is-3-desktop is-3-widescreen eoe-note">
      <div class="sidebar">
        {!! get_field('employment_eoe_note', 'options') !!}
      </div>
    </div>
    @endif
  </div>
</div>
