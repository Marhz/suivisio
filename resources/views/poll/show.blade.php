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
		<div class="panel-heading"><h3>Choix d'orientation pour le groupe {{ $group->name }}
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
			@if($group->poll_deadline != null)
			  Verrouillage le
			          {{ (new Carbon($group->poll_deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
			          ({{ (new Carbon($group->poll_deadline))->diffForHumans()}})
			  <hr>
			@endif
			<table id="table" class="table datatable" style="width:100%;">
				<thead>
					<tr>
						<td>Utilisateur</td>
						<td>Choix</td>
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
		ajax: '../poll/'+{{$group->id}}+'/datatables',
		columns: [
			{data: 'first_name', name: 'first_name'},
			{data: 'Voeux', name: 'Voeux'},
		]
	});
	</script>
@endsection
