@php $placement = get_field('alignment'); @endphp
@if(have_rows('Buttons'))
  <div class="button-block @php echo $placement; @endphp">
    @while (have_rows('Buttons'))@php(the_row())
      <a class="btn {!! get_sub_field('button_type') !!}" href="{!! get_sub_field('button')['url'] !!}" title="{!! get_sub_field('button')['title'] !!}">
        {!! get_sub_field('button')['title'] !!}{!! $globalvalue->morelinkafter !!}
      </a>
    @endwhile
  </div>
@endif
