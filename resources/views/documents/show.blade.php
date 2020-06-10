@extends('layouts.app')

@section('css')
<style>
	form{
		display: inline;
	}
	input[type=file]{
		display: inline;
	}
</style>
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>{{ $document->name }} pour le groupe {{ $group->name }}
				@if($group->documentIsOpened($document))
					<i class="fa fa-unlock"></i>
				@else
					<i class="fa fa-lock"></i>
				@endif
				<a href="{{ url('/classes/'.$group->id)}}" ><button class="btn btn-warning"><i class='fa fa-eye'></i></button></a>
				@can('view', $document)
					<a href="{{ url('/classes/'.$group->id.'/documents/'.$document->id.'/bilanPDF')}}" ><button class="btn btn-info"><i class='fa fa-file-pdf-o'></i></button></a>
				@endcan

			</h3>
		</div>
		<div class="panel-body">
			<p>
				<bold>Professeur(s) :</bold>
				@foreach($group->teachers as $teacher)
					{{$teacher->fullName()}}@if(!$loop->last){{ ", "}}@endif
				@endforeach
			</p>
			@if($document->pivot->deadline != null)
				Verrouillage le
				{{ (new Carbon($document->pivot->deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
				({{ (new Carbon($document->pivot->deadline))->diffForHumans()}})
				<hr>
			@endif
			<table id="table" class="table datatable" style="width:100%;">
				<thead>
					<tr>
						<td>Elève</td>
						<td>Fichier</td>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>

@endsection

@section('js')
	<script>
	$('#table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '/classes/{{$group->id}}/datatables/documents/{{$document->id}}',
		columns: [
			{data: 'name', name: 'name'},
			{data: 'file_name', name: 'file_name'},
		]
	});
	</script>
@endsection
