@extends('layouts.app')

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ajout d'un élève à la classe {{$group->name}}</div>

                <div class="panel-body">
                	{{Form::open()}}
                        <div class="form-group">
                        {{Form::label('last_name','Nom :')}}
                        {{Form::text('last_name',null,['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('first_name','Prénom :')}}
                            {{Form::text('first_name',null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('email','Email :')}}
                            {{Form::email('email',null, ['class' => 'form-control'])}}
                        </div>
                        {{Form::hidden('group_id',$group->id)}}
                        <div class="form-group">
                            {{Form::submit('Envoyer',['class' => 'btn btn-primary form-control'])}}
                        </div>
                    {{Form::close()}}
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection