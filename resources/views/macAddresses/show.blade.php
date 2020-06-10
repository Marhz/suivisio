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
		<div class="panel-heading"><h3>Adresses MAC pour le groupe {{ $group->name }}
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
			@if($group->mac_address_deadline != null)
			  Verrouillage le
			          {{ (new Carbon($group->mac_address_deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
			          ({{ (new Carbon($group->mac_address_deadline))->diffForHumans()}})
			  <hr>
			@endif
			<table id="table" class="table datatable" style="width:100%;">
				<thead>
					<tr>
						<td>Utilisateur</td>
						<td>Adresse MAC</td>
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
		ajax: '../macAddress/'+{{$group->id}}+'/datatables',
		columns: [
			{data: 'Utilisateur', name: 'Utilisateur'},
			{data: 'address', name: 'Adresse Mac'},
		]
	});
	</script>
@endsection
