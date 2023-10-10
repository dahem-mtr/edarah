<template>
    <div v-if="$page.props.flashMessage.success">
        {{ hideAfterSomeSecend() }}
        <div class="toast-position">
            <div
                class="toast show align-items-center text-white bg-success border-0"
            >
                <div class="toast-body">
                    {{ $page.props.flashMessage.success }}
                </div>
            </div>
        </div>
    </div>

    <div v-if="$page.props.flashMessage.error">
        {{ hideAfterSomeSecend() }}
        <div class="toast-position">
            <div
                class="toast show align-items-center text-white bg-danger border-0"
            >
                <div class="toast-body">
                    {{ $page.props.flashMessage.error }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        hideAfterSomeSecend(fieldName) {
            setTimeout(() => {
                this.$page.props.flashMessage.success = null;
                this.$page.props.flashMessage.error = null;
            }, 2000);
        },
    },
};
</script>
