@extends("front.layouts.layout")
@section("styles")

@endsection

@section("bread")
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $download->title }}</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <h5 class="text-dark font-style-italic mt-2 mb-2 mr-5">{{ $download->category->title }} - {{ $download->subcategory->title }}</h5>
            </div>
            <!--end::Details-->
        </div>
    </div>
@endsection

@section("content")
    <!-- Slider -->
    <div class="container-fluid" id="package_show" data-id="{{ auth()->user()->id }}" data-package="{{ $download->id }}">
        <div class="row">
            <div class="col-3">
                <div class="card card-custom">
                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('files/shares/download/'.$download->image) == true)
                        <img src="/storage/files/shares/download/{{ $download->image }}" alt="" class="card-img-top">
                    @else
                        <img src="https://via.placeholder.com/900" alt="" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Provider</td>
                                    <td class="text-right">
                                        {!! \App\Helpers\Format::symbolDownloadProvider($download->provider) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Etat</td>
                                    <td class="text-right">
                                        @if($download->active == 0)
                                            <span class="label label-inline label-danger">Non publier</span>
                                        @else
                                            <span class="label label-inline label-success">Publier</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nombre de Vue</td>
                                    <td class="text-right">
                                        {{ $download->count_view }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nombre de téléchargement</td>
                                    <td class="text-right">
                                        {{ $download->count_download }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card card-custom">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#general">
                                        <span class="nav-text">Général</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#feature">
                                        <span class="nav-text">Caractéristique</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#user">
                                        <span class="nav-text">Auteurs</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#comments">
                                        <span class="nav-text">Commentaires</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#version">
                                        <span class="nav-text">Versions & Packages</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#wiki">
                                        <span class="nav-text">Documentation</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#supports">
                                        <span class="nav-text">Supports</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                                <div class="h2 font-weight-bold mb-10">Images du mod</div>
                                <form action="{{ route('account.packages.update_image', $download->id) }}" method="post" class="mb-10" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <div class="image-input image-input-empty image-input-outline mb-10" id="image_package" style="background-image: @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('files/shares/download/'.$download->image) == true) url({{ asset('storage/files/shares/download/'.$download->image) }}) @else url({{ asset('front/assets/media/users/blank.png') }}) @endif">
                                        <div class="image-input-wrapper"></div>

                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Changer l'image">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                            <input type="hidden" name="profile_avatar_remove"/>
                                        </label>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Annuler">
                                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                                         </span>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Supprimer">
                                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                                         </span>
                                    </div>

                                    <div class="text-left">
                                        <button type="submit" class="btn btn-primary">Changer l'image du mod</button>
                                    </div>
                                </form>
                                <div class="separator separator-solid separator-border-2 mb-5"></div>
                                <div class="h2 font-weight-bold mb-10">Edition des informations du mod</div>
                                <form action="{{ route('account.packages.update_info', $download->id) }}" class="mb-10" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label>Titre du mod</label>
                                        <input type="text" class="form-control" name="title" value="{{ $download->title }}"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Tags</label>
                                        <input type="text" class="form-control tagify" name="meta_keywords" value="{{ $download->meta_keywords }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Courte description</label>
                                        <textarea name="short_content" id="short_content" class="form-control" maxlength="255" rows="5">{{ $download->short_content }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description" class="form-control summernote" rows="10">{!! $download->content !!}</textarea>
                                    </div>

                                    <div class="text-left">
                                        <button type="submit" class="btn btn-primary">Mettre à jours</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                                ...
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('front/js/account/package/show.js') }}"
@endsection
