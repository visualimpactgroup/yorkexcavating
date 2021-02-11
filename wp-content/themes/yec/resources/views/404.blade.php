@extends('layouts.app')

@section('content')
  @if (!have_posts())
  <div class="main-content internal-content">
    <section class="header-bar layout-builder">
      <div class="columns is-multiline is-mobile">
        <div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen">
          <h1>404: Page Not Found</h1>
        </div>
      </div>
    </section>
    <div class="columns leftalign layout-builder is-multiline is-mobile">
      <div class="column is-12-mobile is-12-tablet is-12-desktop is-12-widescreen leftalign">
        <h2>It Looks Like Something Has Moved</h2>
        <p>Sorry, but the page you were trying to view does not exist or has moved.</p>
        <div class="button-block">
          <a class="btn styled" href="/" title="Return to Homepage" target="">Return to Homepage<icon class="icon-arr-r"></icon></a>
        </div>
      </div>
    </div>
  </div>
  @endif
@endsection
