@extends('layouts.app')
@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<style>
    td{
        min-width:150px;
    }
</style>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Liste des utilisateurs</div>
        <div class="panel-body">
        	<table id="table" class="table datatable">
        		<thead>
        			<tr>
                      <td>Nom</td>
                      <td>Prénom</td>
                      <td>Email</td>
                      <td>Groupe</td>
                      <td>Année</td>
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
       $('#table').DataTable({
        processing: true,
        ajax: 'users/datatables/all',
        serverSide: true,
        columns: [
            {data: 'last_name', name: 'last_name'},
            {data: 'first_name', name: 'first_name'},
            {data: 'email', name: 'email'},
            {data: 'group', name: 'group'},
            {data: 'year', name: 'year'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ],
    });
    </script>
@endsection