<li class="dropdown-submenu">
  <a tabindex="-1" href="#"><span class="caret-left"></span>Mes classes</a>
    <ul class="dropdown-menu">
      @if(Auth::user()->teacherOfThisYear()->count() > 0)
        @foreach (Auth::user()->teacherOfThisYear() as $group)
          <li>
            <a href="{{ url('classes/'.$group->id) }}">@include('groups.partials.name')</a>
          </li>
        @endforeach
      @else
        <li><a href="#">Aucune classe assignée</a></li>
      @endif
    </ul>
</li>
<li>
  <a href="{{url('situation')}}">Situations</a>
</li>
