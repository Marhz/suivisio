@if($user->portefeuille != null)
  <a href="{{$user->portefeuille}}">
    <i class="fa fa-link"></i>
  </a>
@endif
@if($user->warning())
  <i class="fa fa-warning"></i>
@endif
