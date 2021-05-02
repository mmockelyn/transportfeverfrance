@props(['status'])

@if($status)
    <div class="alert alert-custom alert-outline-danger fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="fa fa-info"></i>
        </div>
        <div class="alert-text">
            <div class="fw-bolder">Oups ! Quelque chose a mal tourné.</div>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">
					<i class="ki ki-close"></i>
				</span>
            </button>
        </div>
    </div>
@endif
