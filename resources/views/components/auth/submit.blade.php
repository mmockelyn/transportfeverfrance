@props(['title'])

@if(config('app.social_provider') == false)
    <div class="text-center">
        <!--begin::Submit button-->
        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-block btn-primary fw-bolder me-3 my-2">
            <span class="indicator-label">{{ $title }}</span>
            <span class="indicator-progress">
                Veuillez Patientez...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
        <!--end::Submit button-->
    </div>
@else
    <div class="text-center">
        <!--begin::Submit button-->
        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-block btn-primary fw-bolder me-3 my-2">
            <span class="indicator-label">{{ $title }}</span>
            <span class="indicator-progress">
                Veuillez Patientez...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>

        <a href="{{ route('auth.login.provider', 'discord') }}" class="btn btn-lg btn-block btn-discord fw-bolder me-3 my-2">
            <img alt="Logo" src="storage/files/shares/core/icons/discord_icon.png" class="h-20px me-3">
            Connexion avec Discord
        </a>
        <a href="{{ route('auth.login.provider', 'facebook') }}" class="btn btn-lg btn-block btn-facebook fw-bolder me-3 my-2">
            <img alt="Logo" src="{{ asset('back/assets/media/svg/brand-logos/facebook-4.svg') }}" class="h-20px me-3">
            Connexion avec Facebook
        </a>
        <a href="{{ route('auth.login.provider', 'google') }}" class="btn btn-lg btn-block btn-light-primary fw-bolder me-3 my-2">
            <img alt="Logo" src="{{ asset('back/assets/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3">
            Connexion avec Google
        </a>
        <a href="{{ route('auth.login.provider', 'twitter') }}" class="btn btn-lg btn-block btn-outline-primary fw-bolder me-3 my-2">
            <img alt="Logo" src="{{ asset('back/assets/media/svg/brand-logos/twitter.svg') }}" class="h-20px me-3">
            Connexion avec Twitter
        </a>
        <a href="{{ route('auth.login.provider', 'steam') }}" class="btn btn-lg btn-block btn-primary fw-bolder me-3 my-2">
            <img alt="Logo" src="storage/files/shares/core/icons/steam_icon.png" class="h-20px me-3">
            Connexion avec Steam
        </a>
        <!--end::Submit button-->
    </div>
@endif
