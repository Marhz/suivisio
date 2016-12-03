@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{url('vendor/eternicode/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" />
@endsection

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Création d'une situation</div>

                <div class="panel-body">
                	{{Form::open(['route' => 'classes.store'])}}
                        <div class="form-group">
                        {{Form::label('name','Libellé :')}}
                        {{Form::text('name','',['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('description','Description :')}}
                            {{Form::textarea('description','',['class' => 'form-control'])}}
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
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{url('vendor/eternicode/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
@endsection