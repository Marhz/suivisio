@if($pivot != null)
  <a href="{{ Storage::url($pivot->file_name) }}">
    <button class="btn btn-primary"><i class='fa fa-download'></i></button>
  </a>
  @can('accept', \App\Models\Document::class)
    <a href="{{ url('/users/'.$pivot->user_id.'/documents/'.$pivot->document_id) }}">
      <button class="btn btn-danger"><i class='fa fa-edit'></i></button>
    </a>
  @endcan
  @if(isset($pivot->validated))
    @if($pivot->validated)
      <i class="fa fa-check"></i>
    @else
      <i class="fa fa-times"></i>
      {{ $pivot->comment }}
    @endif
  @else
    En attente de validation.
  @endif
@else
  Pas de document
@endif
