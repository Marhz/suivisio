@extends('layouts.mail')

@section('body')
<P>
  {{ User::find($notification->data['commenter'])->fullName() }}
  a commenté la situation
  @include('situations.partials.link', ['situation' => App\Models\Situation::find($notification->data['situation'])]) :
</P>
<P>
  {{ App\Models\Comment::find($notification->data['comment'])->comment }}
</P>
@stop
