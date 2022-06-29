/*
|-------------------------------------------------------------------------------
| Import the required components
|-------------------------------------------------------------------------------
*/

import {
    createApp as vueCreateApp,
    h as vueRender,
} from 'vue';

import {
    App as InertiaApp,
    plugin as InertiaPlugin,
    Link as InertiaLink,
    useForm,
} from '@inertiajs/inertia-vue3';

import Alert from '@/components/alert';
import Button from '@/components/button';
import Checkbox from '@/components/checkbox';
import Dropdown from '@/components/dropdown';
import FormGroup from '@/components/form-group';
import Input from '@/components/input';
import Link from '@/components/link';
import Modal from '@/components/modal';
import Panel from '@/components/panel';
import Radio from '@/components/radio';
import Select from '@/components/select';

/*
|-------------------------------------------------------------------------------
| Create the Vue application
|-------------------------------------------------------------------------------
*/

const app = document.getElementById('app');

vueCreateApp({
    render: () => vueRender(
        InertiaApp,
        {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: (name) => require(`./pages/${name}`).default,
        }
    ),
})
.use(InertiaPlugin)
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
        route,
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
.mount(app);
