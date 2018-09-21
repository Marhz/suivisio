@extends('layouts.app')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    <div class="panel panel-default">
        <div class="panel-heading">{{isset($group) ? 'Modification' : 'Création'}} d'une classe</div>

        <div class="panel-body">
            @if (isset($group))
                {{Form::model($group,['method' => 'put','url' => 'classes/'.$group->id])}}
            @else
                {{Form::open(['route' => 'classes.store'])}}
            @endif
                <div class="form-group">
                {{Form::label('name','Nom de la classe :')}}
                {{Form::text('name',null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('year','Année :')}}
                    {{Form::selectRange('year',(Carbon::now()->year)-1,(Carbon::now()->year)+4,isset($group) ? null : Carbon::now()->year,
                        ['class' => 'form-control'])}}
                    {{-- selection entre l'année en cours -1 an et +4 ans, année en cours par défault  --}}
                </div>
                <div class="form-group">
                  {{Form::label('deadline','Date limite pour les étudiants :')}}
                  {{Form::date('deadline', isset($group) && $group->deadline != null ? new Carbon($group->deadline) : null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{Form::label('mac_address_deadline','Date limite pour la saisie des adresses MAC :')}}
                  {{Form::date('mac_address_deadline', isset($group) && $group->mac_address_deadline != null? new Carbon($group->mac_address_deadline) : null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('course_id','Parcours :')}}
                    {{Form::select('course_id',$courses,null,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('teacher_list','Professeurs :')}}
                    {{Form::select('teacher_list[]', $teachers, null, ['id' => 'teacher_list', 'class' => 'form-control','multiple'])}}
                </div>
                <div class="form-group">
                    {{Form::submit(isset($group) ? 'Modifier' : 'Créer' ,['class' => 'btn btn-primary form-control'])}}
                </div>
            {{Form::close()}}
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#teacher_list').select2({
            closeOnSelect : false,
        });
    </script>
@endsection
