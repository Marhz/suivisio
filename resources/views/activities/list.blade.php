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
    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Liste des activités</div>
        <div class="panel-body">
        	<a href="activites/create"><button class="btn btn-primary pull-right">Ajouter une activité</button></a>
        	<table id="table" class="table table-stripped">
        		<thead>
        			<tr>
        				<td>Nom</td>
        				<td>Libellé</td>
        				<td>Categorie</td>
                        <td>Parcours</td>
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
        ajax: 'activites/datatables',
        columns: [
            {data: 'nomenclature', name: 'activities.nomenclature'},
            {data: 'label', name: 'activities.label'},
            {data: 'category.nomenclature', name: 'category.nomenclature'},
            {data: 'category.course_id', name: 'category.course_id'},
            {data: 'Actions', name: 'Actions', orderable: false, searchable: false},

        ],
    });
    </script>
@endsection