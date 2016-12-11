@extends('layouts.app')

@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach  
    <div class="panel panel-default">
        <div class="panel-heading">Création d'une classe</div>

        <div class="panel-body">
        	{{Form::model($group,['method' => 'put','url' => 'classes/'.$group->id])}}
                <div class="form-group">
                {{Form::label('name','Nom de la classe :')}}
                {{Form::text('name',null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('year','Année :')}}
                    {{Form::selectRange('year',(Carbon::now()->year)-1,(Carbon::now()->year)+4,null,
                        ['class' => 'form-control'])}}
                    {{-- selection entre l'année en cours -1 an et +4 ans, année en cours par défault  --}}
                </div>
                <div class="form-group">
                    {{Form::label('course_id','Parcours :')}}
                    {{Form::select('course_id',$courses,null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::submit('Envoyer',['class' => 'btn btn-primary form-control'])}}
                </div>
            {{Form::close()}} 
        </div>
    </div>
@endsection