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
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Administration du blog
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1"><strong>Article: </strong>{{ $blog->title }}</small>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <div class="d-flex align-items-center py-1">
                <div class="mr-2 me-4">
                    <strong>Etat: </strong> {!! \App\Helpers\Format::AdminStateBlog($blog->active) !!}
                </div>
                <!--begin::Button-->
                @if($blog->active == 0)
                    <button class="publish btn btn-sm btn-success" data-provider="blog" data-provider-id="{{ $blog->id }}">Publier l'article</button>
                @else
                    <button class="unpublish btn btn-sm btn-danger" data-provider="blog" data-provider-id="{{ $blog->id }}">Dépublier l'article</button>
                @endif
                <!--end::Button-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card shadow-sm">
                @if($blog->image != null)
                    <img src="/storage/files/shares/blog/{{ $blog->image }}" alt="" class="card-img-top">
                @else
                    <img src="/storage/files/shares/blog/img01.jpg" alt="" class="card-img-top">
                @endif
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('back.blog.show', $blog->id) }}" class="list-group-item list-group-item-action active" aria-current="true">Vue Général</a>
                        <a href="{{ route('back.blog.edit', $blog->id) }}" class="list-group-item list-group-item-action">Edition</a>
                        <a href="{{ route('back.blog.comments', $blog->id) }}" class="list-group-item list-group-item-action">Commentaires</a>
                        <a href="{{ route('front.blog.show', $blog->slug) }}" class="list-group-item list-group-item-action">Aperçu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                            <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M12.8434797,16 L11.1565203,16 L10.9852159,16.6393167 C10.3352654,19.064965 7.84199997,20.5044524 5.41635172,19.8545019 C2.99070348,19.2045514 1.55121603,16.711286 2.20116652,14.2856378 L3.92086709,7.86762789 C4.57081758,5.44197964 7.06408298,4.00249219 9.48973122,4.65244268 C10.5421727,4.93444352 11.4089671,5.56345262 12,6.38338695 C12.5910329,5.56345262 13.4578273,4.93444352 14.5102688,4.65244268 C16.935917,4.00249219 19.4291824,5.44197964 20.0791329,7.86762789 L21.7988335,14.2856378 C22.448784,16.711286 21.0092965,19.2045514 18.5836483,19.8545019 C16.158,20.5044524 13.6647346,19.064965 13.0147841,16.6393167 L12.8434797,16 Z M17.4563502,18.1051865 C18.9630797,18.1051865 20.1845253,16.8377967 20.1845253,15.2743923 C20.1845253,13.7109878 18.9630797,12.4435981 17.4563502,12.4435981 C15.9496207,12.4435981 14.7281751,13.7109878 14.7281751,15.2743923 C14.7281751,16.8377967 15.9496207,18.1051865 17.4563502,18.1051865 Z M6.54364977,18.1051865 C8.05037928,18.1051865 9.27182488,16.8377967 9.27182488,15.2743923 C9.27182488,13.7109878 8.05037928,12.4435981 6.54364977,12.4435981 C5.03692026,12.4435981 3.81547465,13.7109878 3.81547465,15.2743923 C3.81547465,16.8377967 5.03692026,18.1051865 6.54364977,18.1051865 Z" fill="#000000"/>
                                </g>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                            <div class="text-inverse-body fw-bolder fs-2 mb-2 mt-5">{{ $blog->vue }}</div>
                            <div class="fw-bold text-inverse-body fs-7">Nombre de vue</div>
                        </div>
                        <!--end::Body-->
                    </a>
                </div>
                <div class="col-xl-6">
                    <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                            <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd" d="M5.69477 2.48932C4.00472 2.74648 2.66565 3.98488 2.37546 5.66957C2.17321 6.84372 2 8.33525 2 10C2 11.6647 2.17321 13.1563 2.37546 14.3304C2.62456 15.7766 3.64656 16.8939 5 17.344V20.7476C5 21.5219 5.84211 22.0024 6.50873 21.6085L12.6241 17.9949C14.8384 17.9586 16.8238 17.7361 18.3052 17.5107C19.9953 17.2535 21.3344 16.0151 21.6245 14.3304C21.8268 13.1563 22 11.6647 22 10C22 8.33525 21.8268 6.84372 21.6245 5.66957C21.3344 3.98488 19.9953 2.74648 18.3052 2.48932C16.6859 2.24293 14.4644 2 12 2C9.53559 2 7.31411 2.24293 5.69477 2.48932Z" fill="#191213"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7 7C6.44772 7 6 7.44772 6 8C6 8.55228 6.44772 9 7 9H17C17.5523 9 18 8.55228 18 8C18 7.44772 17.5523 7 17 7H7ZM7 11C6.44772 11 6 11.4477 6 12C6 12.5523 6.44772 13 7 13H11C11.5523 13 12 12.5523 12 12C12 11.4477 11.5523 11 11 11H7Z" fill="#121319"/>
                            </svg>
						</span>
                            <!--end::Svg Icon-->
                            <div class="text-inverse-body fw-bolder fs-2 mb-2 mt-5">{{ $blog->comments()->count() }}</div>
                            <div class="fw-bold text-inverse-body fs-7">Nombre de Commentaire</div>
                        </div>
                        <!--end::Body-->
                    </a>
                </div>
            </div>
            <div class="card shadow-sm mb-8">
                <div class="card-header">
                    <h3 class="card-title">Derniers Commentaires</h3>
                </div>
                <div class="card-body">
                    <table class="table gs-7 gy-7 gx-7 table-striped table-rounded border">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th>Utilisateurs</th>
                                <th>Contenue</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($blog->comments()->count() == 0)
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Aucun commentaire disponible actuellement !
                                    </td>
                                </tr>
                            @else
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->user->name }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card shadow-sm mb-8">
                <div class="card-header">
                    <h3 class="card-title">Statistique des vues</h3>
                </div>
                <div class="card-body">
                    <div id="chart_view" style="height: 300px;"></div>
                </div>
            </div>
            <div class="card shadow-sm mb-8">
                <div class="card-header">
                    <h3 class="card-title">Statistique des Commentaires</h3>
                </div>
                <div class="card-body">
                    <div id="chart_comments" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
    <script src="/back/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/back/js/blog/show.js"></script>
@endsection
