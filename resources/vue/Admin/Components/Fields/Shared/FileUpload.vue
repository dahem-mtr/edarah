<template>
    <UploadImage
        v-if="field.fileType === 'image'"
        :field="field"
        @change="(value) => $emit('update-value', value)"
    />
</template>

<script>
import UploadImage from "./UploadImage.vue";

export default {
    props: {
        field: Object,
    },
    emits: ["update-value"],

    components: { Image, UploadImage },
};
</script>
