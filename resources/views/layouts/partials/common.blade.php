@can('view', \App\Models\MacAddress::class)
<li>
  <a href="{{url('macAddress')}}">
    @can('haveMany', \App\Models\MacAddress::class)
      Mes addresses
    @else
      Mon adresse
    @endcan
    MAC
    @cannot('opened', \App\Models\MacAddress::class)
      <i class="fa fa-lock"></i>
    @endcan
  </a>
</li>
@endcan
<li>
  <a href="{{url('changerMdp')}}">Changer de mot de passe</a>
</li>
<li>
  <a href="{{ url('/logout') }}"
    onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
    Déconnexion
  </a>
  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>
</li>
