<li>
  <a href="{{url('situation')}}">Situations @include('groups.partials.lock', ['group' => Auth::user()->group])</a>
</li>
@if(Auth::user()->isOpened())
  <li>
    <a href="{{url('situation/create')}}">Ajouter une situation</a>
  </li>
@endif
<li
@cannot ('viewPDF', \Auth::user())
  class="disabled" onclick='return false;'
@endcan
>
  <a href="{{url('bilanPDF/'.Auth::id())}}">Bilan PDF</a>
</li>
<li
@cannot('changerNumeroCandidat', Auth::user())
  class="disabled" onclick='return false;'
@endcan
>
<a href="{{url('changerNumeroCandidat')}}">Mon numéro de candidat
@cannot('changerNumeroCandidat', Auth::user())
  <i class="fa fa-lock"></i>
@endcan
@if (\Auth::user()->numeroCandidat == null)
  <i class="fa fa-warning"></i>
@endif
</a>
</li>
@can('view', \App\Models\Poll::class)
<li>
  <a href="{{url('poll')}}">
    Mes voeux pour le deuxième semestre
    @cannot('edit', \App\Models\Poll::class)
      <i class="fa fa-lock"></i>
    @endcan
  </a>
</li>
@endcan
