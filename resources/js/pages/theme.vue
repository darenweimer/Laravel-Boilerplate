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
</template>

<script>
    export default {
        computed: {
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
        },
        data() {
            return {
                dropdownSelected: {
                    basic: 'English',
                    complex: 'USD',
                },
            };
        },
    };
</script>
