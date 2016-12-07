@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{url('js/eternicode/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Situation de {{$situation->user->fullName()}}</div>
                <div class="panel-body">
                    <p>{{$situation->name}}, vécue en : {{$situation->source->label}}</p>
                    <p>{{$situation->description}}</p>
                    <p>Commencée le: {{$situation->begin_at}}, finie le: {{$situation->end_at}}</p>
                    @foreach($situation->activities as $activity)
                        <p>{{$activity->fullName()}}</p>
                        <p>{!!isset($activity->pivot->rephrasing) && $activity->pivot->rephrasing != '' ? $activity->pivot->rephrasing : '<i>Pas de reformulation</i>'!!}</p>
                    @endforeach
                    @if(Auth::user()->level < 2)
                        {{Form::open()}}
                            <div class="form-group">
                                {{Form::label('comment','Commentaire :')}}
                                {{Form::textarea('comment',null,['class' => 'form-control'])}}
                            </div>
                            {{Form::submit('Envoyer',['class' => 'btn btn-primary form-control'])}}
                        {{Form::close()}}
                    @endif
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
    <script src="{{url('js/vue.js')}}"></script>
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