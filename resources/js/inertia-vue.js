/*
|-------------------------------------------------------------------------------
| Create and mount the global Vue app
|-------------------------------------------------------------------------------
*/

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';

const app = document.getElementById('app');

const VueApp = createApp({
    render: () => h(InertiaApp, {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: (name) => require(`./pages/${name}`).default,
    }),
});

VueApp.use(InertiaPlugin)
    .mount(app);

/*
|-------------------------------------------------------------------------------
| Add global props and methods to the Vue app
|-------------------------------------------------------------------------------
*/

import {
    Head as InertiaHead,
    Link as InertiaLink,
    useForm,
} from '@inertiajs/inertia-vue3';

VueApp.mixin({
    components: {
        InertiaHead,
        InertiaLink,
    },
    props: {
        env: String,
        myself: Object,
        status: String,
    },
    methods: {
        route,
        useForm,
    },
});

/*
|-------------------------------------------------------------------------------
| Add global components to the Vue app
|-------------------------------------------------------------------------------
*/

import Alert from '@/components/alert';
import Button from '@/components/button';
import Checkbox from '@/components/checkbox';
import Dropdown from '@/components/dropdown';
import Input from '@/components/input';
import Label from '@/components/label';
import Link from '@/components/link';
import Modal from '@/components/modal';
import Panel from '@/components/panel';
import Select from '@/components/select';
import Table from '@/components/table';

VueApp.component('v-alert', Alert);
VueApp.component('v-button', Button);
VueApp.component('v-checkbox', Checkbox);
VueApp.component('v-dropdown', Dropdown);
VueApp.component('v-input', Input);
VueApp.component('v-label', Label);
VueApp.component('v-link', Link);
VueApp.component('v-modal', Modal);
VueApp.component('v-panel', Panel);
VueApp.component('v-select', Select);
VueApp.component('v-table', Table);

/*
|-------------------------------------------------------------------------------
| Initialize the Inertia request progress indicator
|-------------------------------------------------------------------------------
*/

import { InertiaProgress } from '@inertiajs/progress';

InertiaProgress.init({
    delay: 0,
    color: '#29d',
    includeCSS: true,
    showSpinner: true,
});
