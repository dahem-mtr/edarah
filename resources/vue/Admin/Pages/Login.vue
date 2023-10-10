<template>
    <Head  title=" admin - LogIn"/>
    <div class="row d-flex align-items-center  justify-content-center" style="min-height: 100vh;">
        <div class="col-sm-6">
            <div class="card  ">
                <div class="card-body">
                    <div v-if="$page.props.flashMessage.error" class="alert alert-danger">
                        {{ $page.props.flashMessage.error }}
                    </div>
                    <form @submit.prevent="submit" >
                        <h2>{{ $t('admin.main.dashboard') }}</h2>
                        <label  for="">{{ $t('admin.main.email-address') }}</label>
                        <input id="email"  v-model="form.email" class="form-control" type="email"
                                required autofocus>
                        <label  for="">{{ $t('admin.main.password') }}</label>
                        <input id="password" v-model="form.password" class="form-control" type="password"
                               autocomplete="off" required>
                        <p class="checkbox">
                            <label><input type="checkbox" id="remember" v-model="form.remember">
                               {{ $t('admin.main.remember-me') }} </label>
                        </p>
                        <button class="btn btn-primary btn-block" type="sumbit">{{ $t('admin.main.sign-in') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive,computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import {Head, usePage} from '@inertiajs/inertia-vue3'
export default {
    components: {Head},

    setup () {

        const appProps = computed(() => usePage().props.value)
        const form = reactive({
            email: null,
            password: null,
            remember:false

        })

        function submit() {
            Inertia.post(this.appProps.routes.authenticate, form)
        }

        return { form, submit,appProps }
    },
}
</script>
