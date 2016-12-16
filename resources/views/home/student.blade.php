@extends('layouts.app')

@section('content')
				<div class="box-container col-md-12">
					<a href="{{url('situation')}}" class="box box-blue">
						Mes situations
					</a>
					<a href="{{url('situation/create')}}" class="box box-yellow">
						Nouvelle situation
					</a>
					<a href="{{url('bilanPDF')}}" class="box box-red">
						Bilan PDF
					</a>
				</div>
@endsection