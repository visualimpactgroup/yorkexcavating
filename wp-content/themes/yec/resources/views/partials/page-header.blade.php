<section class="header-bar layout-builder">
  <div class="columns is-multiline is-mobile">
    <div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">
      <div class="hero-content">
        <div class="hero-text-cont">
          @php
            echo do_shortcode('[breadcrumb]');
          @endphp  
          <h1>{{ the_title() }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>
