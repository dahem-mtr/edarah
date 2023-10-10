<template>


    <div>
        <Image
            :img="image()"
            :height="field.imageDisplaySize && field.imageDisplaySize[0]"
            :width="field.imageDisplaySize && field.imageDisplaySize[1]"
        />
    </div>

    <label
        v-if="(!imageSelectdUrl && !field.oldImage) || field.value == ''"
        for="img"
        class="form-label m-2 text-primary fs-5"
    >
        <i for="img" class="bi bi-cloud-arrow-up"></i
    ></label>
    <label v-else class="form-label m-2 text-primary fs-5">
        <i class="bi bi-trash" v-on:click="onFIleSlectedCancel"></i>
    </label>

    <input
        id="img"
        style="display: none"
        type="file"
        ref="inputFile"
        @input="onFileChange"
        :multiple="field.multiple"
    />

</template>

<script>
import Image from "../../Image.vue";

export default {
    props: {
        field: Object,
    },
    components: { Image },

    emits: ["change"],

      
    data() {
        return {
            imageSelectdUrl: null,
        };
    },
    methods: {
        image() {
            if (this.field.value) {
                return this.imageSelectdUrl;
            }

            if (this.field.oldImage && this.field.value !== "") {
                return `/${this.field.oldImage.path}/${this.field.oldImage.name}`;
            }

            return "/assets/empty.jpeg";
        },
        onFileChange(event) {
            this.$emit("change", event.target.files[0]);

            if (event.target.files[0].type.startsWith("image")) {
                this.imageSelectdUrl = URL.createObjectURL(
                    event.target.files[0]
                );
            }
            // this.$refs.inputFile.value = null;
        },
        onFIleSlectedCancel() {
            this.$emit("change", "");
            this.imageSelectdUrl = null;
            this.field.oldImage = null;
        },
    },
};
</script>
