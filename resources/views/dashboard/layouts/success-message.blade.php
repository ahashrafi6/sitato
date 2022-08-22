@if($message = \Illuminate\Support\Facades\Session::get('success'))
    <div class="alert alert-success alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="بستن">
            <span aria-hidden="true">×</span>
        </button>
        <div class="d-flex align-items-center">
            <i class="bx bx-like"></i>
            <span>{{ $message }}</span>
        </div>
    </div>
@endif
