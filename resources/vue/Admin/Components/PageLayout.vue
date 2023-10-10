<template>
    <Head
        :title="title ? `${appProps.appName} - ${title}` : appProps.appName"
    />
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb my-1 mx-0">
            <Link
                v-if="isUrl('admin/')"
                href="/admin"
                as="li"
                class="breadcrumb-item"
                ><a href=""> {{ $t("admin.main.edarah") }}</a></Link
            >
            <slot name="navigation-links"></slot>
        </ol>
    </nav>
    <template v-if="$slots.tabs">
        <slot name="tabs" />
        <div class="row">
            <div class="page-content" style="height: 80vh">
                <slot />
            </div>
        </div>
    </template>

    <template v-else>
        <slot />
    </template>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Head,
        Link,
    },
    props: {
        title: String,
        pageTitle: String,
    },
    setup() {
        const appProps = computed(() => usePage().props.value);
        return { appProps };
    },
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1);
            if (urls[0] === "") {
                return currentUrl === "";
            }
            return urls.filter((url) => currentUrl.startsWith(url)).length;
        },
    },
};
</script>
