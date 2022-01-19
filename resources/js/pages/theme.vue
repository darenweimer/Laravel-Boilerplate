<template>
    <div class="w-full max-w-2xl mx-auto p-8">
        <!-- Text Components -->

        <p class="font-title text-3xl">
            This is an example of a title.
        </p>

        <p class="mt-4">
            This is an example of the normal font on the normal background.
        </p>

        <p class="mt-2 text-success">
            This is an example of success text on the normal background.
        </p>

        <p class="mt-2 text-error">
            This is an example of error text on the normal background.
        </p>

        <p v-for="thickness in ['thin', 'normal', 'medium', 'bold', 'black']" :class="`mt-2 font-${thickness}`">
            This is an example of {{ thickness }} text.
        </p>

        <!-- Link Components -->

        <p class="mt-16">
            This is an example of a

            <inertia-link href="#">
                clickable text link
            </inertia-link>

            using the inertia-link component.
        </p>

        <p class="mt-2">
            This is an example of a

            <v-link href="#">
                clickable text link
            </v-link>

            using the v-link component.
        </p>

        <!-- Alert Components -->

        <div class="mt-16">
            <v-alert v-for="(color, label) in colors" :color="color" class="mt-4">
                This is an example of a {{ label }} alert.
            </v-alert>
        </div>

        <!-- Button Components -->

        <div class="mt-16">
            <p v-for="(color, label) in colors" class="mt-4">
                This is an example of a

                <v-button :color="color" class="mx-1">
                    {{ label }}
                </v-button>

                <v-button :color="color" :disabled="true" class="mx-1">
                    Disabled
                </v-button>

                button.
            </p>
        </div>

        <!-- Form Field Components -->

        <div class="mt-16">
            <v-label label="Example Text Input" class="mt-4"/>
            <v-input placeholder="This is an example text input..."/>

            <v-label label="Example Disabled Text Input" class="mt-4"/>
            <v-input placeholder="This is an example disabled text input..." :disabled="true"/>

            <v-label label="Example Number Input" class="mt-4"/>
            <v-input type="number" placeholder="This is an example number input..."/>

            <v-label label="Example Date Input" class="mt-4"/>
            <v-input type="date" placeholder="This is an example date input..."/>

            <v-label label="Example Time Input" class="mt-4"/>
            <v-input type="time" placeholder="This is an example time input..."/>

            <v-label label="Example Select" class="mt-4"/>
            <v-select :options="selectOptions" placeholder="This is an example select..."/>

            <v-label label="Example Label" class="mt-4"/>
            <v-input placeholder="This is an example text input..."/>
            <v-label success="This is an example success label" :below="true"/>

            <v-label label="Example Label" class="mt-4"/>
            <v-input :invalid="true" value="This is an example invalid input value" placeholder="This is an example text input..."/>
            <v-label error="This is an example error label" :below="true"/>
        </div>

        <div class="mt-16">
            <v-checkbox label="This is an example checkbox" class="mt-4 text-center" v-model="checkbox"/>
            <v-checkbox label="This is an example disabled checkbox" class="mt-4 text-center" v-model="checkbox" :disabled="true"/>
        </div>

        <!-- Dropdown Menu Component -->

        <div class="mt-16">
            <p class="mt-4">
                This is an example dropdown menu:

                <v-dropdown :options="dropdownOptions" class="ml-2 border border-dropdown rounded px-1.5 py-2" @state="(active) => $page.props.dropdownActive = active">
                    <i class="fas fa-bars fa-2x align-middle"></i>
                    <i class="ml-2 fas align-middle" :class="{ 'fa-caret-up': !$page.props.dropdownActive, 'fa-caret-down': $page.props.dropdownActive }"></i>
                </v-dropdown>
            </p>
        </div>

        <!-- Modal Components -->

        <div class="mt-16">
            <p v-for="(color, label) in colors" class="mt-2">
                <v-modal :show="showModal[color]" :color="color" @close="showModal[color] = false">
                    <template v-slot:header>
                        {{ label }} Modal Dialog
                    </template>

                    This is an example of a {{ label }} modal dialog.

                    <template v-slot:footer>
                        <div class="text-center">
                            <v-button color="success" class="mx-1">
                                Yes
                            </v-button>

                            <v-button color="error" class="mx-1">
                                No
                            </v-button>

                            <v-button color="default" class="mx-1">
                                Cancel
                            </v-button>
                        </div>
                    </template>
                </v-modal>

                This is an example of a

                <button class="text-link focus:outline-none" @click="showModal[color] = true">
                    {{ label }}
                </button>

                modal dialog.
            </p>
        </div>

        <!-- Card Components -->

        <div class="mt-16">
            <v-card v-for="(color, label) in colors" :color="color" class="mt-4">
                <template v-slot:header>
                    This is an example {{ label }} card
                </template>

                <p class="text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                    non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>

                <v-label label="Example Text Input" class="mt-4"/>
                <v-input class="mb-2" placeholder="This is an example text input..."/>

                <template v-slot:footer>
                    <v-button v-for="(color2, label2) in colors" :color="color2" class="mr-2">
                        {{ label2 }}
                    </v-button>
                </template>
            </v-card>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            colors() {
                return {
                    Primary: 'primary',
                    Secondary: 'secondary',
                    Success: 'success',
                    Warning: 'warning',
                    Error: 'error',
                    Default: 'default',
                };
            },
            selectOptions() {
                return [
                    {
                        'id': 'option1',
                        'text': 'Option 1',
                    },
                    {
                        'id': 'option2',
                        'text': 'Option 2',
                    },
                    {
                        'id': 'option3',
                        'text': 'Option 3',
                    },
                ];
            },
            dropdownOptions() {
                return {
                    'Option 1': {
                        icon: 'fas fa-home',
                        link: '#option1',
                    },
                    'Option 2': {
                        icon: 'fas fa-chart-pie',
                        link: '#option2',
                    },
                    'Option 3': {
                        icon: 'fas fa-user',
                        link: '#option3',
                    },
                    'Option 4': {
                        icon: 'fas fa-envelope-open-text',
                        link: '#option4',
                    },
                    'Option 5': {
                        icon: 'fas fa-door-open',
                        link: '#option5',
                    },
                };
            },
        },
        data() {
            return {
                checkbox: true,
                showModal: {
                    primary: false,
                    secondary: false,
                    success: false,
                    warning: false,
                    error: false,
                    default: false,
                },
            };
        },
    };
</script>
