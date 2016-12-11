@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Création d'une classe</div>
        <div class="panel-body">
        	{{Form::open(['route' => 'classes.store'])}}
                <div class="form-group">
                {{Form::label('name','Nom de la classe :')}}
                {{Form::text('name','',['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('year','Année :')}}
                    {{Form::selectRange('year',(Carbon::now()->year)-1,(Carbon::now()->year)+4,Carbon::now()->year,
                        ['class' => 'form-control'])}}
                    {{-- selection entre l'année en cours -1 an et +4 ans, année en cours par défault  --}}
                </div>
                <div class="form-group">
                    {{Form::label('course_id','Parcours :')}}
                    {{Form::select('course_id',$courses,'',['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::submit('Envoyer',['class' => 'btn btn-primary form-control'])}}
                </div>
            {{Form::close()}}
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach   
        </div>
    </div>
@endsection