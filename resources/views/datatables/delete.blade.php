<form method="post" action= {{ url($prefix.'/'.$name.'/'.$id) }} class="deleteBtn">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn btn-danger actionButton"><i class="fa fa-trash"></i></button>
</form>
