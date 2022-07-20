/*
|-------------------------------------------------------------------------------
| Import the required components
|-------------------------------------------------------------------------------
*/

import { createApp, h } from 'vue';
import { createInertiaApp, Link as InertiaLink, useForm } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import lorem from '@/mixins/lorem.js';

import Alert from '@/components/alert.vue';
import Button from '@/components/button.vue';
import Checkbox from '@/components/checkbox.vue';
import Dropdown from '@/components/dropdown.vue';
import FormGroup from '@/components/form-group.vue';
import Input from '@/components/input.vue';
import Link from '@/components/link.vue';
import Modal from '@/components/modal.vue';
import Panel from '@/components/panel.vue';
import Radio from '@/components/radio.vue';
import Select from '@/components/select.vue';

/*
|-------------------------------------------------------------------------------
| Create the Vue application
|-------------------------------------------------------------------------------
*/

createInertiaApp({
    resolve: (name) => resolvePageComponent(
        `./pages/${name}.vue`,
        import.meta.glob('./pages/**/*.vue')
    ),
    setup({ el, app, props, plugin }) {
        return createApp({
            render: () => h(app, props),
        })
        .use(plugin)
        .use(ZiggyVue, Ziggy)
        .mixin({
            components: {
                InertiaLink,
            },
            props: {
                env: String,
                myself: Object,
                status: String,
            },
            methods: {
                lorem,
                useForm,
            },
        })
        .component('v-alert', Alert)
        .component('v-button', Button)
        .component('v-checkbox', Checkbox)
        .component('v-dropdown', Dropdown)
        .component('v-form-group', FormGroup)
        .component('v-input', Input)
        .component('v-link', Link)
        .component('v-modal', Modal)
        .component('v-panel', Panel)
        .component('v-radio', Radio)
        .component('v-select', Select)
        .mount(el);
    },
});
