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
      <i class="fa fa-check fa-2x" style="position:relative ; top:5px; left:2px"></i>
    @else
      <i class="fa fa-times fa-2x" style="position:relative ; top:5px; left:2px"></i>
      {{ $pivot->comment }}
    @endif
  @else
    <i class="fa fa-clock-o fa-2x" style="position:relative ; top:5px; left:2px"></i>
  @endif
@else
  <i class="fa fa-warning fa-2x" style="position:relative ; top:2px; left:5px"></i>
@endif
