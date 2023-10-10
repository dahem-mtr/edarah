<nav class="navbar align-items-center sticky-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="btn sidebar-toggle" type="button">
                <i class="bi bi-list"></i>
            </button>

            <div class="dropdown">
                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-fill"> </i>{{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#"><i class="bi
                      bi-card-text"></i>
                            {{ __('admin/main.profile') }}</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                class="bi
                      bi-box-arrow-right"></i>
                            {{ __('admin/main.sign-out') }}</a></li>
                </ul>
            </div>


            <div class="dropdown">
                <button class="btn" type="button" id="wer" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell"></i>

                </button>
                <div class="dropdown-menu" aria-labelledby="wer">
                    <div class="content-lg">
                        <div class="content-lg-header"> {{ __('admin/main.notifications') }} </div>
                        <div class="dropdown-divider"></div>
                        <ui class="notifications">
                            <li> <a href="#">
                                    <div class="icon">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                    <div class="body">{{ __('admin/main.messages') }} 6</div>
                                    <div class="date text-muted">
                                        {{ __('admin/main.4-months-ago') }}
                                    </div>
                                </a></li>
                            <li> <a href="#">
                                    <div class="icon">
                                        <i class="bi bi-clipboard"></i>
                                    </div>
                                    <div class="body"> {{ __('admin/main.reports') }} 4</div>
                                    <div class="date text-muted">
                                        {{ __('admin/main.4-months-ago') }}
                                    </div>
                                </a></li>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn"></i> {{ __('admin/main.more') }}</button>
                            </div>
                        </ui>

                    </div>

                </div>

                <a class="btn"
                    href="{{ route('admin.changeLang', Config::get('app.locale') == 'ar' ? 'en' : 'ar') }}">
                    {{ Config::get('app.locale') == 'ar' ? 'en' : 'ar' }}
                </a>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.darkToggle') }}">
                <button class="btn" type="button">
                    <i class="bi bi-lightbulb"></i>
                    <i class="bi bi-lightbulb-off"></i>
                </button>
            </a>


        </div>
    </div>
</nav>
