@foreach($activity->category as $category)
    @if(isset($category->course_id))
      {{$category->course->name}}
    @else
      Indifférencié
    @endif
  <br/>
@endforeach
