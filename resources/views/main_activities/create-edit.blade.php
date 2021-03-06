@extends('layouts.app')

@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    <div class="panel panel-default">
        <div class="panel-heading">{{isset($main_activity) ? 'Modification' : 'Création'}} d'une categorie</div>
        <div class="panel-body">
            @if(isset($main_activity))
                {{Form::model($main_activity,[
                    'method' => 'PUT',
                    'route' => ['activites_principales.update',$main_activity->id]
                ])}}
            @else
                {{Form::open(['route' => 'activites_principales.store'])}}
            @endif
                <div class="form-group">
                    {{Form::label('name','Nom :')}}
                    {{Form::text('name',null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('activity_list','Activités liées:')}}
                    {{Form::select('activity_list[]',$activities,null,['id' => 'activity_list', 'class' => 'form-control','multiple'])}}
                </div>
                <div class="form-group">
                    {{Form::submit(isset($main_activity) ? 'Modifier' : 'Créer',['class' => 'btn btn-primary form-control'])}}
                </div>
            {{Form::close()}}
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#activity_list').select2({
            closeOnSelect : false,
        });
    </script>
@endsection