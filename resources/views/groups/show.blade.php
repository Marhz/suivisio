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
		<div class="panel-heading"><h3>@include('groups.partials.name')
		@can('edit', $group)
			<a href="{{ url('classes/'.$group->id.'/edit')}}" ><button class="btn btn-warning"><i class='fa fa-edit'></i></button></a>
		@endcan
		@can('viewPDF', $group)
			<a href="{{ url('classes/'.$group->id.'/bilanPDF')}}" ><button class="btn btn-info"><i class='fa fa-file-pdf-o'></i></button></a>
		@endcan
		@can('viewMacAddresses', $group)
			<a href="{{ url('macAddress/'.$group->id)}}" ><button class="btn btn-info"><i class='fa fa-wifi'></i></button></a>
		@endcan
		@can('viewPoll', $group)
			<a href="{{ url('poll/'.$group->id)}}" ><button class="btn btn-info"><i class='fa fa-question'></i></button></a>
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
			@if(isset($group->deadline))
				<p>
					<bold>Date limite : {{ (new Carbon($group->deadline))->formatLocalized('%d/%m/%Y à %H heures') }}</bold>
				</p>
			@endif
			<table id="table" class="table datatable" style="width:100%;">
				<thead>
					<tr>
						<td>Nom</td>
						<td>Prénom</td>
						<td>Email</td>
						<td>Actions</td>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		@can('create', \Auth::User())
			<a href="{{$group->id}}/ajouterEleve">
				<button class="btn btn-warning pull-right">Ajouter un élève</button>
			</a>
			{{Form::open(['action' => ['UserController@OdsImport',$group->id],'files' => true])}}
				<div class="form-group">
					{{Form::file('ods')}}
					{{Form::submit('Ajouter via ODS', ['class' => 'btn btn-primary'])}}
				</div>
			{{Form::close()}}
		@endcan
	</div>

@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script>
	$('#table').DataTable({
		processing: true,
		serverSide: true,
		ajax: {{$group->id}}+'/datatables/users',
		columns: [
			{data: 'last_name', name: 'last_name'},
			{data: 'first_name', name: 'first_name'},
			{data: 'email', name: 'email'},
			{data: 'actions', name: 'actions', orderable: false, searchable: false}
		]
	});
	</script>
@endsection
