@extends('layouts.app')

@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    <div class="panel panel-default">
        <div class="panel-heading">Deadlines de la classe {{ $group->name }} </div>
        <div class="panel-body">
              {{Form::model($group,['method' => 'put','url' => 'classes/'.$group->id.'/deadlines'])}}
                <div class="form-group">
                <div class="form-group">
                  {{Form::label('deadline','Situations :')}}
                  {{Form::date('deadline', $group->deadline != null ? new Carbon($group->deadline) : null,['class' => 'form-control'])}}
                </div>
                @can('enableMacAddressesCollect', \App\Models\Group::class)
                  <div class="form-group">
                    {{Form::label('mac_address_deadline','Adresses MAC :')}}
                    {{Form::date('mac_address_deadline', $group->mac_address_deadline != null? new Carbon($group->mac_address_deadline) : null,['class' => 'form-control'])}}
                  </div>
                @endcan
                @can('enableCoursesPoll', \App\Models\Group::class)
                  <div class="form-group">
                    {{Form::label('poll_deadline','Voeux :')}}
                    {{Form::date('poll_deadline', $group->poll_deadline != null? new Carbon($group->poll_deadline) : null,['class' => 'form-control'])}}
                  </div>
                @endcan
                @can('enableDocuments', $group)
                  @foreach($documents as $id => $document)
                    <div class="form-group">
                      {{Form::label($document->id,$document->name)}}
                      {{Form::date($document->id, $document->pivot->deadline != null? new Carbon($document->pivot->deadline) : null,['class' => 'form-control'])}}
                    </div>
                    @endforeach
                @endcan
                <div class="form-group">
                    {{Form::submit('Enregistrer')}}
                </div>
            {{Form::close()}}
        </div>
    </div>
@endsection
