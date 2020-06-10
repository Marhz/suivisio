@extends('layouts.app')
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
                    {{Form::label('course_id', 'Parcours :')}}
                    {{Form::select('course_id', $courses, null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('teacher_list', 'Professeurs :')}}
                    {{Form::select('teacher_list[]', $teachers, null, ['id' => 'teacher_list', 'class' => 'form-control','multiple'])}}
                </div>
                @can('enableDocuments', \App\Models\Group::class)
                  <div class="form-group">
                    {{Form::label('document_list', 'Documents :')}}
                    {{Form::select('document_list[]', $documents, null, ['id' => 'document_list', 'class' => 'form-control','multiple'])}}
                  </div>
                @endcan
                <div class="form-group">
                    {{Form::submit(isset($group) ? 'Modifier' : 'Créer' ,['class' => 'btn btn-primary form-control'])}}
                </div>
            {{Form::close()}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#teacher_list').select2({
            closeOnSelect : false,
        });
        $('#document_list').select2({
            closeOnSelect : false,
        });
    </script>
@endsection
