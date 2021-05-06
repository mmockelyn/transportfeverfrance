@if(auth()->check() && auth()->user()->email_verified_at == null)
    <div class="alert alert-custom alert-notice alert-light-primary fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-envelope"></i>
        </div>
        <div class="alert-text">Veuillez activer votre compte, une email vous à été envoyer à <b>{{ auth()->user()->email }}</b> ou <a href="/email/verify">cliquer ici</a></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">
					<i class="ki ki-close"></i>
				</span>
            </button>
        </div>
    </div>
@endif
