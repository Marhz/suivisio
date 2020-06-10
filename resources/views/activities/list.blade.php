@extends('layouts.app')

@section('content')
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