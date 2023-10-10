<template>
    <component  :is="component"   :payload="payload" ></component>
</template>


<script>
    import {defineAsyncComponent} from 'vue'
    import LoadingComponent from '../Components/Loading.vue'

    export default {
        props: {
            container: String,
            payload: [String,Array,Number,Object],

        },
        data() {
            return {isLoaded: false,
            }
        },
        computed: {
            component() {
                return defineAsyncComponent({
                    loader: () => import(`../Containers/${this.container}.vue`),
                    loadingComponent: LoadingComponent,


                });
            }
        }
    }
</script>


