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
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Tableau de Bord</small>
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
<div class="row g-5 g-xl-8">
    <div class="col-xl-4">
        <div class="card card-xl-stretch mb-xl-8 cardIncoming">
            <!--begin::Body-->
            <div class="card-body p-0">
                <div class="d-flex flex-stack card-p flex-grow-1">
					<span class="symbol symbol-50px me-2">
						<span class="symbol-label bg-light-success">
							<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
							<span class="svg-icon svg-icon-2x svg-icon-success">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="black"/>
                                <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="black"/>
                                </svg>
							</span>
                            <!--end::Svg Icon-->
						</span>
					</span>
                    <div class="d-flex flex-column text-end">
                        <span class="text-dark fw-bolder fs-2 sumIncoming">0,00 €</span>
                        <span class="text-muted fw-bold mt-1">Total des ventes & Dons</span>
                    </div>
                </div>
                <div class="stat-incoming card-rounded-bottom" data-kt-chart-color="success" style="height: 150px"></div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card card-xl-stretch mb-xl-8 cardOutgoing">
            <!--begin::Body-->
            <div class="card-body p-0">
                <div class="d-flex flex-stack card-p flex-grow-1">
					<span class="symbol symbol-50px me-2">
						<span class="symbol-label bg-light-danger">
							<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
							<span class="svg-icon svg-icon-2x svg-icon-danger">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"/>
                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black"/>
                                </svg>
							</span>
                            <!--end::Svg Icon-->
						</span>
					</span>
                    <div class="d-flex flex-column text-end">
                        <span class="text-dark fw-bolder fs-2 sumOutgoing">0,00 €</span>
                        <span class="text-muted fw-bold mt-1">Total des Achats</span>
                    </div>
                </div>
                <div class="stat-outgoing card-rounded-bottom" data-kt-chart-color="danger" style="height: 150px"></div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <div class="col-xl-4">
        <a href="#" class="card hoverable card-xl-stretch mb-xl-8 card-balance">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"></rect>
						<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"></rect>
						<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"></rect>
						<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"></rect>
					</svg>
				</span>
                <!--end::Svg Icon-->
                <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5 balanceText"></div>
                <div class="fw-bold text-gray-400">Balance Actuel</div>
            </div>
            <!--end::Body-->
        </a>
    </div>
</div>

    <div class="row g5 g-xl-8">
        <div class="col-xl-4">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Dernieres Ventes & Dons</span>
                        <span class="text-muted mt-1 fw-bold fs-7">5 Derniers uniquement</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-5">
                            <!--begin::Table head-->
                            <thead>
                            <tr>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-40px"></th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $sale->designation }}</a>
                                        @if($sale->reference) <span class="text-muted fw-bold d-block fs-7">Référence: {{ $sale->reference }}</span> @endif
                                    </td>
                                    <td class="text-end">
                                        {{ \App\Helpers\Format::number_format($sale->amount) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Derniers Achats</span>
                        <span class="text-muted mt-1 fw-bold fs-7">5 Derniers uniquement</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-5">
                            <!--begin::Table head-->
                            <thead>
                            <tr>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-40px"></th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $purchase->designation }}</a>
                                        @if($purchase->reference) <span class="text-muted fw-bold d-block fs-7">Référence: {{ $purchase->reference }}</span> @endif
                                    </td>
                                    <td class="text-end">
                                        {{ \App\Helpers\Format::number_format($purchase->amount) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Derniers Mouvement Bancaire</span>
                        <span class="text-muted mt-1 fw-bold fs-7">5 Derniers uniquement (Paypal)</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-5">
                            <!--begin::Table head-->
                            <thead>
                            <tr>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-40px"></th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach($banks as $bank)
                                <tr>
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $bank->designation }}</a>
                                        @if($bank->reference) <span class="text-muted fw-bold d-block fs-7">Référence: {{ $bank->reference }}</span> @endif
                                    </td>
                                    <td class="text-end">
                                        {!! \App\Helpers\Format::number_format($bank->amount, true, true) !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/back/js/accounting/dashboard.js"></script>
@endsection
