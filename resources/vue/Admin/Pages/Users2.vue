<template>
    <PageLayout
        :title=" $t('admin.main.users')"
    >
        <template v-slot:navigation-links>
            <li class="breadcrumb-item active"> {{ $t('admin.main.users') }}</li>
        </template>
 <h4 class="page-title"></h4>
    </PageLayout>
</template>
<script>

import PageLayout from "@/Components/Admin/PageLayout.vue";

export default {
    components: {PageLayout},
}
</script>
