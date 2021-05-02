@extends("front.layouts.layout")
@section("styles")

@endsection

@section("bread")
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ $blog->title }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Accueil</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Blog</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">{{ $blog->title }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection

@section("content")
    <!-- Slider -->
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="d-flex flex-wrap mb-6">
                            <div class="mr-9 my-1">
                                <span class="svg-icon svg-icon-primary svg-icon-2 me-1" data-toogle="tooltip" data-theme="dark" title="Horodatage">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
											<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
										</g>
									</svg>
								</span>
                                <span class="fw-bolder text-gray-400">{{ formatDateHour($blog->updated_at) }}</span>
                            </div>
                            <div class="mr-9 my-1">
                                <span class="svg-icon svg-icon-primary svg-icon-2 me-1" data-toogle="tooltip" data-theme="dark" title="Catégories">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.25" d="M13 6L12.4104 5.01732C11.8306 4.05094 10.8702 3.36835 9.75227 3.22585C8.83875 3.10939 7.66937 3 6.5 3C5.68392 3 4.86784 3.05328 4.13873 3.12505C2.53169 3.28325 1.31947 4.53621 1.19597 6.14628C1.09136 7.51009 1 9.43529 1 12C1 13.8205 1.06629 15.4422 1.15059 16.7685C1.29156 18.9862 3.01613 20.6935 5.23467 20.8214C6.91963 20.9185 9.17474 21 12 21C14.8253 21 17.0804 20.9185 18.7653 20.8214C20.9839 20.6935 22.7084 18.9862 22.8494 16.7685C22.9337 15.4422 23 13.8205 23 12C23 10.9589 22.9398 9.97795 22.8611 9.14085C22.7101 7.53313 21.4669 6.2899 19.8591 6.13886C19.0221 6.06022 18.0411 6 17 6H13Z" fill="#12131A"></path>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M13 6H1.21033C1.39381 4.46081 2.58074 3.27842 4.13877 3.12505C4.86788 3.05328 5.68396 3 6.50004 3C7.66941 3 8.83879 3.10939 9.75231 3.22585C10.8702 3.36835 11.8306 4.05094 12.4104 5.01732L13 6Z" fill="#12131A"></path>
									</svg>
								</span>
                                @foreach($blog->categories as $category)
                                    <span class="label label-primary label-inline font-weight-lighter mr-2">{{ $category->title }}</span>
                                @endforeach
                            </div>
                            <div class="mr-9 my-1">
                                <span class="svg-icon svg-icon-primary svg-icon-2 me-1" data-toogle="tooltip" data-theme="dark" title="Commentaires">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd" d="M5.69477 2.48932C4.00472 2.74648 2.66565 3.98488 2.37546 5.66957C2.17321 6.84372 2 8.33525 2 10C2 11.6647 2.17321 13.1563 2.37546 14.3304C2.62456 15.7766 3.64656 16.8939 5 17.344V20.7476C5 21.5219 5.84211 22.0024 6.50873 21.6085L12.6241 17.9949C14.8384 17.9586 16.8238 17.7361 18.3052 17.5107C19.9953 17.2535 21.3344 16.0151 21.6245 14.3304C21.8268 13.1563 22 11.6647 22 10C22 8.33525 21.8268 6.84372 21.6245 5.66957C21.3344 3.98488 19.9953 2.74648 18.3052 2.48932C16.6859 2.24293 14.4644 2 12 2C9.53559 2 7.31411 2.24293 5.69477 2.48932Z" fill="#191213"></path>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M7 7C6.44772 7 6 7.44772 6 8C6 8.55228 6.44772 9 7 9H17C17.5523 9 18 8.55228 18 8C18 7.44772 17.5523 7 17 7H7ZM7 11C6.44772 11 6 11.4477 6 12C6 12.5523 6.44772 13 7 13H11C11.5523 13 12 12.5523 12 12C12 11.4477 11.5523 11 11 11H7Z" fill="#121319"></path>
									</svg>
								</span>
                                <span class="fw-bolder text-gray-400">{{ count($blog->validComments) }} {{ \Illuminate\Support\Str::plural('Commentaire', count($blog->validComments)) }}</span>
                            </div>
                            <div class="mr-9 my-1">
                                <span class="svg-icon svg-icon-primary svg-icon-2 me-1" data-toogle="tooltip" data-theme="dark" title="Tags">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" >
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z" fill="#000000" opacity="0.3" transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) "/>
                                            <path d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z" fill="#000000" transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) "/>
                                        </g>
                                    </svg>
								</span>
                                @foreach($blog->tags as $tag)
                                    <span class="label label-primary label-inline font-weight-lighter mr-2">{{ $tag->tag }}</span>
                                @endforeach
                            </div>
                        </div>
                        <a href="#" class="text-dark text-hover-primary h3 fw-bolder">{{ $blog->title }}</a>
                        <img src="storage/files/shares/blog/{{ $blog->image }}" alt="{{ $blog->seo_title }}" class="card-img-top mt-8 mb-5">
                        <div class="h6 text-gray-400 text-justify font-style-italic">{!! $blog->short_content !!}</div>
                        <div class="h6 fw-bold text-gray-600 text-justify">{!! $blog->content !!}</div>
                        <div class="comments-wrap mt-9">

                            <div id="comments" class="row">
                                <div id="commentsList" class="column col-12">

                                    @if($blog->valid_comments_count > 0)
                                        <div id="forShow">
                                            <p id="showbutton" class="text-center">
                                                <a id="showcomments" href="{{ route('front.blog.comments', $blog->id) }}" class="btn btn-default btn-block btn-lg">Voir les commentaires</a>
                                            </p>
                                            <p id="showicon" class="h-text-center" hidden>
                                                <span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>
                                            </p>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script type="text/javascript">
        (() => {
            const headers = {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }

            const prepareShowComments = e => {
                e.preventDefault();

                document.getElementById('showbutton').toggleAttribute('hidden')
                document.getElementById('showicon').toggleAttribute('hidden');
                showComments();
            }

            const showComments = async () => {
                const response = await fetch(`{{ route('front.blog.comments', $blog->id) }}`, {
                    method: 'GET',
                    headers: headers
                });

                const data = await response.json();

                document.getElementById('commentsList').innerHTML = data.html;
            }

            const wrapper = (selector, type, callback, condition = 'true', capture = false) => {
                const element = document.querySelector(selector);

                if(element) {
                    document.querySelector(selector).addEventListener(type, e => {
                        if(eval(condition)) {
                            callback(e);
                        }
                    }, capture);
                }
            };

            window.addEventListener('DOMContentLoaded', () => {
                wrapper('#showcomments', 'click', prepareShowComments);
            });

        })()
    </script>
@endsection
