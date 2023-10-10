import "./bootstrap";
import "./admin/bootstrap.bundle.min";
import "./admin/admin";
import { createApp, h } from "vue";
import { i18nVue } from "laravel-vue-i18n";

import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import Layout from "../vue/Admin/Components/Layout.vue";

InertiaProgress.init();

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `../vue/Admin/Pages/${name}.vue`,
            import.meta.glob("../vue/Admin/Pages/**/*.vue")
        ).then((page) => {
            page.default.layout = page.layout || Layout;
            return page;
        }),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18nVue, {
                resolve: async (lang) => {
                    const langs = import.meta.glob("../../lang/*.json");
                    if (lang.includes("php_")) {
                        return await langs[`../../lang/${lang}.json`]();
                    }
                },
            })
            .mount(el);
    },
});
