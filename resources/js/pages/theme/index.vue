<template>
    <div class="container flex flex-col gap-8 p-8">
        <div class="flex flex-row items-center gap-8 border-b border-default text-title pb-4">
            <div class="grow font-black text-2xl sm:text-4xl">
                Theme Demo
            </div>

            <div class="flex-none">
                <v-dropdown :options="dropdownOptions['basic']" anchor="topright" offset="1.5">
                    <i class="fa-solid fa-bars fa-2xl"></i>
                </v-dropdown>
            </div>

            <div class="flex-none">
                <v-dropdown :options="dropdownOptions['complex']" anchor="topright" offset="1.5">
                    <i class="fa-solid fa-bars fa-2xl"></i>
                </v-dropdown>
            </div>
        </div>

        <div class="font-black text-2xl sm:text-3xl text-primary text-center">
            Typography
            <i class="fa-solid fa-caret-right mx-1"></i>
            Colors
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <v-panel v-for="(color, index) in colors" :key="index">
                <template v-slot:header>
                    Class: text-{{ color }}
                </template>

                {{ lorem(1, 0) }}

                <div class="mt-2" :class="`text-${color}`">
                    {{ lorem(3, 1) }}
                </div>
            </v-panel>
        </div>

        <div class="font-black text-2xl sm:text-3xl text-primary text-center">
            Components
            <i class="fa-solid fa-caret-right mx-1"></i>
            Forms
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <v-panel v-for="index in 2" :key="index">
                <template v-slot:header>
                    {{ (index === 1) ? 'Stacked' : 'Inline' }} Forms
                </template>

                <div class="grid gap-4" :class="{ 'grid-cols-1': index === 1, 'grid-cols-[auto_1fr]': index !== 1 }">
                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Text Input
                        </template>

                        <v-input type="text" icon="fa-solid fa-comment-dots" modelValue="Some random text"/>

                        <template v-slot:help>
                            This is a help block for a form group
                        </template>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Disabled Input
                        </template>

                        <v-input type="text" icon="fa-solid fa-comment-dots" placeholder="Disabled field..." disabled/>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Number Input
                        </template>

                        <v-input type="number" icon="fa-solid fa-arrow-down-1-9" placeholder="Select number..."/>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Email Input
                        </template>

                        <v-input type="email" icon="fa-solid fa-at" placeholder="Enter email address..."/>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Password Input
                        </template>

                        <v-input type="password" icon="fa-solid fa-lock" placeholder="Enter password..."/>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Date Input
                        </template>

                        <v-input type="date" icon="fa-solid fa-calendar-days" placeholder="Select date..."/>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Time Input
                        </template>

                        <v-input type="time" icon="fa-solid fa-clock" placeholder="Select time..."/>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Select
                        </template>

                        <v-select :options="selectOptions" icon="fa-solid fa-list" placeholder="Select an option..."/>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Disabled Select
                        </template>

                        <v-select :options="selectOptions" icon="fa-solid fa-list" placeholder="Disabled select..." disabled/>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                        </template>

                        <v-checkbox v-model="checkbox" class="mr-8">
                            Checkbox
                        </v-checkbox>

                        <v-checkbox v-model="checkbox" disabled>
                            Disabled Checkbox
                        </v-checkbox>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                        </template>

                        <v-radio value="one" v-model="radio" class="mr-8">
                            Radio 1
                        </v-radio>

                        <v-radio value="two" v-model="radio" class="mr-8">
                            Radio 2
                        </v-radio>

                        <v-radio value="three" v-model="radio" class="mr-8">
                            Radio 3
                        </v-radio>

                        <v-radio value="four" v-model="radio" :disabled="true">
                            Disabled Radio
                        </v-radio>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Validation
                        </template>

                        <v-input type="text" icon="fa-solid fa-list-check" modelValue="Valid field value" :validation="true"/>

                        <template v-slot:success>
                            This is a success block for a form group
                        </template>
                    </v-form-group>

                    <v-form-group :inline="index === 2">
                        <template v-slot:label>
                            Validation
                        </template>

                        <v-input type="text" icon="fa-solid fa-list-check" modelValue="Invalid field value" :validation="false"/>

                        <template v-slot:error>
                            This is an error block for a form group
                        </template>
                    </v-form-group>
                </div>
            </v-panel>
        </div>

        <div class="font-black text-2xl sm:text-3xl text-primary text-center">
            Components
            <i class="fa-solid fa-caret-right mx-1"></i>
            Buttons
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <v-panel>
                <template v-slot:header>
                    Standard Buttons
                </template>

                <div class="grid grid-cols-[auto_auto_auto] justify-items-center items-center gap-x-2 gap-y-4 pb-1">
                    <div v-for="(size, index) in ['Small', 'Regular', 'Large']" :key="index">
                        {{ size }}
                    </div>

                    <v-button v-for="(btnOption, index) in btnOptions" :key="index" :color="btnOption[0]" :size="btnOption[1]">
                        <span class="capitalize">
                            {{ btnOption[0] }}
                        </span>
                    </v-button>
                </div>
            </v-panel>

            <v-panel>
                <template v-slot:header>
                    Rounded Buttons
                </template>

                <div class="grid grid-cols-[auto_auto_auto] justify-items-center items-center gap-x-2 gap-y-4 pb-1">
                    <div v-for="(size, index) in ['Small', 'Regular', 'Large']" :key="index">
                        {{ size }}
                    </div>

                    <v-button v-for="(btnOption, index) in btnOptions" :key="index" :color="btnOption[0]" :size="btnOption[1]" :round="true">
                        <span class="capitalize">
                            {{ btnOption[0] }}
                        </span>
                    </v-button>
                </div>
            </v-panel>

            <v-panel>
                <template v-slot:header>
                    Outlined Buttons
                </template>

                <div class="grid grid-cols-[auto_auto_auto] justify-items-center items-center gap-x-2 gap-y-4 pb-1">
                    <div v-for="(size, index) in ['Small', 'Regular', 'Large']" :key="index">
                        {{ size }}
                    </div>

                    <v-button v-for="(btnOption, index) in btnOptions" :key="index" :color="btnOption[0]" :size="btnOption[1]" :outline="true">
                        <span class="capitalize">
                            {{ btnOption[0] }}
                        </span>
                    </v-button>
                </div>
            </v-panel>

            <v-panel>
                <template v-slot:header>
                    Rounded Outlined Buttons
                </template>

                <div class="grid grid-cols-[auto_auto_auto] justify-items-center items-center gap-x-2 gap-y-4 pb-1">
                    <div v-for="(size, index) in ['Small', 'Regular', 'Large']" :key="index">
                        {{ size }}
                    </div>

                    <v-button v-for="(btnOption, index) in btnOptions" :key="index" :color="btnOption[0]" :size="btnOption[1]" :round="true" :outline="true">
                        <span class="capitalize">
                            {{ btnOption[0] }}
                        </span>
                    </v-button>
                </div>
            </v-panel>
        </div>

        <div class="font-black text-2xl sm:text-3xl text-primary text-center">
            Panel
            <i class="fa-solid fa-caret-right mx-1"></i>
            Border Colors
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <v-panel v-for="(color, index) in colors" :key="index" :class="`border-4 border-${color}`">
                {{ lorem(1, 0) }}
            </v-panel>

            <v-panel v-for="(color, index) in colors" :key="index" :class="`border-4 border-${color} text-${color}`">
                {{ lorem(1, 0) }}
            </v-panel>
        </div>

        <div class="font-black text-2xl sm:text-3xl text-primary text-center">
            Components
            <i class="fa-solid fa-caret-right mx-1"></i>
            Modal Dialogs
        </div>

        <div v-for="icon in [null, 'info', 'question', 'loading', 'success', 'warning', 'error', 'fa-solid fa-bug text-primary']" class="inline-grid grid-cols-[1fr_auto] items-center gap-4 w-full max-w-md mx-auto">
            <div>
                Modal dialog example with
                {{ icon ? (icon.includes('bug') ? 'custom' : icon) : 'no' }} icon:
            </div>

            <v-button @click="modalIcon = icon; showModal = true;">
                Show Dialog
            </v-button>
        </div>

        <v-modal :show="showModal" size="md" :icon="modalIcon" @close="showModal = false">
            <template v-slot:header>
                Example Modal Dialog
            </template>

            {{ lorem(5, 0) }}

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

        <div class="font-black text-2xl sm:text-3xl text-primary text-center">
            Components
            <i class="fa-solid fa-caret-right mx-1"></i>
            Alerts
        </div>

        <div class="grid grid-cols-1 gap-4 w-full max-w-2xl mx-auto">
            <v-alert v-for="(color, index) in colors" :key="index" :color="color">
                Example {{ color }} alert<span class="hidden sm:inline">: {{ lorem(1) }}</span>
            </v-alert>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            tableRows: Array,
        },
        computed: {
            dropdownOptions() {
                let dropdownOptions = {
                    basic: [],
                    complex: [
                        {
                            type: 'action',
                            label: 'My Locale',
                            checked: this.dropdownOptionSelected['complex'] === 'Locale',
                            click: () => this.dropdownOptionSelected['complex'] = 'Locale',
                        },
                        {
                            type: 'group',
                            label: 'North America',
                            options: [
                                {
                                    type: 'action',
                                    icon: 'fa-solid fa-dollar-sign',
                                    label: 'USD',
                                    checked: this.dropdownOptionSelected['complex'] === 'USD',
                                    click: () => this.dropdownOptionSelected['complex'] = 'USD',
                                },
                                {
                                    type: 'action',
                                    icon: 'fa-solid fa-peso-sign',
                                    label: 'Peso',
                                    checked: this.dropdownOptionSelected['complex'] === 'Peso',
                                    click: () => this.dropdownOptionSelected['complex'] = 'Peso',
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
                                    checked: this.dropdownOptionSelected['complex'] === 'Euro',
                                    click: () => this.dropdownOptionSelected['complex'] = 'Euro',
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
                                    checked: this.dropdownOptionSelected['complex'] === 'Yen',
                                    click: () => this.dropdownOptionSelected['complex'] = 'Yen',
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
                                    checked: this.dropdownOptionSelected['complex'] === 'Bitcoin',
                                    click: () => this.dropdownOptionSelected['complex'] = 'Bitcoin',
                                },
                            ],
                        },
                    ],
                };

                ['English', 'Spanish', 'Italian', 'French', 'German', 'Japanese'].forEach(
                    (language) => dropdownOptions.basic.push({
                        type: 'action',
                        label: language,
                        checked: this.dropdownOptionSelected['basic'] === language,
                        click: () => this.dropdownOptionSelected['basic'] = language,
                    })
                );

                return dropdownOptions;
            },
            fontWeights() {
                return [
                    'font-thin',
                    'font-normal',
                    'font-medium',
                    'font-bold',
                    'font-black',
                ];
            },
            fontSizes() {
                return [
                    'text-xs',
                    'text-sm',
                    'text-base',
                    'text-lg',
                    'text-xl',
                    'text-2xl',
                    'text-3xl',
                ];
            },
            btnOptions() {
                let btnOptions = [];

                this.colors.forEach(
                    (color) => ['small', 'regular', 'large'].forEach(
                        (size) => btnOptions.push([color, size])
                    )
                );

                return btnOptions;
            },
            colors() {
                return [
                    'default',
                    'primary',
                    'info',
                    'success',
                    'warning',
                    'error',
                ];
            },
            colorPickerClass() {
                return `bg-[hsl(${this.colorPicker.hue},${this.colorPicker.saturation}%,${this.colorPicker.lightness}%)]`;
            },
            selectOptions() {
                return [
                    {
                        // Not Required: Empty Option
                    },
                    {
                        value: 1,
                        label: 'Option One',
                    },
                    {
                        value: 2,
                        label: 'Another Option',
                    },
                    {
                        value: 3,
                        label: 'Option C',
                    },
                ];
            },
            tableColumns() {
                return [
                    {
                        id:    'id',
                        label: 'ID',
                        fixed: true,
                    },
                    {
                        id:    'full_name',
                        label: 'Full Name',
                        data:  (row) => `${row.first_name} ${row.last_name}`,
                    },
                    {
                        id:    'email',
                        label: 'Email',
                    },
                    {
                        id:    'actions',
                        slot:  true,
                        fixed: true,
                    },
                ];
            },
        },
        data() {
            return {
                checkbox: true,
                radio: 'four',
                showModal: false,
                modalIcon: null,
                colorPicker: {
                    hue: 0,
                    saturation: 100,
                    lightness: 50,
                },
                dropdownOptionSelected: {
                    basic: 'English',
                    complex: 'USD',
                },
            };
        },
        methods: {
            lorem(lines = 2, start = 0) {
                let fullText = [
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    'Dictum non consectetur a erat.',
                    'Purus semper eget duis at tellus at urna condimentum.',
                    'Gravida neque convallis a cras semper auctor neque vitae.',
                    'Urna et pharetra pharetra massa massa ultricies.',
                    'Commodo sed egestas egestas fringilla phasellus.',
                    'Amet mauris commodo quis imperdiet massa tincidunt.',
                    'Neque volutpat ac tincidunt vitae semper quis.',
                    'Ipsum dolor sit amet consectetur adipiscing elit pellentesque habitant.',
                    'Vulputate odio ut enim blandit.',
                    'Gravida cum sociis natoque penatibus et magnis dis.',
                    'Et tortor at risus viverra adipiscing at in tellus integer.',
                    'Nibh tortor id aliquet lectus proin.',
                    'Nulla malesuada pellentesque elit eget gravida.',
                    'Pellentesque dignissim enim sit amet venenatis urna cursus eget nunc.',
                ];

                if (lines > 0) {
                    fullText = fullText.slice(start, lines + start);
                }

                return fullText.join(' ');
            },
        },
    };
</script>
