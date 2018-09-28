@can('view', \App\Models\MacAddress::class)
<li>
  <a href="{{url('macAddress')}}">
    @can('haveMany', \App\Models\MacAddress::class)
      Mes addresses
    @else
      Mon adresse
    @endcan
    MAC
  </a>
</li>
@endcan
