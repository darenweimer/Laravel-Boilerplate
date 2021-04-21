/**
 * Create and mount the global Vue app
 */

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';

const app = document.getElementById('app');

const VueApp = createApp({
    render: () => h(InertiaApp, {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: name => require(`./pages/${name}`).default,
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
import Checkbox from '@/components/checkbox';
import Dropdown from '@/components/dropdown';
import Input from '@/components/input';
import Label from '@/components/label';
import Link from '@/components/link';
import Select from '@/components/select';

VueApp.component('v-button', Button);
VueApp.component('v-card', Card);
VueApp.component('v-checkbox', Checkbox);
VueApp.component('v-dropdown', Dropdown);
VueApp.component('v-input', Input);
VueApp.component('v-label', Label);
VueApp.component('v-link', Link);
VueApp.component('v-select', Select);

/**
 * Initialize the Inertia request progress indicator
 */

import { InertiaProgress } from '@inertiajs/progress';

InertiaProgress.init({
    delay: 0,
    color: '#29d',
    includeCSS: true,
    showSpinner: true,
});
