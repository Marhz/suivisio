@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{url('js/eternicode/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
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
            @foreach($situation->comments as $comment)
                <div class="comment">
                    <i>{{$comment->user->fullName()}}, le {{$comment->updated_at}}</i>
                    @if($comment->user_id == Auth::user()->id || Auth::user()->level == 0)
                        {{Form::open([
                            'method' => 'DELETE',
                            'route' => ['comment.destroy',$comment->id],
                            'class' => 'x-delete']
                        )}}
                            {{Form::submit('X',['class' => 'btn pull-right'])}}
                        {{Form::close()}}
                    @endif
                    <hr/>
                    <p class="">{{$comment->comment}}</p>
                </div>
            @endforeach
            @if(Auth::user()->level < 2)
                {{Form::open(['route' => ['comment.store',$situation->id]])}}
                    <div class="form-group">
                        {{Form::label('comment','Commentaire :')}}
                        {{Form::textarea('comment',null,['class' => 'form-control'])}}
                    </div>
                    {{Form::submit('Envoyer',['class' => 'btn btn-primary form-control'])}}
                {{Form::close()}}
            @endif
        </div>
    </div>
@endsection

@section('js')

@endsection