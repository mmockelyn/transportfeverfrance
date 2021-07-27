@extends("back.layouts.layout")

@section("style")
    <link href="/back/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endsection

@section("bread")
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-place="true" data-kt-place-mode="prepend" data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Administration
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Tâches Communes</small>
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
    <div class="d-flex flex-wrap flex-stack pt-10 pb-8">
        <!--begin::Heading-->
        <h3 class="fw-bolder my-2">Tâches Communes
            <span class="fs-6 text-gray-400 fw-bold ms-1">trier du plus récent ↓</span></h3>
        <!--end::Heading-->
        <!--begin::Controls-->
        <div class="d-flex flex-wrap my-1">
            <!--begin::Tab nav-->
            <ul class="nav nav-pills me-5">
                <li class="nav-item m-0">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary active me-3" data-bs-toggle="tab" href="#kt_project_targets_card_pane">
                        <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks-2.svg-->
                        <span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
									<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
									<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
									<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
								</g>
							</svg>
						</span>
                        <!--end::Svg Icon-->
                    </a>
                </li>
                <li class="nav-item m-0">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary" data-bs-toggle="tab" href="#kt_project_targets_table_pane">
                        <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-horizontal.svg-->
                        <span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<rect fill="#000000" opacity="0.3" x="4" y="5" width="16" height="6" rx="1.5" />
									<rect fill="#000000" x="4" y="13" width="16" height="6" rx="1.5" />
								</g>
							</svg>
						</span>
                        <!--end::Svg Icon-->
                    </a>
                </li>
                <li class="nav-item m-0">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary" data-bs-toggle="modal" href="#kt_modal_new_target">
                        <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-horizontal.svg-->
                        <span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.5" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                            </svg>
						</span>
                        <!--end::Svg Icon-->
                    </a>
                </li>
            </ul>
            <!--end::Tab nav-->
        </div>
        <!--end::Controls-->
    </div>
    <div class="tab-content">
        <!--begin::Tab pane-->
        <div id="kt_project_targets_card_pane" class="tab-pane fade show active">
            <!--begin::Row-->
            <div class="row g-9">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <!--begin::Col header-->
                    <div class="mb-9">
                        <div class="d-flex flex-stack">
                            <div class="fw-bolder fs-4">A Faire
                                <span class="fs-6 text-gray-400 ms-2" id="count_task_pending"></span></div>
                        </div>
                        <div class="h-3px w-100 bg-danger"></div>
                    </div>
                    <!--end::Col header-->
                    <!--begin::Card-->
                    <div id="content_task_card_pending"></div>
                    <a href="#" class="btn btn-primary er w-100 fs-6 px-8 py-4" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Créer une nouvelle tâche</a>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <!--begin::Col header-->
                    <div class="mb-9">
                        <div class="d-flex flex-stack">
                            <div class="fw-bolder fs-4">Terminer
                                <span class="fs-6 text-gray-400 ms-2" id="count_task_complete"></span>
                            </div>
                        </div>
                        <div class="h-3px w-100 bg-success"></div>
                    </div>
                    <!--end::Col header-->
                    <!--begin::Card-->
                    <div id="content_task_card_complete"></div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Tab pane-->
        <!--begin::Tab pane-->
        <div id="kt_project_targets_table_pane" class="tab-pane fade">
            <div class="card card-flush">
                <div class="card-body pt-3">
                    <!--begin::Table-->
                    <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
                        <!--begin::Table head-->
                        <thead class="fs-7 text-gray-400 text-uppercase">
                        <tr>
                            <th class="min-w-250px">Tache</th>
                            <th class="min-w-90px">Categorie</th>
                            <th class="min-w-90px">Auteur</th>
                            <th class="min-w-90px">Status</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fs-6">
                        <!--begin::Table row-->
                        @foreach($tasks as $task)
                        <tr>
                            <td class="fw-bolder">
                                <a href="#" class="text-gray-900 text-hover-primary">{{ $task->task }}</a>
                            </td>
                            <td>
                                <span class="badge badge-light fw-bold me-auto">{{ $task->category }}</span>
                            </td>
                            <td>
                                <!--begin::Members-->
                                <div class="symbol-group symbol-hover fs-8">
                                    <div class="symbol symbol-25px symbol-circle" data-bs-toggle="tooltip" title="{{ $task->user->name }}">
                                        <div class="symbol-label fs-2 fw-bold text-success">{{ \Illuminate\Support\Str::limit($task->user->name, 1, '') }}</div>
                                    </div>
                                </div>
                                <!--end::Members-->
                            </td>
                            <td>
                                @if($task->check == 0)
                                    <span class="badge badge-light-danger fw-bolder me-auto">A Faire</span>
                                @else
                                    <span class="badge badge-light-success fw-bolder me-auto">Terminer</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <!--end::Table row-->
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
        </div>
        <!--end::Tab pane-->
    </div>
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-1">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
									<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
									<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
								</g>
							</svg>
						</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" action="#">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Création d'une tâche</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Nom de la tache</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Spécifier le nom de la tâche qui sera à faire"></i>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Entrez le nom de la tâche" name="task" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">Assigné A</label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selectionner un administrateur" name="user_id">
                                    <option value="">Select user...</option>
                                    @foreach(\App\Models\User::where('group', 1)->get() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Catégorie de la tâche</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Spécifier une catégorie de tache"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" placeholder="Entrez le nom de la catégorie de la tâche" name="category" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">Description de la tâche</span>
                            </label>
                            <textarea class="form-control form-control-solid" rows="3" name="description" placeholder="Entrez une description de la tâche à effectuer"></textarea>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Annuler</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Soumettre</span>
                                <span class="indicator-progress">
                                    Veuillez Patienter...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/back/js/task/index.js"></script>
@endsection
