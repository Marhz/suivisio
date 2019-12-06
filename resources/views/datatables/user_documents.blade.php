@foreach($user->group->documents as $document)
  {!! $user->getDocumentStatus($document) !!}
@endforeach
