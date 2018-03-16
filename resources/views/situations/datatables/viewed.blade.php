<span class='fa-color'>
  <span class='hidden'>
    {{ $situation->viewed }}
  </span>
  <i class=
    @if($situation->viewed)
      'fa fa-eye'
    @else
      'fa fa-eye-slash'
    @endif>
  </i>
</span>
