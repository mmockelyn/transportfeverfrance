@extends("front.layouts.layout")
@section("styles")

@endsection

@section("bread")
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Mes Badges</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Mes Badges</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection

@section("content")
    <!-- Slider -->
    <div class="container-fluid" id="badges" data-id="{{ $user->id }}">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mes Badges</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($badges as $badge)
                    <div class="col-3 text-center mb-8">
                        <div class="symbol symbol-150 symbol-circle">
                            @if($badge->isUnlockedFor($user) == true)
                            <img alt="Pic" src="storage/files/shares/badges/{{ $badge->action }}{{ ($badge->action_count != 0) ? "-".$badge->action_count : null }}.png"/>
                            @else
                                <img alt="Pic" src="storage/files/shares/badges/blank.png"/>
                            @endif
                        </div>
                        <div class="font-size-h4 fw-bold text-center text-muted">{{ $badge->name }}</div>
                        <div class="font-size-h6 text-center text-muted">{{ $badge->description }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script type="text/javascript">
        console.log('    o o o o o o o . . .   ______________________________ _____=======_||____\n' +
            '   o      _____           ||                            | |                 |\n' +
            ' .][__n_n_|DD[  ====_____  |   TRANSPORT FEVER FRANCE   | |/unlock/tffrance |\n' +
            '>(________|__|_[_________]_|____________________________|_|_________________|\n' +
            '_/oo OOOOO oo`  ooo   ooo  \'o!o!o                  o!o!o` \'o!o         o!o`\n' +
            '-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-')
    </script>
@endsection
