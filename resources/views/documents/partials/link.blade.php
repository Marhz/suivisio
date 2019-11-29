@if($pivot != null)
  @if(isset($pivot->validated))
    @if($pivot->validated)
      <i class="fa fa-check fa-2x" style="position:relative ; top:5px; left:2px" data-toggle="tooltip" title="{{ $document->name }} accepté"></i>
    @else
      <i class="fa fa-times fa-2x" style="position:relative ; top:5px; left:2px" data-toggle="tooltip" title="{{ $document->name }} refusé"></i>
    @endif
  @else
    <i class="fa fa-clock-o fa-2x" style="position:relative ; top:5px; left:2px" data-toggle="tooltip" title="{{ $document->name }} en attente de validation"></i>
  @endif
@else
  <i class="fa fa-warning fa-2x" style="position:relative ; top:2px; left:5px"  data-toggle="tooltip" title="{{ $document->name }} non déposé"></i>
@endif
