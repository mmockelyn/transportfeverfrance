<div class="header-nav-bar bg-primary">
    <div class="container">
        <div class="header-row p-relative">
            <div class="header-column">
                <div class="header-row">
                    <div class="header-colum order-2 order-lg-1">
                        <div class="header-row">
                            <div class="header-nav header-nav-stripe header-nav-divisor header-nav-force-light-text justify-content-start">
                                <div class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                    <nav class="collapse">
                                        <ul class="nav nav-pills" id="mainNav">
                                            <li class="dropdown dropdown-full-color dropdown-light">
                                                <a class="dropdown-item dropdown-toggle" href="{{ route('home') }}">
                                                    Acceuil
                                                </a>
                                            </li>
                                            <li class="dropdown dropdown-full-color dropdown-light">
                                                <a class="dropdown-item dropdown-toggle" href="{{ route('front.blog') }}">
                                                    Blog
                                                </a>
                                            </li>
                                            <li class="dropdown dropdown-full-color dropdown-light">
                                                <a class="dropdown-item dropdown-toggle" href="#">
                                                    Téléchargement
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-submenu">
                                                        @foreach($download_categories as $category)
                                                        <a class="dropdown-item" href="#">{{ $category->title }}</a>
                                                        <ul class="dropdown-menu">
                                                            @foreach($category->subcategories as $subcategory)
                                                            <li><a class="dropdown-item" href="{{ route('front.download.category', $subcategory->id) }}">{{ $subcategory->title }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown dropdown-full-color dropdown-light">
                                                <a class="dropdown-item dropdown-toggle" href="{{ route('contacts.create') }}">
                                                    Nous contacter
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="header-column order-1 order-lg-2">
                        <div class="header-row justify-content-end">
                            <div class="header-nav-features header-nav-features-no-border w-75 w-auto-mobile d-none d-sm-flex">
                                <form role="search" class="d-flex w-100" action="/api/search" method="get">
                                    <div class="simple-search input-group w-100">
                                        <input class="form-control border-0 text-1" id="headerSearch" name="search" type="search" value="" placeholder="Rechercher...">
                                        <span class="input-group-append bg-light border-0">
											<button class="btn" type="submit">
												<i class="fa fa-search header-nav-top-icon"></i>
											</button>
										</span>
                                    </div>
                                </form>
                            </div>
                            @if(auth()->guest())
                                <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                                    <div class="header-nav-feature header-nav-features-user d-inline-flex mx-2 pr-2 signin" id="headerAccount">
                                        <a href="#" class="header-nav-features-toggle">
                                            <i class="far fa-user"></i> Connexion
                                        </a>
                                        <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right" id="headerTopUserDropdown">
                                            <div class="signin-form">
                                                <h5 class="text-uppercase mb-4 font-weight-bold text-3">Connexion</h5>
                                                <form action="{{ route('login') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="mb-1 text-2 opacity-8">Adresse Mail * </label>
                                                        <input type="email" class="form-control form-control-lg" name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="mb-1 text-2 opacity-8">Mot de passe *</label>
                                                        <input type="password" class="form-control form-control-lg" name="password" required>
                                                    </div>
                                                    <div class="form-row pb-2">
                                                        <div class="form-group form-check col-lg-6 pl-1">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="rememberMeCheck" name="remember">
                                                                <label class="custom-control-label text-2" for="rememberMeCheck">Se souvenir de moi</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6 text-right">
                                                            <a class="text-uppercase text-1 font-weight-bold text-color-dark" id="headerRecover" href="#">Oublie de mot de passe ?</a>
                                                        </div>
                                                    </div>
                                                    <div class="actions">
                                                        <div class="form-row">
                                                            <div class="col d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary">Connexion</button>
                                                            </div>
                                                            <div class="col d-flex justify-content-center">
                                                                <a href="{{ route('auth.login.provider', 'discord') }}" class="mb-1 mt-1 mr-1 btn bg-discord text-color-white"><i class="fab fa-discord"></i></a>
                                                                <a href="{{ route('auth.login.provider', 'google') }}" class="mb-1 mt-1 mr-1 btn bg-google text-color-white"><i class="fab fa-google"></i></a>
                                                                <a href="{{ route('auth.login.provider', 'facebook') }}" class="mb-1 mt-1 mr-1 btn bg-facebook text-color-white"><i class="fab fa-facebook"></i></a>
                                                                <a href="{{ route('auth.login.provider', 'twitter') }}" class="mb-1 mt-1 mr-1 btn bg-twitter text-color-white"><i class="fab fa-twitter"></i></a>
                                                                <a href="{{ route('auth.login.provider', 'steam') }}" class="mb-1 mt-1 mr-1 btn bg-steam text-color-white"><i class="fab fa-steam"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="extra-actions">
                                                        <p>Vous n'avez pas de compte ? <a href="#" id="headerSignUp" class="text-uppercase text-1 font-weight-bold text-color-dark">S'inscrire</a></p>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="signup-form">
                                                <h5 class="text-uppercase mb-4 font-weight-bold text-3">Inscription</h5>
                                                <form action="{{ route('register') }}" method="post">
                                                    <div class="form-group">
                                                        <label class="mb-1 text-2 opacity-8">Pseudo * </label>
                                                        <input type="text" class="form-control form-control-lg" name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="mb-1 text-2 opacity-8">Adresse Mail * </label>
                                                        <input type="email" class="form-control form-control-lg" name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="mb-1 text-2 opacity-8">Mot de passe *</label>
                                                        <input type="password" class="form-control form-control-lg" name="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="mb-1 text-2 opacity-8">Confirmation du mot de passe *</label>
                                                        <input type="password" class="form-control form-control-lg" name="password_confirmation" required>
                                                    </div>
                                                    <div class="actions">
                                                        <div class="form-row">
                                                            <div class="col d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary">M'inscrire</button>
                                                            </div>
                                                            <div class="col d-flex justify-content-center">
                                                                <a href="{{ route('auth.login.provider', 'discord') }}" class="mb-1 mt-1 mr-1 btn bg-discord text-color-white"><i class="fab fa-discord"></i></a>
                                                                <a href="{{ route('auth.login.provider', 'google') }}" class="mb-1 mt-1 mr-1 btn bg-google text-color-white"><i class="fab fa-google"></i></a>
                                                                <a href="{{ route('auth.login.provider', 'facebook') }}" class="mb-1 mt-1 mr-1 btn bg-facebook text-color-white"><i class="fab fa-facebook"></i></a>
                                                                <a href="{{ route('auth.login.provider', 'twitter') }}" class="mb-1 mt-1 mr-1 btn bg-twitter text-color-white"><i class="fab fa-twitter"></i></a>
                                                                <a href="{{ route('auth.login.provider', 'steam') }}" class="mb-1 mt-1 mr-1 btn bg-steam text-color-white"><i class="fab fa-steam"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="extra-actions">
                                                        <p>Vous avez déja un compte ? <a href="#" id="headerSignIn" class="text-uppercase text-1 font-weight-bold text-color-dark">Connexion</a></p>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="recover-form">
                                                <h5 class="text-uppercase mb-2 pb-1 font-weight-bold text-3">Réinitialiser mon mot de passe</h5>
                                                <p class="text-2 mb-4">Remplissez le formulaire ci-dessous pour recevoir un e-mail avec le code d'autorisation nécessaire pour réinitialiser votre mot de passe.</p>

                                                <form action="{{ route('password.email') }}">
                                                    <div class="form-group">
                                                        <label class="mb-1 text-2 opacity-8">Adresse Mail* </label>
                                                        <input type="email" class="form-control form-control-lg" name="email" required>
                                                    </div>
                                                    <div class="actions">
                                                        <div class="form-row">
                                                            <div class="col d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary">Réinitialiser</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="extra-actions">
                                                        <p>Vous avez déja un compte ? <a href="#" id="headerRecoverCancel" class="text-uppercase text-1 font-weight-bold text-color-dark">Connexion</a></p>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                                    <div class="header-nav-feature header-nav-features-user header-nav-features-user-logged d-inline-flex mx-2 pr-2" id="headerAccount">
                                        <a href="#" class="header-nav-features-toggle text-white">
                                            <i class="far fa-user"></i> {{ auth()->user()->name }}
                                        </a>
                                        <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right" id="headerTopUserDropdown">
                                            <div class="row">
                                                <div class="col-8">
                                                    <p class="mb-0 pb-0 text-2 line-height-1 pt-1">
                                                        @if(now()->hour >= 0 && now()->hour <= 17)
                                                            Bonjour,
                                                        @else
                                                            Bonsoir,
                                                        @endif
                                                    </p>
                                                    <p><strong class="text-color-dark text-4">{{ auth()->user()->name }}</strong></p>
                                                </div>
                                                <div class="col-4">
                                                    <div class="d-flex justify-content-end">
                                                        @if(auth()->user()->image)
                                                            <img class="rounded-circle" width="40" height="40" alt="" src="/storage/files/shares/avatar/{{ auth()->user()->image }}">
                                                        @else
                                                            <img class="rounded-circle" width="40" height="40" alt="" src="/storage/files/shares/avatar/placeholder.png">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <ul class="nav nav-list-simple flex-column text-3">
                                                        <li class="nav-item"><a class="nav-link" href="{{ route('account.profil') }}"><i class="fas fa-user-circle"></i> Mon profil</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="{{ route('account.badges') }}"><i class="fas fa-certificate"></i> Mes badges</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="{{ route('account.notify') }}"><i class="fas fa-bell"></i> Mes notifications</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="{{ route('account.messagerie') }}"><i class="fas fa-envelope-square"></i> Ma messagerie</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="{{ route('account.packages') }}"><i class="fas fa-boxes"></i> Mes Packages</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="{{ route('account.project') }}"><i class="fas fa-layer-group"></i> Mes projets</a></li>
                                                        @if(auth()->user()->group == 1)
                                                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-cogs"></i> Administration du site</a></li>
                                                        @endif
                                                            <li class="nav-item">
                                                                <form action="{{ route('logout') }}" method="POST">
                                                                    <button type="submit" class="btn btn-xs btn-primary"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
                                                                </form>
                                                            </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
