<template>
    <nav class="navbar align-items-center sticky-top">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <button class="btn sidebar-toggle" type="button">
                    <i class="bi bi-list"></i>
                </button>
                <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="bi bi-person-fill"> </i> {{ $page.props.auth.name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#"><i class="bi
                     bi-card-text"></i>
                            profile</a>
                        </li>
                        <li>
                            <Link
                                :href="$page.props.routes.logout" as="a"  class="dropdown-item">
                                <i
                                    class="bi
                     bi-box-arrow-right"></i>
                                sign-out
                            </Link>


                        </li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn" type="button" id="wer" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                    </button>
                    <div class="dropdown-menu">
                        <div class="content-lg">
                            <div class="content-lg-header">{{ $t('admin.main.notifications')}}</div>
                            <div class="dropdown-divider"></div>
                            <ul class="notifications">
                                <li><a href="#">
                                    <div class="icon">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                    <div class="body">{{ $t('admin.main.messages')}} 6</div>
                                    <div class="date text-muted">
                                       {{ $t('admin.main.4-months-ago')}}  
                                    </div>
                                </a></li>
                                <li><a href="#">
                                    <div class="icon">
                                        <i class="bi bi-clipboard"></i>
                                    </div>
                                    <div class="body"> {{ $t('admin.main.reports')}} 4</div>
                                    <div class="date text-muted">
                                       {{ $t('admin.main.4-months-ago')}}  
                                    </div>
                                </a></li>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn">   {{ $t('admin.main.more')}}  </button>

                                </div>
                            </ul>

                        </div>

                    </div>

                    <a class="btn"
                       :href="$page.props.routes.changeLang.replace(':lang',$page.props.lang == 'ar'? 'en' : 'ar')">
                        {{ $page.props.lang == 'ar' ? 'en' : 'ar' }}
                    </a>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <Link
                    :href="$page.props.routes.darkToggle" as="button" type="button" class="btn dark-mode-toggle" >
                    <i class="bi bi-lightbulb"></i>
                    <i class="bi bi-lightbulb-off"></i>
                </Link>
            </div>
        </div>
    </nav>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link
    },
}
</script>
