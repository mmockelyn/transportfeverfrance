@props(['user'])

@if($user->social->facebook_id != null)
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-facebook text-primary"></i>
    </div>
@else
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-facebook text-default"></i>
    </div>
@endif

@if($user->social->google_id != null)
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-google text-primary"></i>
    </div>
@else
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-google text-default"></i>
    </div>
@endif

@if($user->social->twitter_id != null)
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-twitter text-primary"></i>
    </div>
@else
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-twitter text-default"></i>
    </div>
@endif

@if($user->social->steam_id != null)
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-steam text-primary"></i>
    </div>
@else
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-steam text-default"></i>
    </div>
@endif

@if($user->social->discord_user_id != null)
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-discord text-primary"></i>
    </div>
@else
    <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
        <i class="socicon-discord text-default"></i>
    </div>
@endif
