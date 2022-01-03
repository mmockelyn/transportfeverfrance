@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="Nous contacter"
        description="{{ config('app.name') }} - Nous contactez"
        author="Transport Fever France"
        url="{{ route('contacts.create') }}"
    />
@endsection

@section("content")
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-dark font-weight-bold text-8">Nous contactez</h1>
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center">
                        <li><a href="#">Acceuil</a></li>
                        <li class="active">Nous contactez</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container py-5 mt-3">

        <div class="row py-4">
            <div class="col-lg-6">

                <div class="overflow-hidden mb-1">
                    <h2 class="font-weight-normal text-7 mt-2 mb-0 appear-animation animated maskUp appear-animation-visible" data-appear-animation="maskUp" data-appear-animation-delay="200" style="animation-delay: 200ms;"><strong class="font-weight-extra-bold">Contact</strong> Us</h2>
                </div>
                <div class="overflow-hidden mb-4 pb-3">
                    <p class="mb-0 appear-animation animated maskUp appear-animation-visible" data-appear-animation="maskUp" data-appear-animation-delay="400" style="animation-delay: 400ms;">Feel free to ask for details, don't save any questions!</p>
                </div>
                <x-auth.session-status :status="session('status')" />
                <x-auth.validation-errors :errors="$errors" />

                <form class="contact-form" action="{{ route('contacts.store') }}" method="POST" novalidate="novalidate">
                    @csrf
                    @if(\Illuminate\Support\Facades\Auth::guest())
                        <div class="form-group">
                            <label>Votre nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"  name="name" value="{{ old('name') }}" required autofocus/>
                        </div>
                        <div class="form-group">
                            <label>Votre Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control"  name="email" value="{{ old('email') }}" required autofocus/>
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group col">
                            <label class="required font-weight-bold text-dark text-2">Message</label>
                            <textarea maxlength="5000" data-msg-required="Entrez votre message" rows="8" class="form-control" name="message" required="">{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <x-honey/>
                    <div class="form-row">
                        <div class="form-group col">
                            <input type="submit" value="Envoyer votre message" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-6">

                <h4 class="pt-5">Vous pouvez également nous contacter <strong>par réseaux sociales</strong></h4>
                <a href="https://www.facebook.com/groups/TransportFeverFR" class="mb-1 mt-1 mr-1 btn btn-outline btn-info"><i class="fab fa-facebook-messenger"></i> </a>
                <a href="https://twitter.com/tpf_france" class="mb-1 mt-1 mr-1 btn btn-outline btn-info"><i class="fab fa-twitter"></i> </a>
                <a href="https://discord.transportfeverfrance.fr" class="mb-1 mt-1 mr-1 btn btn-outline btn-info"><i class="fab fa-discord"></i> </a>

            </div>

        </div>

    </div>
@endsection

@section("script")

@endsection
