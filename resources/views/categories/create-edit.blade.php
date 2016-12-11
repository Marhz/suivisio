@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{url('js/eternicode/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    <div class="panel panel-default">
        <div class="panel-heading">{{isset($category) ? 'Modification' : 'Création'}} d'une categorie</div>
        <div class="panel-body">
            @if(isset($category))
                {{Form::model($category,[
                    'method' => 'PUT',
                    'route' => ['categories.update',$category->id]
                ])}}
            @else
                {{Form::open(['route' => 'categories.store'])}}
            @endif
                <div class="form-group">
                    {{Form::label('nomenclature','Nomenclature :')}}
                    {{Form::text('nomenclature',null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('label','Libellé :')}}
                    {{Form::text('label',null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('course_id','Parcours :')}}
                    {{Form::select('course_id',
                    [
                        0 => 'indiferencié',
                        2 => 'SLAM',
                        3 => 'SISR'
                    ],
                    null,['class' =>'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('activity_list','Activitées :')}}
                    {{Form::select('activity_list[]',$activities,null,['id' => 'activity_list', 'class' => 'form-control','multiple'])}}
                </div>
                <div class="form-group">
                    {{Form::submit(isset($category) ? 'Modifier' : 'Créer',['class' => 'btn btn-primary form-control'])}}
                </div>
            {{Form::close()}}
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#activity_list').select2({
            closeOnSelect : false,
        });
    </script>
@endsection