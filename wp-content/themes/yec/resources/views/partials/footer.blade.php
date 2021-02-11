  <footer class="content-info footer-container layout-builder">
    <div class="columns is-multiline is-mobile footer-block">
      <div class="column is-12-mobile is-12-tablet is-4-desktop is-4-widescreen">
        <div class="brand">
          <a href="/" title="{!! App::title() !!}">
            <img src="{!! $globalvalue->wlogo['url'] !!}" alt="{!! $globalvalue->logo !!}">
          </a>
        </div>
        <div class="cinfo">
          <ul>
            <li>{!! $globalvalue->address !!}<br>{!! $globalvalue->city !!}, {!! $globalvalue->state !!} {!! $globalvalue->zip !!}</li>
          </ul>
        </div>

      </div>
      <div class="column is-hidden-mobile is-hidden-tablet-only is-6-desktop is-6-widescreen">
        <div class="content-links">
          <nav class="link-group">
            {!! wp_nav_menu(['theme_location' => 'Footer Navigation', 'menu_class' => 'footer-nav']) !!}
          </nav>
          @if(get_field('phone','options'))
          <div class="contact-block"><span>{!! $globalvalue->phoneicon !!}</span>{!! $globalvalue->mainphone !!}</div>
          @endif

          @if(get_field('email_address','options'))
          <div class="contact-block"><span>{!! $globalvalue->emailicon !!}</span>{!! $globalvalue->mainemail !!}</div>
          @endif
        </div>
      </div>
      <div class="column is-12-mobile is-12-tablet is-2-desktop is-2-widescreen">
        @php echo do_shortcode('[socialmedia]') @endphp
      </div>
      <!-- Footer Bar-->
    </div>
  </footer>
  <section class="copyright-block">
    <div class="columns is-multiline">
      <div class="column is-12-desktop">
        <div class="grey-block" tabindex="0">
          &copy; <?php echo date("Y"); ?> {!! $globalvalue->sitetitle !!}. All Rights Reserved.
          <nav class="copyright-nav">
            {!! wp_nav_menu(['theme_location' => 'Copyright Navigation', 'menu_class' => 'copyright-nav']) !!}
          </nav>
        </div>
        @if(get_field('compliancy_note','options'))
        <div class="grey-block" tabindex="0">
          {!! $globalvalue->compnote !!}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@if (has_nav_menu('Mobile Navigation'))
<nav id="menu">
  <div>
    <div>
       <div class="logo-block">
         <a class="brand" href="{{ home_url('/') }}" title="Return to {!! $globalvalue->sitetitle !!} Homepage"><img src="{!! $globalvalue->wlogo['url'] !!}" alt="{!! $globalvalue->sitetitle !!}"></a>
       </div>
    </div>
    {!! wp_nav_menu(['theme_location' => 'Mobile Navigation', 'menu_class' => 'mobile-nav', 'container' => false ]) !!}
    @php echo wp_userlogin(); @endphp
  </div>
</nav>
@endif
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = '/thank-you/';
}, false );
</script>
