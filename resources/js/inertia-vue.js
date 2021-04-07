/**
 * Create and mount the global Vue app
 */

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/app';

const app = document.getElementById('app');

const VueApp = createApp({
    render: () => h(InertiaApp, {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: (name) => import(`./pages/${name}`)
            .then(({ default: page }) => {
                if (page.layout === undefined) {
                    page.layout = AppLayout;
                }
                return page;
            }),
    }),
});

VueApp.use(InertiaPlugin)
    .mount(app);

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

import Button from '@/components/button';
import Card from '@/components/card';
import Input from '@/components/input';
import Label from '@/components/label';

VueApp.component('v-button', Button);
VueApp.component('v-card', Card);
VueApp.component('v-input', Input);
VueApp.component('v-label', Label);
