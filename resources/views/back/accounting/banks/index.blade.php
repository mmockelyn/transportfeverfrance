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
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Comptabilité
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Liste des mouvements bancaires</small>
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
    <!--begin::Card-->
    <div class="row g-5 g-xl-8">
        <div class="col-xl-9">
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
							<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
						</svg>
					</span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Rechercher" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                            <!--begin::Add subscription-->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_bank">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
								<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
							</svg>
						</span>
                                <!--end::Svg Icon-->Nouveau Mouvement</button>
                            <!--end::Add subscription-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_banks">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Date</th>
                            <th class="min-w-125px">Désignation</th>
                            <th class="min-w-125px">Montant</th>
                            <th class="min-w-125px">Paypal</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                        @foreach($banks as $bank)
                            <tr>
                                <td>{{ $bank->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <strong>{{ $bank->designation }}</strong><br>
                                    @if($bank->reference) <span class="text-muted">Référence: {{ $bank->reference }}</span> @endif
                                </td>
                                <td class="text-end">
                                    {{ \App\Helpers\Format::number_format($bank->amount) }}
                                </td>
                                <td class="text-center">
                                    @if($bank->paypal_id)
                                        <a href="{{ \App\Helpers\Format::urlToPaypalActivity($bank->paypal_id) }}"><i class="fab fa-paypal"></i> {{ $bank->paypal_id }}</a>
                                    @endif
                                </td>
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                        <span class="svg-icon svg-icon-5 m-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
								</svg>
							</span>
                                        <!--end::Svg Icon--></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/subscriptions/add.html" class="menu-link px-3 editBank" data-id="{{ $bank->id }}">Editer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" data-kt-subscriptions-table-filter="delete_row" class="menu-link text-danger px-3 delBank" data-id="{{ $bank->id }}">Supprimer</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                                <!--end::Action=-->
                            </tr>
                        @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="col-xl-3">
            <a href="#" class="card bg-body hoverable mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black"></path>
							<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black"></path>
						</svg>
					</span>
                    <!--end::Svg Icon-->
                    <div class="text-black fw-bolder fs-2 mb-2 mt-5 bankSoldeYear">0,00 €</div>
                    <div class="fw-bold text-black">Total Annuel</div>
                </div>
                <!--end::Body-->
            </a>
            <a href="#" class="card bg-body hoverable mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black"></path>
							<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black"></path>
						</svg>
					</span>
                    <!--end::Svg Icon-->
                    <div class="text-black fw-bolder fs-2 mb-2 mt-5 bankSoldeMonthly">0,00 €</div>
                    <div class="fw-bold text-black">Total Mensuel</div>
                </div>
                <!--end::Body-->
            </a>
            <a href="#" class="card bg-body hoverable mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black"></path>
							<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black"></path>
						</svg>
					</span>
                    <!--end::Svg Icon-->
                    <div class="text-black fw-bolder fs-2 mb-2 mt-5 bankSoldeDay">0,00 €</div>
                    <div class="fw-bold text-black">Total Journaliers</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
    </div>
    <!--end::Card-->
    <div class="modal fade" tabindex="-1" id="add_bank">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau mouvement bancaire</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form id="formAddBank" action="" method="post">
                    <div class="modal-body">
                        <div class="mb-10">
                            <div data-kt-buttons="true">
                                <!--begin::Radio button-->
                                <label class="btn btn-outline btn-outline-dashed d-flex flex-stack text-start p-6 mb-5">
                                    <!--end::Description-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                            <input class="form-check-input" type="radio" name="model_type" value="sale"/>
                                        </div>
                                        <!--end::Radio-->

                                        <!--begin::Info-->
                                        <div class="flex-grow-1">
                                            <h2 class="d-flex align-items-center fs-3 fw-bolder flex-wrap">
                                                Ventes
                                            </h2>
                                            <div class="fw-bold opacity-50">
                                                Enregistrement d'un mouvement d'entrée
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Description-->
                                </label>
                                <!--end::Radio button-->

                                <!--begin::Radio button-->
                                <label class="btn btn-outline btn-outline-dashed d-flex flex-stack text-start p-6 mb-5">
                                    <!--end::Description-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                            <input class="form-check-input" type="radio" name="model_type" value="purchase"/>
                                        </div>
                                        <!--end::Radio-->

                                        <!--begin::Info-->
                                        <div class="flex-grow-1">
                                            <h2 class="d-flex align-items-center fs-3 fw-bolder flex-wrap">
                                                Achat
                                            </h2>
                                            <div class="fw-bold opacity-50">
                                                Enregistrement d'un mouvement de sortie
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Description-->
                                </label>
                                <!--end::Radio button-->
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Date du mouvement</label>
                            <input type="text" class="form-control form-control-solid createdField" name="created_at" required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Désignation</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Example input" name="designation" required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Référence</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Example input" name="reference"/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Numéro de transaction paypal</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon1">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <i class="fab fa-paypal"></i>
                                    <!--end::Svg Icon-->
                                </span>
                                <input type="text" class="form-control form-control-solid" name="paypal_id" />
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Montant</label>
                            <input type="text" class="form-control form-control-solid amountField" name="amount" required/>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                Sauvegarder
                            </span>
                            <span class="indicator-progress">
                                Veuillez Patienter... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="edit_bank">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form id="formEditBank" action="" method="post">
                    <input type="hidden" name="id" class="idField" value="">
                    <div class="modal-body">
                        <div class="mb-10">
                            <div data-kt-buttons="true">
                                <!--begin::Radio button-->
                                <label class="btn btn-outline btn-outline-dashed d-flex flex-stack text-start p-6 mb-5">
                                    <!--end::Description-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                            <input class="form-check-input modelTypeSaleField" type="radio" name="model_type" value="sale"/>
                                        </div>
                                        <!--end::Radio-->

                                        <!--begin::Info-->
                                        <div class="flex-grow-1">
                                            <h2 class="d-flex align-items-center fs-3 fw-bolder flex-wrap">
                                                Ventes
                                            </h2>
                                            <div class="fw-bold opacity-50">
                                                Enregistrement d'un mouvement d'entrée
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Description-->
                                </label>
                                <!--end::Radio button-->

                                <!--begin::Radio button-->
                                <label class="btn btn-outline btn-outline-dashed d-flex flex-stack text-start p-6 mb-5">
                                    <!--end::Description-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                            <input class="form-check-input modelTypePurchaseField" type="radio" name="model_type" value="purchase"/>
                                        </div>
                                        <!--end::Radio-->

                                        <!--begin::Info-->
                                        <div class="flex-grow-1">
                                            <h2 class="d-flex align-items-center fs-3 fw-bolder flex-wrap">
                                                Achat
                                            </h2>
                                            <div class="fw-bold opacity-50">
                                                Enregistrement d'un mouvement de sortie
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Description-->
                                </label>
                                <!--end::Radio button-->
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Date du mouvement</label>
                            <input type="text" class="form-control form-control-solid createdField" name="created_at" required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Désignation</label>
                            <input type="text" class="form-control form-control-solid designationField" placeholder="Example input" name="designation" required/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Référence</label>
                            <input type="text" class="form-control form-control-solid referenceField" placeholder="Example input" name="reference"/>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Numéro de transaction paypal</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon1">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <i class="fab fa-paypal"></i>
                                    <!--end::Svg Icon-->
                                </span>
                                <input type="text" class="form-control form-control-solid paypalField" name="paypal_id" />
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Montant</label>
                            <input type="text" class="form-control form-control-solid amountField" name="amount" required/>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                Sauvegarder
                            </span>
                            <span class="indicator-progress">
                                Veuillez Patienter... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/back/js/accounting/banks/index.js"></script>
@endsection
