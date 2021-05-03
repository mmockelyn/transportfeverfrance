@extends("front.layouts.layout")
@section("styles")

@endsection

@section("bread")
@endsection

@section("content")
    <!-- Slider -->
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-8">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Nous Contactez</h3>
                    </div>
                    <div class="card-body">
                        <x-auth.session-status :status="session('status')" />
                        <x-auth.validation-errors :errors="$errors" />

                        <form action="{{ route('contacts.store') }}" method="post">
                            @csrf
                            <fieldset>
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

                                    <div class="form-group mb-1">
                                        <label for="message">Votre message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="message" rows="3" name="message" required>{{ old('message') }}</textarea>
                                    </div>
                                    <x-honey/>
                                    <button type="submit" class="btn btn-primary"> Envoyer</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")

@endsection
