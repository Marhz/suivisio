@extends('layouts.app')

@section('content')
				<div class="box-container col-md-12">
					<a href="{{url('situation')}}" class="box box-blue">
						Mes situations
					</a>
					@can ('viewPdf', \Auth::user())
					<a href="{{url('bilanPDF/'.Auth::id())}}" class="box box-red">
						Bilan PDF
					</a>
				@endif
				</div>
@endsection
