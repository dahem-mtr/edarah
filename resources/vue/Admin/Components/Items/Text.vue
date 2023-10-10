<template>
    <div class="item-value" :class="options.textClass && options.textClass">
        {{ payload }}
    </div>
</template>

<script>


    export default {
        props: {
            payload: [Number, String, Boolean, Date],
            options: Object,
        },
      
    }
</script>


