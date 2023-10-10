<template>
    <Card :title="payload.title" :headerLayout="payload.headerLayout">
        <form @submit.prevent="submit">
            <FormWithCustomLayout
                :payload="payload"
                :defineField="defineField"
                :form="form"
            />

            <button
                type="submit"
                class="btn m-3"
                :class="
                    typeof payload.submit.title === 'object'
                        ? payload.submit.title[1]
                        : 'btn-primary'
                "
                v-html="
                    typeof payload.submit.title === 'object'
                        ? payload.submit.title[0]
                        : payload.submit.title
                "
            ></button>
        </form>
    </Card>
</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";
import Card from "../../Components/Card.vue";
import DeclarePropsForChild from "../../Utils/DeclarePropsForChild.vue";
import FormWithCustomLayout from "./FormWithCustomLayout.vue";

import * as Fields from "../../Components/Fields/Shared/index";

export default {
    components: { Card, DeclarePropsForChild, FormWithCustomLayout, ...Fields },

    props: {
        payload: Object,
    },
    setup(props) {
        const defineFieldsValues = (fields) => {
            var fieldsWithValus = {};
            for (const field of fields) {
                fieldsWithValus[field.name] = field.value ? field.value : null;
            }

            return fieldsWithValus;
        };
        const form = useForm(defineFieldsValues(props.payload.fields));
        return { form };
    },

    methods: {
        defineField(fieldName) {
            var field = this.payload.fields.find(
                (field) => field.name === fieldName
            );
            field.value = this.form[field.name];
            return field;
        },
        ddd(fieldName) {
            return "df";
        },
        submit() {
            this.form[this.payload.submit.type.toLowerCase()](
                this.payload.submit.action,
                {
                    onSuccess: () => this.form.reset(),
                }
            );
        },
    },
};
</script>
