<template>
    <div class="sidebar collapsed">
        <div class="header">
            <Link

                :href="$page.props.routes.app" as="a" class="title">
                {{ $page.props.appName }}
            </Link>

        </div>

        <ul class="links">


            <li class="link" :class="isUrl('admin/users') ? 'active' : ''">
                <Link
                    v-if="$page.props.auth.permissionsOnModels.User && $page.props.auth.permissionsOnModels.User.includes('browse')"
                    :href="$page.props.routes.users" as="a" class="breadcrumb-item"><i class="bi bi-people-fill sidebar-icon"> </i>
                    {{ $t('admin.main.users')}}
                </Link>


            </li>


            <li class="link">
                <a href="#"> <i class="bi bi-gear-fill"></i> settings
                </a>
            </li>


        </ul>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link
    },
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1)
            if (urls[0] === '') {
                return currentUrl === ''
            }
            return urls.filter((url) => currentUrl.startsWith(url)).length
        },
    },
}
</script>

