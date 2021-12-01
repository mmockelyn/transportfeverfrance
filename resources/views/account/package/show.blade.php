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
                                <tr>
                                    <td>Nombre de commentaires</td>
                                    <td class="text-right">
                                        {{ count($download->comments) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nombre de Tickets de support</td>
                                    <td class="text-right">
                                        {{ count($download->supports) }}
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
                            <div class="tab-pane fade" id="feature" role="tabpanel" aria-labelledby="feature">
                                <div class="d-flex flex-row-reverse mb-10">
                                    <button class="btn btn-primary btnEditFeature" data-package-id="{{ $download->id }}">Editer les caractéristiques</button>
                                </div>
                                @if($download->feature->type_feature == 1)
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Disponibilité</th>
                                            <th>Pays</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $download->feature->dispo_start }} @if($download->feature->end) - {{ $download->feature->dispo_end }} @endif</td>
                                                <td>{{ $download->feature->pays }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Type de Vehicule</th>
                                            <th>Conduite</th>
                                            <th>Vitesse</th>
                                            <th>Performance</th>
                                            <th>Traction</th>
                                            <th>Disponibilité</th>
                                            <th>Ecartement</th>
                                            <th>Capacité</th>
                                            <th>Pays</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ $download->feature->type_vehicule }}</td>
                                            <td>{{ $download->feature->conduite_vehicule }}</td>
                                            <td>{{ $download->feature->vitesse }} Km/H</td>
                                            <td>{{ $download->feature->performance }} Kw</td>
                                            <td>{{ $download->feature->traction }} kN</td>
                                            <td>{{ $download->feature->dispo_start }} @if($download->feature->end) - {{ $download->feature->dispo_end }} @endif</td>
                                            <td>{{ $download->feature->ecartement }} mm</td>
                                            <td>{{ $download->feature->capacity }}</td>
                                            <td>{{ $download->feature->pays }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user">
                                <div class="row">
                                    @foreach($download->users as $user)
                                        <div class="col-3">
                                            <div class="card card-custom gutter-b card-stretch">
                                                <!--begin::Body-->
                                                <div class="card-body text-center pt-4">
                                                    <!--begin::User-->
                                                    <div class="mt-7">
                                                        <div class="symbol symbol-circle symbol-lg-75">
                                                            @if($user->avatar != null)
                                                                <img src="{{ $user->avatar }}" alt="image">
                                                            @else
                                                                <img src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($user->email) }}" alt="image">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!--end::User-->
                                                    <!--begin::Name-->
                                                    <div class="my-2">
                                                        <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4">{{ $user->name }}</a>
                                                    </div>
                                                    <!--end::Name-->
                                                    <!--begin::Label-->
                                                    @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$user->id))
                                                        <span class="label label-inline label-lg label-light-success btn-sm font-weight-bold">Connecter</span>
                                                    @else
                                                        <span class="label label-inline label-lg label-light-danger btn-sm font-weight-bold">Déconnecter</span>
                                                    @endif
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments">
                                <div class="card card-custom">
                                    <div class="card-body">
                                        <table class="table table-bordered" id="table_comments">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Auteur</th>
                                                    <th>Commentaire</th>
                                                    <th>Etat</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($download->comments as $comment)
                                                    <tr>
                                                        <td>{{ $comment->id }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center mb-10">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-40 symbol-light-white mr-5">
                                                                    <div class="symbol-label">
                                                                        @if($comment->user->avatar != null)
                                                                            <img src="{{ $comment->user->avatar }}" class="h-75 align-self-end" alt="">
                                                                        @else
                                                                            <img src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($comment->user->email) }}" class="h-75 align-self-end" alt="">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Text-->
                                                                <div class="d-flex flex-column font-weight-bold">
                                                                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{ $comment->user->name }}</a>
                                                                    @if(\Illuminate\Support\Facades\Cache::has('user-is-online-'.$comment->user->id))
                                                                        <span class="text-muted text-success">Connecter</span>
                                                                    @else
                                                                        <span class="text-muted text-danger">Déconnecter</span>
                                                                    @endif
                                                                </div>
                                                                <!--end::Text-->
                                                            </div>
                                                        </td>
                                                        <td>{!! $comment->content !!}</td>
                                                        <td>
                                                            @if($comment->valid == 0)
                                                                <span class="label label-danger label-inline">Non publier</span>
                                                            @else
                                                                <span class="label label-success label-inline">Publier</span>
                                                            @endif
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="version" role="tabpanel" aria-labelledby="version">
                                <div class="card card-custom">
                                    <div class="card-body">
                                        <table class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="table_version">
                                            <thead>
                                            <tr>
                                                <th>Version</th>
                                                <th>Type</th>
                                                <th>Lien</th>
                                                <th>Etat</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($download->versions as $version)
                                                <tr>
                                                    <td>{{ $version->version }}</td>
                                                    <td>{!! \App\Helpers\Format::labelDownloadVersionType($version->type) !!}</td>
                                                    <td>{{ $version->link_packages }}</td>
                                                    <td>{!! \App\Helpers\Format::labelDownloadVersionState($version->state) !!}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="editFeature">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="" method="post" id="formEditPackageFeature">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <input type="hidden" name="feature_id" value="">
                        <input type="hidden" name="download_id" value="{{ $download->id }}">
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">Type de véhicule</label>
                            <input type="text" class="form-control" name="type_vehicule" placeholder="Type de véhicule (Locomotive, wagon, automotrice, tram, bus,...)" value="" />
                        </div>
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">Type de conduite</label>
                            <select class="form-control h-auto p-5 border-0 rounded-lg selectpicker" name="conduite_vehicule">
                                <option value=""></option>
                                <option value="cheval">A Cheval</option>
                                <option value="charbon">Charbon</option>
                                <option value="gazole">Gazole</option>
                                <option value="electrique">Electrique</option>
                                <option value="hybride">Hybride</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Vitesse</label>
                                    <input type="text" class="form-control" name="vitesse" placeholder="Vitesse maximal du véhicule" value="" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Performance</label>
                                    <input type="text" class="form-control" name="performance" placeholder="Puissance en Kw" value="" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Effort de traction</label>
                                    <input type="text" class="form-control" name="traction" placeholder="Effort continue en Kn" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-solid separator-border-4 mb-3"></div>
                        <h3>Disponibilité</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Début</label>
                                    <input type="text" class="form-control inputmask" name="dispo_start" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Fin</label>
                                    <input type="text" class="form-control inputmask" name="dispo_end" />
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-solid separator-border-4 mb-3"></div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Ecartement de voie en mm</label>
                                    <select class="form-control selectpicker" name="ecartement" multiple>
                                        <option></option>
                                        <option value="1524">1524</option>
                                        <option value="1435">1435</option>
                                        <option value="1000">1000</option>
                                        <option value="900">900</option>
                                        <option value="785">785</option>
                                        <option value="760">760</option>
                                        <option value="750">750</option>
                                        <option value="700">700</option>
                                        <option value="600">600</option>
                                        <option value="381">381</option>
                                        <option value="0">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Capacité</label>
                                    <input type="text" class="form-control" name="capacity" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Pays ISO 3166</label>
                                    <select class="form-control selectpicker" name="pays" multiple>
                                        <option value="">Select</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AX">Åland Islands</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia, Plurinational State of</option>
                                        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Côte d'Ivoire</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CW">Curaçao</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Island and McDonald Islands</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran, Islamic Republic of</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macao</option>
                                        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PS">Palestinian Territory, Occupied</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Réunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="BL">Saint Barthélemy</option>
                                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="MF">Saint Martin (French part)</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SX">Sint Maarten (Dutch part)</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="SS">South Sudan</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan, Province of China</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela, Bolivarian Republic of</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands, British</option>
                                        <option value="VI">Virgin Islands, U.S.</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset('front/js/account/package/show.js') }}"
@endsection
