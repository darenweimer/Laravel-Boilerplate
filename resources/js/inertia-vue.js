/**
 * Create and mount the global Vue app
 */

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/app';

const VueApp = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: (name) =>
                import(`./pages/${name}`)
                    .then(({ default: page }) => {
                        page.layout = page.layout ? page.layout : AppLayout;
                        return page;
                    }),
        }),
});

VueApp.use(InertiaPlugin)
    .mount('#app');

/**
 * Add global props and methods to the Vue app
 */

import { useForm } from '@inertiajs/inertia-vue3';

VueApp.mixin({
    props: {
        user: Object,
        status: String,
    },
    methods: {
        route,
        useForm,
    },
});

/**
 * Add global components to the Vue app
 */

import Card from '@/components/card';

VueApp.component('v-card', Card);
