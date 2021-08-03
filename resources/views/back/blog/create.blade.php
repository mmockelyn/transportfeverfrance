@extends("back.layouts.layout")

@section("style")

@endsection

@section("bread")
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend"
                 data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Administration du blog
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Création d'un article</small>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="container-fluid">
        <div class="card shadow-sm">
            <form action="{{ route('back.blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">Nouvelle Article de blog</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="" class="form-label"><span class="required">Titre de l'article</span> </label>
                        <input type="text" class="form-control" name="title" required/>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label"><span class="required">Catégorie</span> </label>
                        <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Selectionner une ou plusieurs catégories" data-allow-clear="true"
                                multiple="true">
                            <option></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            <span>Tags</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Veuillez spécifier une liste de tags (Touche tabulation pour ajouter)" aria-label="Specify your unique app name"></i>
                        </label>
                        <input class="form-control" name="meta_keywords" id="meta_keywords"/>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label"><span class="required">Courte description</span> </label>
                        <textarea name="short_content" id="short_content" class="form-control" cols="30" rows="3"
                                  required></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label"><span class="required">Description</span> </label>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="3"
                                  required></textarea>
                    </div>
                    <div class="mb-2 mt-5">
                        <div class="image-input image-input-empty" data-kt-image-input="true"
                             style="background-image: url(/back/assets/media/avatars/blank.png)">
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px"></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label
                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Changer l'image de présentation">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <!--begin::Inputs-->
                                <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                <input type="hidden" name="avatar_remove"/>
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="cancel"
                                  data-bs-toggle="tooltip"
                                  data-bs-dismiss="click"
                                  title="Cancel avatar">
                                 <i class="bi bi-x fs-2"></i>
                             </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                  data-kt-image-input-action="remove"
                                  data-bs-toggle="tooltip"
                                  data-bs-dismiss="click"
                                  title="Remove avatar">
                                 <i class="bi bi-x fs-2"></i>
                             </span>
                            <!--end::Remove button-->
                        </div>
                        <!--end::Image input-->
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="/back/js/blog/create.js"></script>
@endsection
