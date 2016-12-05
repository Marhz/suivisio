@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{url('js/eternicode/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            <div class="panel panel-default">
                <div class="panel-heading">{{isset($situation) ? 'Modification' : 'Création'}} d'une situation</div>
                <div class="panel-body">
                    @if(isset($situation))
                        {{Form::model($situation,[
                                                'method' => 'PUT',
                                                'route' => ['situation.update',$situation->id]
                                            ])}}
                    @else
                	   {{Form::open(['route' => 'situation.store'])}}
                    @endif
                        <div class="form-group">
                            {{Form::label('name','Libellé :')}}
                            {{Form::text('name',null,['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('description','Description :')}}
                            {{Form::textarea('description',null,['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('source_id','Source :')}}
                            {{Form::select('source_id',$sources,null,['class' =>'form-control'])}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('begin_at','Debut :')}}
                            {{Form::text('begin_at',null,['class' => 'form-control datepicker'])}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('end_at','Fin :')}}
                            {{Form::text('end_at',null,['class' => 'form-control datepicker'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('activity_list','Activitées :')}}
                            {{Form::select('activity_list[]',$activities,null,['id' => 'activity_list', 'class' => 'form-control','multiple'])}}
                        </div>
                        <div class="form-group">
                            {{Form::submit(isset($situation) ? 'Modifier' : 'Créer',['class' => 'btn btn-primary form-control'])}}
                        </div>
                    {{Form::close()}}
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{url('js/eternicode/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('js/eternicode/bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('.datepicker').datepicker({
            language : 'fr',
            autoclose : true
        });
        $('#activity_list').select2({
            closeOnSelect : false,
        });
        var data = $('#activity_list').select2('data');
        console.log(data[0].text);
        data = $("#activity_list").on("select2:unselect", function (e) { 
                        data = $(e.currentTarget).select2('data');
                       
                    });
        data = $("#activity_list").on("select2:select", function (e) { 
                        data = $(e.currentTarget).select2('data');
                       
                    });
    </script>
@endsection