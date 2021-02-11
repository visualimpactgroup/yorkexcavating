<div class="main-content internal-content layout-builder portal">
  <div class="columns is-multiline is-mobile">
    @php
    if(is_single('dashboard')){
    @endphp
    <div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">
      <article class="blog-article">
        <div class="entry-content">
          {!! wp_username() !!}
          {!! the_content() !!}
          {!! do_shortcode('[portalList]') !!}
          <div class="dashboard-nav">
          {!! wp_nav_menu(['theme_location' => 'Dashboard Navigation', 'menu_class' => 'dashboard-navigation']) !!}
          </div>
        </div>
      </article>
    </div>
    @php
    } else {
    @endphp
      <div class="column is-12-mobile is-12-tablet is-9-desktop is-9-widescreen">
        {!! the_content() !!}
        {!! do_shortcode('[portalList]') !!}
      </div>
      <div class="column is-12-mobile is-12-tablet is-3-desktop is-3-widescreen">
        <div class="column-sidebar">
          <div class="portal-title">
            Browse Resources
          </div>
          {!! wp_nav_menu(['theme_location' => 'Portal Navigation', 'menu_class' => 'portal-navigation']) !!}
        </div>
      </div>
    @php
    }
    @endphp
  </div>
</div>
