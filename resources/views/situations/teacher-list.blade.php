@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

@endsection

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Liste des situations</div>
        <div class="panel-body">
        	<a href="situation/create"><button class="btn btn-primary pull-right">Ajouter une situation</button></a>
        	<table id='table' class="table table-striped">
        		<thead>
        			<tr>
        				<td>Libéllé</td>
        				<td>Elève</td>
        				<td>Classe</td>
                        <td>Vu</td>
                        <td>Modification</td>
                        <td>Actions</td>
        			</tr>
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
        var table = $('#table').DataTable({
        processing: true,
        ajax: 'situations/datatables',
        columns: [
            {data: 'name', name: 'activity.name'},
            {data: 'user.name', name: 'user.name'},
            {data: 'group', name: 'group'},
            {data: 'viewed', name: 'viewed'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'Actions', name: 'Actions', orderable: false, searchable: false},
        ],
        "order": [[ 3, 'asc' ], [ 4, 'desc' ]]
    });
    </script>
@stop