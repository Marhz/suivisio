@extends('layouts.app')

@section('content')
	<div class="panel panel-info">
		<div class="panel-heading">Prof</div>
		<div class="panel-body">
			<div class="col-md-10 col-md-offset-1">
				<div class="box-container col-md-12">
					<a href="{{url('situation')}}" class="box box-blue">
						Situations
					</a>
					<a href="{{url('classes')}}" class="box box-red">
						Classes
					</a>
				</div>
			</div>
		</div>
	</div>
@endsection