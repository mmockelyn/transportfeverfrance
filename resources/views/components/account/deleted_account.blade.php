@props(['user'])

@if($user->deleted_at !== null)
    <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-cross"></i></div>
        <div class="alert-text">
            <div class="row">
                <div class="col-11">Votre compte sera supprimer <strong>{{ $user->deleted_at->diffForHumans() }}</strong></div>
            </div>
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif
