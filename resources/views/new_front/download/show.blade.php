@extends("new_front.layouts.layout")
@section("style")

@endsection

@section("meta")
    <x-meta
        title="{{ $download->title }}"
        description="{{ $download->short_content }}"
        image="/storage/files/shares/download/{{ $download->image }}"
        author="Transport Fever France"
        url="{{ route('front.download.show', $download->slug) }}"
        keywords="{!! $download->meta_keywords !!}"
    />
@endsection

@section("content")
    <section class="page-header page-header-modern page-header-background page-header-background-md py-0 overlay overlay-color-primary overlay-show overlay-op-8" style="background-image: url(/front/assets/img/page-header/page-header-background-2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 order-2 order-sm-1 align-self-center p-static">
                    <div class="overflow-hidden">
                        <ul class="breadcrumb breadcrumb-light d-block appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="100" style="animation-delay: 100ms;">
                            <li><a href="#">Accueil</a></li>
                            <li><a href="#">Téléchargement</a></li>
                            <li><a href="#">{{ $download->category->title }}</a></li>
                            <li><a href="#">{{ $download->subcategory->title }}</a></li>
                            <li class="active">{{ $download->title }}</li>
                        </ul>
                    </div>
                    <div class="overflow-hidden pb-2">
                        <h1 class="text-10 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="300" style="animation-delay: 300ms;">
                            {{ $download->title }}</h1>
                    </div>
                    <div class="appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="animation-delay: 400ms;">
                        <span class="sub-title text-4 mt-4">{{ $download->short_content }}</span>
                    </div>
                    <div class="appear-animation d-inline-block animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="animation-delay: 400ms;">
                        @if($download->steam_link_package)
                            <a href="{{ $download->steam_link_package }}" class="btn btn-modern bg-steam mt-4"><i class="fab fa-steam"></i> Télécharger sur steam <i class="fas fa-arrow-right ml-1"></i></a>
                        @endif
                        @if($download->tfnet_link_package)
                            <a href="{{ $download->tfnet_link_package }}" class="btn btn-modern btn-danger mt-4"><img src="/storage/files/shares/core/icons/tf_net_icon.png" alt="" width="24"> Télécharger sur Transport Fever.net <i class="fas fa-arrow-right ml-1"></i></a>
                        @endif
                        @if($download->tf_france_link_package)
                            <a href="{{ $download->tf_france_link_package }}" class="btn btn-modern btn-primary mt-4"><img src="/storage/files/shares/core/icons/tf_france_icon.png" alt="" width="24"> Télécharger le mod <i class="fas fa-arrow-right ml-1"></i></a>
                        @endif
                    </div>
                    <div class="appear-animation d-inline-block animated rotateInUpRight appear-animation-visible" data-appear-animation="rotateInUpRight" data-appear-animation-delay="500" style="animation-delay: 500ms;">
                        <span class="arrow hlt" style="top: 40px;"></span>
                    </div>
                </div>
                <div class="col-sm-7 order-1 order-sm-2 align-items-end justify-content-end d-flex pt-5">
                    <div style="min-height: 350px;" class="overflow-hidden">
                        <img alt="" src="/storage/files/shares/download/{{ $download->image }}" class="img-fluid appear-animation animated slideInUp appear-animation-visible" data-appear-animation="slideInUp" data-appear-animation-delay="600" data-appear-animation-duration="1s" style="animation-duration: 1s; animation-delay: 600ms; width: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col">
                <div class="tabs tabs-bottom tabs-center tabs-simple">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link" href="#description" data-toggle="tab">
								<span class="featured-boxes featured-boxes-style-6 p-0 m-0">
									<span class="featured-box featured-box-primary featured-box-effect-6 p-0 m-0">
										<span class="box-content p-0 m-0">
											<i class="icon-featured fas fa-columns"></i>
										</span>
									</span>
								</span>
                                <p class="mb-0 pb-0">Description</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#comments" data-toggle="tab">
								<span class="featured-boxes featured-boxes-style-6 p-0 m-0">
									<span class="featured-box featured-box-primary featured-box-effect-6 p-0 m-0">
										<span class="box-content p-0 m-0">
											<i class="icon-featured fas fa-comments"></i>
										</span>
									</span>
								</span>
                                <p class="mb-0 pb-0">Commentaires ({{ $download->comments()->count() }})</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#versions" data-toggle="tab">
								<span class="featured-boxes featured-boxes-style-6 p-0 m-0">
									<span class="featured-box featured-box-primary featured-box-effect-6 p-0 m-0">
										<span class="box-content p-0 m-0">
											<i class="icon-featured fas fa-code-branch"></i>
										</span>
									</span>
								</span>
                                <p class="mb-0 pb-0">Note de version</p>
                            </a>
                        </li>
                        @if($download->wiki->content)
                            <li class="nav-item">
                                <a class="nav-link" href="#wiki" data-toggle="tab">
								<span class="featured-boxes featured-boxes-style-6 p-0 m-0">
									<span class="featured-box featured-box-primary featured-box-effect-6 p-0 m-0">
										<span class="box-content p-0 m-0">
											<i class="icon-featured fas fa-book-reader"></i>
										</span>
									</span>
								</span>
                                    <p class="mb-0 pb-0">Documentation</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="#support" data-toggle="tab">
								<span class="featured-boxes featured-boxes-style-6 p-0 m-0">
									<span class="featured-box featured-box-primary featured-box-effect-6 p-0 m-0">
										<span class="box-content p-0 m-0">
											<i class="icon-featured fas fa-life-ring"></i>
										</span>
									</span>
								</span>
                                <p class="mb-0 pb-0">Support</p>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="row">
                                <div class="col-9">
                                    <div class="owl-carousel owl-theme nav-inside" data-plugin-options="{'items': 1, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}">
                                        @foreach($download->galleries as $gallery)
                                        <div>
                                            <div class="img-thumbnail border-0 p-0 d-block">
                                                <img class="img-fluid border-radius-0" src="/storage/files/shares/download/{{ $download->id }}/{{ $download->image }}" alt="">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="divider divider-style-2 taller">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    {!! $download->content !!}
                                </div>
                                <div class="col-3">
                                    <div class="card text-center" data-plugin-sticky data-plugin-options="{'minWidth': 991, 'containerSelector': '.col-3', 'padding': {'top': 110}}">
                                        <img class="card-img-top" src="/storage/files/shares/download/{{ $download->image }}" alt="Card Image">
                                        <div class="card-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-weight-bold">Catégorie</td>
                                                        <td class="text-right">{{ $download->category->title }} - {{ $download->subcategory->title }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Publier le</td>
                                                        <td class="text-right">{{ $download->created_at->toFormattedDateString() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Mise à jours le</td>
                                                        <td class="text-right">{{ $download->updated_at->toFormattedDateString() }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <a href="" class="card-footer bg-primary text-3 text-uppercase text-white">
                                            <i class="fas fa-file-download mr-2"></i> Télécharger le mod
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="comments">
                            <ul class="comments">
                                @foreach($download->comments as $comment)
                                <li>
                                    <div class="comment">
                                        <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                            @if($comment->user->image)
                                                <img class="avatar" alt="" src="/storage/files/shares/avatar/{{ $comment->user->image }}">
                                            @else
                                                <img class="avatar" alt="" src="/storage/files/shares/avatar/placeholder.png">
                                            @endif
                                        </div>
                                        <div class="comment-block">
                                            <div class="comment-arrow"></div>
                                            <span class="comment-by">
												<strong>{{ $comment->user->name }}</strong>
												@if(auth()->user()->id == $comment->user->id || auth()->user()->group == 1)
                                                    <span class="float-right">
														<span>
                                                            <a href="#"><i class="fas fa-trash"></i> Supprimer</a>
                                                        </span>
													</span>
                                                @endif
											</span>
                                            {!! $comment->content !!}
                                            <span class="date float-right">{{ $comment->updated_at->toDayDateTimeString() }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-pane" id="versions">
                            <div class="process process-vertical py-4">
                                @foreach($download->versions as $version)
                                <div class="process-step appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200" style="animation-delay: 200ms;">
                                    <div class="process-step-circle">
                                        <strong class="process-step-circle-content">{{ $version->version }} {!! \App\Helpers\Format::labelDownloadVersionType($version->type, false) !!}</strong>
                                    </div>
                                    <div class="process-step-content">
                                        <h4 class="mb-1 text-4 font-weight-bold">
                                            {{ $version->updated_at->toDayDateTimeString() }}
                                        </h4>
                                        <p class="mb-0">
                                            {!! $version->content !!}
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="wiki">
                            {!! $download->wiki->content !!}
                        </div>
                        <div class="tab-pane" id="support">
                            <section class="call-to-action call-to-action-dark mb-5">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-9 col-lg-9">
                                            <div class="call-to-action-content">
                                                <h3>Vous avez un problème avec ce mod ?</h3>
                                                <p class="mb-0">Les auteurs du mod sont disponible pour répondre à toutes vos questions.</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-lg-3">
                                            <div class="call-to-action-btn">
                                                <button class="btn btn-modern text-2 btn-light border-0" data-toggle="modal" data-target="#new_ticket">Ouvrir un ticket</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            @auth()
                            <div class="container">
                                <div class="card border-radius-0 bg-color-light border-0 box-shadow-1">
                                    <div class="card-body">
                                        <h4 class="card-title mb-1 text-4 font-weight-bold">Liste de vos tickets</h4>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Numéro</th>
                                                <th>Etat</th>
                                                <th>Sujet</th>
                                                <th>Date de mise à jour</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(auth()->user()->downloadsupports as $ticket)
                                                <tr>
                                                    <td>#TCK-MOD{{ $download->id }}-{{ $ticket->id }}</td>
                                                    <td>
                                                        {!! \App\Helpers\Format::labelDownloadSupportState($ticket->state) !!}
                                                    </td>
                                                    <td>{{ $ticket->subject }}</td>
                                                    <td>
                                                        @if($ticket->updated_at->between(\Illuminate\Support\Carbon::now(), \Illuminate\Support\Carbon::now()->addDay()) == true)
                                                            {{ $ticket->updated_at->diffForHumans() }}
                                                        @else
                                                            {{ $ticket->updated_at->format('d/m/Y à H:i') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('front.download.ticket.room', [$download->slug, $ticket->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->check())
        <div class="modal fade" id="new_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouvelle demande de support</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <form action="{{ route('front.download.ticket.new', $download->slug) }}" id="formCreateSupport" method="POST">
                        @csrf
                        <input type="hidden" id="download_id" name="download_id" value="{{ $download->id }}">
                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="modal-body">
                            <div class="d-flex align-items-center mb-10">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40 symbol-light-white mr-5">
                                    <div class="symbol-label">
                                        @if(auth()->user()->avatar)
                                            <img src="{{ auth()->user()->avatar }}" class="h-75 align-self-end" alt="">
                                        @else
                                            <img src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get(auth()->user()->email) }}" class="h-75 align-self-end" alt="">
                                        @endif
                                    </div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column font-weight-bold">
                                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{ auth()->user()->name }}</a>
                                    <span class="text-muted">{{ auth()->user()->email }}</span>
                                </div>
                                <!--end::Text-->
                            </div>
                            <div class="form-group">
                                <label>Sujet de votre demande <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control form-control-solid form-control-lg" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label>Description de votre problème <span class="text-danger">*</span> </label>
                                <textarea name="message" class="summernote" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnFormCreateSupport" class="btn btn-primary font-weight-bold">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="modal fade" id="new_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouvelle demande de support</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <form action="{{ route('front.download.ticket.new', $download->slug) }}" id="formCreateSupport" method="POST">
                        @csrf
                        <input type="hidden" id="download_id" name="download_id" value="{{ $download->id }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Votre Nom <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control form-control-solid form-control-lg" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Votre Email <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control form-control-solid form-control-lg" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Sujet de votre demande <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control form-control-solid form-control-lg" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label>Description de votre problème <span class="text-danger">*</span> </label>
                                <textarea name="message" class="summernote" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnFormCreateSupport" class="btn btn-primary font-weight-bold">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section("script")
    <script src="/account/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script>
        let useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        tinymce.init({
            selector: 'textarea.summernote',
            plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable  charmap quickbars emoticons',
            tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
            tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
            tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
            tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
            mobile: {
                plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable  charmap quickbars emoticons'
            },
            menu: {
                tc: {
                    title: 'Comments',
                    items: 'addcomment showcomments deleteallconversations'
                }
            },
            menubar: 'file edit view insert format tools table tc help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [
                { title: 'My page 1', value: 'https://www.tiny.cloud' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_list: [
                { title: 'My page 1', value: 'https://www.tiny.cloud' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_class_list: [
                { title: 'None', value: '' },
                { title: 'Some class', value: 'class-name' }
            ],
            importcss_append: true,
            templates: [
                { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
            tinycomments_mode: 'embedded',
            content_style: '.mymention{ color: gray; }',
            contextmenu: 'link image imagetools table configurepermanentpen',
            a11y_advanced_options: true,
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            language: 'fr_FR',
            setup: (editor) => {
                editor.on('change', () => {
                    editor.save()
                })
            }
        });

        $("#formCreateSupport").on('submit', (e) => {
            e.preventDefault()
            let form = $("#formCreateSupport")
            let url = form.attr('action')
            let btn = KTUtil.getById('btnFormCreateSupport')
            let data = form.serializeArray()

            KTUtil.btnWait(btn, 'spinner spinner-dark spinner-right pr-15', 'Chargement...')

            $.ajax({
                url: url,
                method: "POST",
                data: data,
                success: (data) => {
                    KTUtil.btnRelease(btn)
                    toastr.success(data.message, `Ticket N°${data.ticket_id}`)
                    console.log(data)
                },
                error: (err) => {
                    KTUtil.btnRelease(btn)
                    toastr.error("Impossible de publier le commentaire.", "Erreur Serveur")
                    console.log(err)
                }
            })
        })
    </script>
@endsection
