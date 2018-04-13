@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{url('js/eternicode/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

  <div>
  <a href={{ url('/situation')}}><button class="btn btn-default">Retour</button></a>
  </div>

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
                <div class="form-group">
                    {{Form::label('show','Afficher/masquer :')}}
                    {{Form::select('show',[1 => 'Afficher dans le tableau de synthèse', 0 => 'Ne pas afficher dans le tableau de synthèse'],$situation->show, ['id' => 'show', 'class' =>'form-control'])}}
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
                <div class="rephrasing">
                    <h3>Reformulation des activitées (optionnel)</h3>
                    @if(isset($situation))
                        @foreach($situation->activities as $activity)
                            <div class="form-group rephrasing-{{$activity->pivot->activity_id}}">
                                {{Form::label('rephrasing'.$activity->pivot->activity_id,$activity->nomenclature.' - '.$activity->label)}}
                                {{Form::textarea('rephrasing['.$activity->pivot->activity_id.']',$activity->pivot->rephrasing,['class' => 'form-control'])}}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="form-group">
                    {{Form::submit(isset($situation) ? 'Modifier' : 'Créer',['class' => 'btn btn-primary form-control'])}}
                </div>
            {{Form::close()}}
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
        var activities = $('#activity_list').select2('data');
        $("#activity_list").on("select2:unselect", function (e) {
            tmp_activities = $(e.currentTarget).select2('data');
            $.grep(activities, function(el) {
                if($.inArray(el,tmp_activities) == -1)
                    $('.rephrasing').find('.rephrasing-'+el.id).remove();
            })
            activities = tmp_activities;
        });
        $("#activity_list").on("select2:select", function (e) {
            tmp_activities = $(e.currentTarget).select2('data');
            $.grep(tmp_activities, function(el) {
                if($.inArray(el,activities) == -1){
                    var addActivity = '<div class="form-group rephrasing-'+el.id+'"><label for="rephrasing-'+el.id+'">'+el.text+'</label><br/><textarea id="rephrasing-'+el.id+'" name="rephrasing['+el.id+']" class="form-control"></textarea></div>';
                    $('.rephrasing').append(addActivity);
                }
            })
            activities = tmp_activities;
        });
        // activities.forEach(function(data){
        //     var activityForm = '<div class="form-group rephrasing-'+data.id+'"><label for="rephrasing-'+data.id+'">'+data.text+'</label><br/><textarea name="rephrasing[]" class="form-control"></textarea></div>';
        //     $('.rephrasing').append(activityForm);
        // })

    </script>
@endsection
