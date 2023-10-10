<template>
    <div
        v-if="actions"
        style="display: flex; gap: 2px; flex-wrap: wrap"
        class="pb-1"
    >
        <template v-for="(action, i) in actions" :key="i">
            <button
                type="button"
                @click="$emit('onAction', action)"
                class="btn px-1 btn-sm"
                :class="
                    isArray(action.title) ? action.title[1] : 'text-primary'
                "
                v-html="isArray(action.title) ? action.title[0] : action.title"
            ></button>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        actions: Array,
        isArray: Function,
    },
};
</script>
