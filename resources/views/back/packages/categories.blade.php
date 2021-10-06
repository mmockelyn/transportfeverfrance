@extends("back.layouts.layout")

@section("style")
    <link href="/back/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
@endsection

@section("bread")
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend" data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Administration des packages
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Gestion des catégories</small>
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
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-stack mb-5">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-primary ml-3" data-bs-toggle="tooltip" title="Coming Soon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"/>
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"/>
                            </svg>
                        </span>
                        Nouvelle catégorie
                    </button>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_subcategory">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"/>
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"/>
                            </svg>
                        </span>
                        Nouvelle sous catégorie
                    </button>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Datatable-->
            <table id="liste_categories" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>#</th>
                    <th>Titre</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-icon btn-primary listSubCategory" data-bs-toggle="modal" data-bs-target="#list_sub_categories" data-category-id="{{ $category->id }}"><i class="fa fa-eye" data-bs-toggle="tooltip" title="Voir les sous catégories"></i> </button>
                        <button class="btn btn-sm btn-icon btn-info editCategory" data-bs-toggle="modal" data-bs-target="#editCategory" data-category-id="{{ $category->id }}"><i class="fa fa-edit" data-bs-toggle="tooltip" title="Editer la catégorie"></i> </button>
                        <button class="btn btn-sm btn-icon btn-danger deleteCategory" data-category-id="{{ $category->id }}"><i class="fa fa-trash" data-bs-toggle="tooltip" title="Supprimer la catégorie"></i> </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal bg-white fade" tabindex="-1" id="list_sub_categories">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
							</svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="editCategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
							</svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" data-bs-action="submit">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="new_subcategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvelle sous-catégorie</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
							</svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.packages.category.sub.create') }}" method="post">
                    <div class="modal-body">
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Catégorie</label>
                            <select class="form-select" data-control="select2" name="download_category_id" data-placeholder="Séléctionner une catégorie">
                                <option></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Nom de la sous-catégorie</label>
                            <input type="text" class="form-control form-control-solid" name="title"/>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" data-bs-action="submit">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/back/js/packages/categories.js"></script>
@endsection
