<div class="slide-content">
@php
$alertBar   = get_field('display_bar','options');
$alert      = get_field('alerts','options');
$expiration = get_field('expiration_date','options');
$date       = date('Ymd');

if(($alertBar == 'yes') && ($expiration >= $date)){
  echo '
  <section class="alert-bar">
    <div class="columns is-multiline is-mobile">
      <div class="column is-12">
        <div class="alert-message">'.$alert.'</div>
      </div>
    </div>
  </section>
  ';
}
@endphp

<header id="header">
  <div class="top-tier">
    <a href="#main-content" class="skip-link" tabindex="0" aria-label="Click to Skip to Content">Skip to content</a>
    <div class="columns is-relative" aria-label="Welcome. If you have any questions, please contact us by phone at {!! $globalvalue->mainphone !!} or by email at {!! $globalvalue->mainemail !!}">
      <div class="column is-12">
        <nav class="top-tier-nav">
          @php echo wp_userlogin(); @endphp
        </nav>
      </div>
    </div>
  </div>
  <div class="header-container">
    <div class="header-bar">
      <div class="columns is-mobile is-multiline">
        <div class="column is-12-mobile is-12-tablet is-3-desktop is-3-widescreen">
          <div class="brand">
            <a href="/" title="Return to {!! $globalvalue->sitetitle !!} Homepage" itemscope itemtype="http://schema.org/Brand">
              <img class="primary-logo" src="{!! $globalvalue->slogo['url'] !!}" alt="{!! $globalvalue->sitetitle !!}">
              <img class="colored-logo" src="{!! $globalvalue->logo['url'] !!}" alt="{!! $globalvalue->sitetitle !!}">
            </a>
          </div>
          <button id="my-icon" class="mobile-only hamburger hamburger--collapse navigation_button js-menuToggle fr" type="button" aria-label="Launch the Mobile Navigation Menu">
             <span class="hamburger-box">
                <span class="hamburger-inner"></span>
                <span class="screen-reader-text">Menu</span>
             </span>
          </button>
        </div>
        <div class="column hide-tablet is-hidden-mobile-only is-12-tablet is-9-desktop is-9-widescreen">
          <nav class="main-nav">
            {!! wp_nav_menu(['theme_location' => 'Main Navigation', 'menu_class' => 'main-nav']) !!}
          </nav>
        </div><!--/MainNav-->
      </div>
    </div>
  </div>
</header>
