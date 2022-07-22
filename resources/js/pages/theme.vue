<template>
    <div class="sticky top-0 z-[100] bg-canvas border-b border-default text-title">
        <div class="container flex flex-row items-center gap-4 sm:gap-6 p-4 sm:p-6">
            <div class="grow font-black text-3xl sm:text-4xl">
                Theme Demo
            </div>

            <div class="flex-none">
                <v-dropdown :options="dropdownMenus.theme" anchor="topright" offset="1.5">
                    <i class="fa-solid fa-circle-half-stroke fa-xl"></i>
                </v-dropdown>
            </div>

            <div class="flex-none">
                <v-dropdown :options="dropdownMenus.basic" anchor="topright" offset="1.5">
                    <i class="fa-solid fa-bars fa-2xl"></i>
                </v-dropdown>
            </div>

            <div class="flex-none">
                <v-dropdown :options="dropdownMenus.complex" anchor="topright" offset="1.5">
                    <i class="fa-solid fa-bars fa-2xl"></i>
                </v-dropdown>
            </div>
        </div>
    </div>

    <div class="container flex flex-col gap-4 sm:gap-6 p-4 sm:p-6">
        <section>
            <div class="mt-4 mb-8 font-black text-primary text-3xl text-center">
                Type: Font Sizes
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <v-panel v-for="(font, fontLabel) in fonts" :key="fontLabel">
                    <template v-slot:header>
                        {{ fontLabel }} Font
                    </template>

                    <div :class="font">
                        <p v-for="(fontSize, fontSizeLabel) in fontSizes" :key="fontSizeLabel" class="mb-4" :class="fontSize">
                            <span class="text-info">
                                {{ fontSizeLabel }}:
                            </span>

                            {{ lorem(2) }}
                        </p>
                    </div>
                </v-panel>
            </div>
        </section>

        <section>
            <div class="mt-4 mb-8 font-black text-primary text-3xl text-center">
                Type: Font Weights
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <v-panel v-for="(font, fontLabel) in fonts" :key="fontLabel">
                    <template v-slot:header>
                        {{ fontLabel }} Font
                    </template>

                    <div :class="font">
                        <p v-for="(fontWeight, fontWeightLabel) in fontWeights" :key="fontWeightLabel" class="mb-4" :class="fontWeight">
                            <span class="text-info">
                                {{ fontWeightLabel }}:
                            </span>

                            {{ lorem(2) }}
                        </p>
                    </div>
                </v-panel>
            </div>
        </section>

        <section>
            <div class="mt-4 mb-8 font-black text-primary text-3xl text-center">
                Type: Text Colors
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <v-panel v-for="(textColor, textColorLabel) in textColors" :key="textColorLabel">
                    <template v-slot:header>
                        {{ textColorLabel }} Text
                    </template>

                    <p class="mb-4">
                        {{ lorem(2) }}
                    </p>

                    <p :class="textColor">
                        {{ lorem(2) }}
                    </p>
                </v-panel>
            </div>
        </section>

        <section>
            <div class="mt-4 mb-8 font-black text-primary text-3xl text-center">
                Panels: Colors
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">
                <div v-for="color in colors" :key="color" class="contents">
                    <v-panel :class="`border-4 ${borderColors[color]}`">
                        <template v-slot:header>
                            {{ color }} / Default
                        </template>

                        <p>
                            {{ lorem(2) }}
                        </p>
                    </v-panel>

                    <v-panel :class="`border-4 ${borderColors[color]}`">
                        <template v-slot:header>
                            {{ color }} / {{ color }}
                        </template>

                        <p :class="textColors[color]">
                            {{ lorem(2) }}
                        </p>
                    </v-panel>
                </div>
            </div>
        </section>

        <section>
            <div class="mt-4 mb-8 font-black text-primary text-3xl text-center">
                Tools: Buttons
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div v-for="buttonType in buttonTypes" :key="buttonType" class="contents">
                    <v-panel>
                        <template v-slot:header>
                            {{ buttonType }}
                        </template>

                        <div class="grid grid-cols-[auto_auto_auto] justify-items-center items-center gap-x-2 gap-y-4">
                            <div v-for="(buttonSize, buttonSizeLabel) in buttonSizes" :key="buttonSizeLabel">
                                {{ buttonSizeLabel }}
                            </div>

                            <div v-for="(buttonColor, buttonColorLabel) in buttonColors" :key="buttonColorLabel" class="contents">
                                <div v-for="(buttonSize, buttonSizeLabel) in buttonSizes" :key="buttonSizeLabel" class="contents">
                                    <v-button :color="buttonColor" :size="buttonSize" :round="buttonType.includes('Rounded')" :outline="buttonType.includes('Outlined')" class="capitalize">
                                        {{ buttonColor }}
                                    </v-button>
                                </div>
                            </div>
                        </div>
                    </v-panel>
                </div>
            </div>
        </section>

        <section>
            <div class="mt-4 mb-8 font-black text-primary text-3xl text-center">
                Tools: Forms
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 sm:gap-6">
                <v-panel v-for="formType in formTypes" :key="formType">
                    <template v-slot:header>
                        {{ formType }} Form
                    </template>

                    <div class="grid gap-4" :class="{ 'grid-cols-1': formType === 'Stacked', 'grid-cols-[auto_1fr]': formType === 'Inline' }">
                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Text Field
                            </template>

                            <v-input type="text" icon="fa-solid fa-comment-dots" v-model="form.text" placeholder="Enter some text..."/>

                            <template v-slot:help>
                                This is a help block for a form field
                            </template>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Number Field
                            </template>

                            <v-input type="number" icon="fa-solid fa-arrow-down-1-9" v-model.number="form.number" placeholder="Select a number..."/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Email Field
                            </template>

                            <v-input type="email" icon="fa-solid fa-at" v-model="form.email" placeholder="Enter an email address..."/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Password Field
                            </template>

                            <v-input type="password" icon="fa-solid fa-lock" v-model="form.password" placeholder="Enter your password..."/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Date Field
                            </template>

                            <v-input type="date" icon="fa-solid fa-calendar-days" v-model="form.date" placeholder="Select a date..."/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Time Field
                            </template>

                            <v-input type="time" icon="fa-solid fa-clock" v-model="form.time" placeholder="Select a time..."/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Select Field
                            </template>

                            <v-select :options="selectOptions.single" icon="fa-solid fa-list" v-model="form.select" placeholder="Select an option..."/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Multi-Select Field
                            </template>

                            <v-select :options="selectOptions.multiple" :multiple="true" icon="fa-solid fa-list" v-model="form.multiselect" placeholder="Select some options..."/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                            </template>

                            <v-checkbox v-model="form.checkbox" class="mr-8">
                                Checkbox
                            </v-checkbox>

                            <v-checkbox v-model="form.checkbox" disabled>
                                Disabled Checkbox
                            </v-checkbox>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                            </template>

                            <v-radio v-model="form.radio" value="one" class="mr-8">
                                Radio 1
                            </v-radio>

                            <v-radio v-model="form.radio" value="two" class="mr-8">
                                Radio 2
                            </v-radio>

                            <v-radio v-model="form.radio" value="three" class="mr-8">
                                Radio 3
                            </v-radio>

                            <v-radio v-model="form.radio" :value="null" disabled>
                                Disabled Radio
                            </v-radio>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Disabled Field
                            </template>

                            <v-input type="text" icon="fa-solid fa-comment-dots" v-model="form.text" placeholder="Disabled field..." disabled/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Disabled Selectable
                            </template>

                            <v-select :options="selectOptions" icon="fa-solid fa-list" v-model="form.select" placeholder="Disabled select..." disabled/>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Validation
                            </template>

                            <v-input type="text" icon="fa-solid fa-list-check" v-model="form.success" :validation="true"/>

                            <template v-slot:success>
                                This is a success block for a form field
                            </template>
                        </v-form-group>

                        <v-form-group :inline="formType === 'Inline'">
                            <template v-slot:label>
                                Validation
                            </template>

                            <v-input type="text" icon="fa-solid fa-list-check" v-model="form.error" :validation="false"/>

                            <template v-slot:error>
                                This is an error block for a form field
                            </template>
                        </v-form-group>
                    </div>
                </v-panel>
            </div>
        </section>

        <section>
            <div class="mt-4 mb-8 font-black text-primary text-3xl text-center">
                Tools: Modal Dialogs
            </div>

            <v-panel class="max-w-md mx-auto">
                <template v-slot:header>
                    Modal Dialogs
                </template>

                <div class="grid grid-cols-[1fr_auto] items-center gap-4">
                    <div v-for="(modalIcon, modalIconLabel) in modalIcons" :key="modalIconLabel" class="contents">
                        <div>
                            Modal with Icon:

                            <span class="font-bold">
                                {{ modalIconLabel }}
                            </span>
                        </div>

                        <v-button @click="showModal(modalIcon)">
                            Show
                        </v-button>
                    </div>
                </div>
            </v-panel>

            <v-modal :show="modalDialog.show" size="md" :icon="modalDialog.icon" @close="modalDialog.show = false">
                <template v-slot:header>
                    Modal Dialog
                </template>

                {{ lorem(5) }}

                <template v-slot:footer>
                    <div class="flex flex-row flex-wrap place-content-center gap-4">
                        <v-button color="success">
                            Yes
                        </v-button>

                        <v-button color="error">
                            No
                        </v-button>

                        <v-button>
                            Cancel
                        </v-button>
                    </div>
                </template>
            </v-modal>
        </section>
    </div>
</template>

<script>
    export default {
        computed: {
            borderColors() {
                return {
                    'Default': 'border-default',
                    'Primary': 'border-primary',
                    'Info': 'border-info',
                    'Success': 'border-success',
                    'Warning': 'border-warning',
                    'Error': 'border-error',
                };
            },
            buttonColors() {
                return {
                    'Default': 'default',
                    'Primary': 'primary',
                    'Info': 'info',
                    'Success': 'success',
                    'Warning': 'warning',
                    'Error': 'error',
                };
            },
            buttonSizes() {
                return {
                    'Small': 'small',
                    'Regular': 'regular',
                    'Large': 'large',
                };
            },
            buttonTypes() {
                return [
                    'Standard',
                    'Rounded',
                    'Standard Outlined',
                    'Rounded Outlined',
                ];
            },
            colors() {
                return [
                    'Default',
                    'Primary',
                    'Info',
                    'Success',
                    'Warning',
                    'Error',
                ];
            },
            dropdownMenus() {
                let dropdownMenus = {
                    theme: [],
                    basic: [],
                    complex: [],
                };

                ['System', 'Light', 'Dark'].forEach(
                    (theme) => dropdownMenus.theme.push({
                        type: 'action',
                        label: theme,
                        checked: localStorage.theme === theme.toLowerCase(),
                        click: () => {
                            localStorage.theme = theme.toLowerCase();
                            window.location.reload();
                        },
                    })
                );

                ['English', 'Spanish', 'Italian', 'French', 'German', 'Japanese'].forEach(
                    (language) => dropdownMenus.basic.push({
                        type: 'action',
                        label: language,
                        checked: this.dropdownSelected.basic === language,
                        click: () => this.dropdownSelected.basic = language,
                    })
                );

                dropdownMenus.complex = [
                    {
                        type: 'action',
                        label: 'My Locale',
                        checked: this.dropdownSelected.complex === 'locale',
                        click: () => this.dropdownSelected.complex = 'locale',
                    },
                    {
                        type: 'group',
                        label: 'North America',
                        options: [
                            {
                                type: 'action',
                                icon: 'fa-solid fa-dollar-sign',
                                label: 'USD',
                                checked: this.dropdownSelected.complex === 'USD',
                                click: () => this.dropdownSelected.complex = 'USD',
                            },
                            {
                                type: 'action',
                                icon: 'fa-solid fa-peso-sign',
                                label: 'Peso',
                                checked: this.dropdownSelected.complex === 'PESO',
                                click: () => this.dropdownSelected.complex = 'PESO',
                            },
                        ],
                    },
                    {
                        type: 'group',
                        label: 'Europe',
                        options: [
                            {
                                type: 'action',
                                icon: 'fa-solid fa-euro-sign',
                                label: 'Euro',
                                checked: this.dropdownSelected.complex === 'EURO',
                                click: () => this.dropdownSelected.complex = 'EURO',
                            },
                        ],
                    },
                    {
                        type: 'group',
                        label: 'Asia',
                        options: [
                            {
                                type: 'action',
                                icon: 'fa-solid fa-yen-sign',
                                label: 'Yen',
                                checked: this.dropdownSelected.complex === 'YEN',
                                click: () => this.dropdownSelected.complex = 'YEN',
                            },
                        ],
                    },
                    {
                        type: 'group',
                        label: 'Cryptocurrency',
                        options: [
                            {
                                type: 'action',
                                icon: 'fa-solid fa-bitcoin-sign',
                                label: 'Bitcoin',
                                checked: this.dropdownSelected.complex === 'bitcoin',
                                click: () => this.dropdownSelected.complex = 'bitcoin',
                            },
                        ],
                    },
                ];

                return dropdownMenus;
            },
            fonts() {
                return {
                    'Normal': 'font-default',
                    'Monospace': 'font-mono',
                };
            },
            fontSizes() {
                return {
                    'Extra Small': 'text-xs',
                    'Small': 'text-sm',
                    'Base': 'text-base',
                    'Large': 'text-lg',
                    'Extra Large': 'text-xl',
                };
            },
            fontWeights() {
                return {
                    'Thin': 'font-thin',
                    'Normal': 'font-normal',
                    'Medium': 'font-medium',
                    'Bold': 'font-bold',
                    'Black': 'font-black',
                };
            },
            formTypes() {
                return [
                    'Stacked',
                    'Inline',
                ];
            },
            modalIcons() {
                return {
                    'None': null,
                    'Info': 'info',
                    'Question': 'question',
                    'Loading': 'loading',
                    'Success': 'success',
                    'Warning': 'warning',
                    'Error': 'error',
                    'Custom': 'fa-solid fa-bug text-primary',
                };
            },
            selectOptions() {
                return {
                    single: [
                        {
                            label: null,
                            value: null,
                        },
                        {
                            label: 'Red',
                            value: 'R',
                        },
                        {
                            label: 'Green',
                            value: 'G',
                        },
                        {
                            label: 'Blue',
                            value: 'B',
                        },
                    ],
                    multiple: [
                        {
                            label: 'Cyan',
                            value: 'C',
                        },
                        {
                            label: 'Magenta',
                            value: 'M',
                        },
                        {
                            label: 'Yellow',
                            value: 'Y',
                        },
                        {
                            label: 'Black',
                            value: 'K',
                        },
                    ],
                };
            },
            textColors() {
                return {
                    'Default': 'text-default',
                    'Primary': 'text-primary',
                    'Info': 'text-info',
                    'Success': 'text-success',
                    'Warning': 'text-warning',
                    'Error': 'text-error',
                };
            },
        },
        data() {
            return {
                dropdownSelected: {
                    basic: 'English',
                    complex: 'USD',
                },
                form: this.useForm({
                    text: null,
                    number: null,
                    email: null,
                    password: null,
                    date: null,
                    time: null,
                    select: null,
                    multiselect: [],
                    checkbox: false,
                    radio: null,
                    success: 'Valid form field value',
                    error: 'Invalid form field value',
                }),
                modalDialog: {
                    icon: null,
                    show: false,
                },
            };
        },
        methods: {
            showModal(icon) {
                this.modalDialog.icon = icon;
                this.modalDialog.show = true;
            },
        },
    };
</script>
