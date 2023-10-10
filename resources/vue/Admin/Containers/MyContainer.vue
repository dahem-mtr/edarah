<template>
    {{ payload }}
    <Link href="/admin/users/create" >مستخدم جديد</Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

    export default {
         components: { Link },
        props: {
            payload: String,
        },
    }
</script>

