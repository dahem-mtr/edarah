<template>
    <input
        class="form-control "
        :value="field.value"
        :placeholder="field.placeholder"
        :required="field.withRequiredMark"
        :type="field.type"
        @input="(event) => $emit('update-value', event.target.value === '' ?  null :  event.target.value )"
    />
</template>

<script>
export default {
    props: {
        field: Object,  
    },
    emits: ["update-value"],
};
</script>
