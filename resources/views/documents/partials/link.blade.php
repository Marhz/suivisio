@if($file_name != null)
  <a href="{{ Storage::url($file_name) }}">
    Télécharger le document
  </a>
@else
  Pas de document
@endif
