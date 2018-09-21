@can('viewPDF', $user)
  <a href= {{ url($prefix."/bilanPDF/".$user->id) }}>
    <button class='btn btn-info actionButton'>
      <i class='fa fa-file-pdf-o'></i>
    </button>
  </a>
@endcan
