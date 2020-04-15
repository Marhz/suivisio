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
<a href="{{url('changerNumeroCandidat')}}">Mes données
@cannot('changerNumeroCandidat', Auth::user())
  <i class="fa fa-lock"></i>
@endcan
@if (\Auth::user()->warning())
  <i class="fa fa-warning"></i>
@endif
</a>
</li>
@can('view', \App\Models\Poll::class)
<li>
  <a href="{{url('poll')}}">
    Mon choix d'orientation
    @cannot('edit', \App\Models\Poll::class)
      <i class="fa fa-lock"></i>
    @endcan
  </a>
</li>
@endcan
@if(config('app.enable_documents'))
  @foreach(\Auth::user()->group->documents as $document)
  <li>
    <a href="{{url('/documents/'.$document->id)}}">
      {{ $document->name }}
      <i class="fa fa-{{ $document->validatedStatus(\Auth::user()) }} "></i>
        @can('edit', $document)
          <i class="fa fa-unlock"></i>
        @else
          <i class="fa fa-lock"></i>
        @endcan
  </li>
    @endforeach
  @endif
