@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{url('js/eternicode/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div>
    <a href={{ url('/situation')}}><button class="btn btn-default">Retour</button></a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
          Situation de {{$situation->user->fullName()}}
          @include('groups.partials.lock', ['group' => $situation->user->group])
        </div>
        <div class="panel-body">
            <p>
                <b>Nom: </b>{{$situation->name}}
            </p>
            <p>
                <b>Vécue en: </b>{{$situation->source->label}}
            </p>
            <p>
                <span class='fa-color'>
                  @if($situation->show)
                    <i class='fa fa-eye'></i> (Visible dans le tableau de synthèse)
                  @else
                    <i class='fa fa-eye-slash'></i> (N'apparaît pas dans le tableau de synthèse)
                  @endif
                </span>
            <p>
                <b>Dates: </b>du {{$situation->begin_at}} au {{$situation->end_at}}
            </p>
            <p>
                <b>description: </b><br/>
                {{$situation->description}}
            </p>
            @foreach($situation->activities as $activity)
                <p>
                    <b>{{$activity->fullName()}}</b>
                </p>
                <p>
                    @if(isset($activity->pivot->rephrasing) && $activity->pivot->rephrasing != '')
                        {{ $activity->pivot->rephrasing }}
                    @else
                        <i>Pas de reformulation</i>
                    @endif
                </p>
            @endforeach
            @foreach($situation->comments as $comment)
                <div class="comment">
                    <i>{{$comment->user->fullName()}}, le {{$comment->updated_at}}</i>
                    @if($comment->user_id == Auth::user()->id || Auth::user()->isAdmin())
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
            @if(Auth::user()->isTeacher() || Auth::user()->owns($situation))
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
