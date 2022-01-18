<template>
    <div class="flex h-screen">
        <div class="m-auto text-center">
            <div class="mb-8 text-5xl">
                Laravel
                <i class="fas fa-fw fa-cubes"></i>
                Boilerplate 8
            </div>

            <div>
                <a class="text-link" href="https://inertiajs.com" target="_blank">
                    Inertia
                </a>

                +

                <a class="text-link" href="https://v3.vuejs.org" target="_blank">
                    Vue 3
                </a>

                <span class="mx-2 font-bold">
                    &bull;
                </span>

                <a class="text-link" href="https://tailwindcss.com" target="_blank">
                    Tailwind CSS 3
                </a>

                <span class="mx-2 font-bold">
                    &bull;
                </span>

                <a class="text-link" href="https://fontawesome.com" target="_blank">
                    Font Awesome 5
                </a>
            </div>

            <div class="mt-8">
                <div v-if="myself">
                    You are logged in as

                    <span class="font-bold">
                        {{ myself.first_name }} {{ myself.last_name }}
                    </span>

                    <br/>

                    To log out of the application

                    <v-link :href="route('logout')">
                        click here
                    </v-link>
                </div>

                <div v-else>
                    To log into the application

                    <v-link :href="route('login')">
                        click here
                    </v-link>
                </div>
            </div>
        </div>
    </div>
</template>
