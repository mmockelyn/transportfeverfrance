@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="Coming soon"
        description="TPFF - Coming soon"
        author="Transport Fever France"
        url="{{ route('home') }}"
    />
@endsection

@section("content")
    <div class="row mt-5">
        <div class="col text-center">
            <div class="logo">
                <a href="index.html">
                    <img width="100" height="48" src="/storage/files/shares/core/logo_couleur.png" alt="TPFF">
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr class="solid my-5">
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <h2 class="font-weight-normal text-7 mb-2"><strong class="font-weight-extra-bold">Le site est actuellement en construction</strong></h2>
            <p class="mb-0 lead">Le site TPFF est actuellement en phase de construction et devrait ouvrir ses portes prochainement.</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr class="solid my-5">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row process my-5">
                <div class="process-step col-lg-4 mb-5 mb-lg-4 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200" style="animation-delay: 200ms;">
                    <div class="process-step-circle">
                        <strong class="process-step-circle-content">1</strong>
                    </div>
                    <div class="process-step-content">
                        <h4 class="mb-1 text-5 font-weight-bold">Développement</h4>
                        <p class="mb-0">Phase de création du site internet de TPFF</p>
                    </div>
                </div>
                <div class="process-step col-lg-4 mb-5 mb-lg-4 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="animation-delay: 400ms;">
                    <div class="process-step-circle">
                        <strong class="process-step-circle-content">2</strong>
                    </div>
                    <div class="process-step-content">
                        <h4 class="mb-1 text-5 font-weight-bold">Phase Béta</h4>
                        <p class="mb-0">Le site est créer et l'équipe fais actuellement des tests avant mise en production</p>
                    </div>
                </div>
                <div class="process-step col-lg-4 mb-5 mb-lg-4 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600" style="animation-delay: 600ms;">
                    <div class="process-step-circle">
                        <strong class="process-step-circle-content">3</strong>
                    </div>
                    <div class="process-step-content">
                        <h4 class="mb-1 text-5 font-weight-bold">OK</h4>
                        <p class="mb-0">Le site et les outils associés sont publier et disponible.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")

@endsection
