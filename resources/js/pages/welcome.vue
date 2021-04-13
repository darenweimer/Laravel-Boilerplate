<template>
    <div class="flex h-screen">
        <div class="m-auto text-center">
            <div class="mb-8 text-5xl">
                Laravel
                <i class="fas fa-fw fa-cubes"></i>
                Boilerplate 8
            </div>

            <div>
                Inertia + Vue3

                <span class="mx-2 font-bold">
                    &bull;
                </span>

                Tailwind CSS 2

                <span class="mx-2 font-bold">
                    &bull;
                </span>

                Font Awesome 5
            </div>

            <div v-if="user" class="mt-8">
                You are logged in as

                <span class="font-bold">
                    {{ user.name }}
                </span>

                <br/>

                To log out of the application

                <v-link :href="route('logout')">
                    click here
                </v-link>
            </div>
        </div>
    </div>
</template>
