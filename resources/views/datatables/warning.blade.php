@if($user->portefeuille != null)
  <a href="{{$user->portefeuille}}">
    <i class="fa fa-link fa-2x" style="position:relative ; top:5px; left:2px"></i>
  </a>
@endif
@if($user->warning())
  <i class="fa fa-warning fa-2x" style="position:relative ; top:5px; left:2px"></i>
@endif
