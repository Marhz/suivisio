@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
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
		<div class="panel-heading"><h3>{{ $document->name }} pour le groupe @include('groups.partials.name')
				<a href="{{ url('classes/'.$group->id)}}" ><button class="btn btn-warning"><i class='fa fa-eye'></i></button></a>
			</h3>
		</div>
		<div class="panel-body">
			<p>
				<bold>Professeur(s) :</bold>
				@foreach($group->teachers as $teacher)
					{{$teacher->fullName()}}@if(!$loop->last){{ ", "}}@endif
				@endforeach
			</p>
			@if($group->deadline != null)
				Verrouillage le
				{{ (new Carbon($group->deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
				({{ (new Carbon($group->deadline))->diffForHumans()}})
				<hr>
			@endif
			<table id="table" class="table datatable" style="width:100%;">
				<thead>
					<tr>
						<td>Nom</td>
						<td>Prénom</td>
						<td>Fichier</td>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>

@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script>
	$('#table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '/classes/{{$group->id}}/datatables/documents/{{$document->id}}',
		columns: [
			{data: 'last_name', name: 'last_name'},
			{data: 'first_name', name: 'first_name'},
			{data: 'file_name', name: 'file_name'},
		]
	});
	</script>
@endsection
