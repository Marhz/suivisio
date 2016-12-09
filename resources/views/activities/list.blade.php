@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

@endsection

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Liste des categories</div>
                <div class="panel-body">
                	<a href="categories/create"><button class="btn btn-primary pull-right">Ajouter une categorie</button></a>
                	<table id="table" class="table datatable">
                		<thead>
                			<tr>
                				<td>Nom</td>
                				<td>Libellé</td>
                				<td>Parcours</td>
                				<td>Actions</td>
                			</tr>
                		</thead>
{{--                 		<tbody>
	                    	@foreach($activities as $activity)
	                    		<tr>
									<td>{{$activity->nomenclature}}</td>
									<td>{{$activity->label}}</td>
									<td class="min-width-100">
                                        @foreach ($activity->category as $category)
                                            {{$category->nomenclature}}
                                            {{isset($category->course_id) ? $category->course->name : null}}<br/>
                                        @endforeach                           
                                    </td>
									<td class="min-width-150"><a href="categories/{{$activity->id}}">
										<button class="btn btn-primary actionButton"><i class="fa fa-eye"></i></button>
									</a>
									<a href="categories/{{$activity->id}}/edit">
										<button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button>
									</a>
									{{Form::open(['method' => 'delete', 
                                                'url' => 'categories/'.$activity->id, 
                                                'class' => 'deleteBtn'])}}
										<button type="submit" class="btn btn-danger actionButton">
                                            <i class="fa fa-trash"></i>
                                        </button>
									{{Form::close()}}
									</td>
								</tr>
	                 		@endforeach
                 		</tbody>
 --}}                 	</table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'activites/datatables',
        columns: [
            {data: 'nomenclature', name: 'nomenclature'},
            {data: 'label', name: 'label'},
            {data: 'Parcours', name: 'category_id'},
            {data: 'Actions', name: 'Actions', orderable: false, searchable: false}
        ]
    });
    </script>
@endsection