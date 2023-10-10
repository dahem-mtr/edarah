<template>
    <div>
        <Sidebar v-if="!isUrl('admin/login')" />
        <div class="app-wrapper">
            <Navbar v-if="!isUrl('admin/login')" />
            <Messages />
            
            <div class="container-fluid">
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "./Sidebar.vue";
import Navbar from "./Navbar.vue";
import Messages from "./Messages.vue";

export default {
    components: {
        Sidebar,
        Navbar,
        Messages
    },
    created() {
        // this.$i18n.locale = this.$page.props.lang;
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
