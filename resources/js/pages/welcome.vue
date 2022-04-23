<template>
    <div class="flex h-screen">
        <div class="m-auto text-center">
            <div class="mb-8 font-black text-5xl text-info">
                Laravel
                <i class="fa-solid fa-fire-burner block sm:inline mx-0 sm:mx-2 my-3 sm:my-0 text-accent"></i>
                Boilerplate
            </div>

            <div class="mb-12">
                <v-link :href="route('theme')" :native="true" :styled="false" target="_blank">
                    <span class="font-black text-2xl align-middle">
                        Theme Demo
                    </span>

                    <i class="fa-solid fa-caret-right fa-2x align-middle"></i>
                </v-link>
            </div>

            <div class="inline-flex flex-row flex-wrap gap-4 sm:gap-5">
                <v-link v-for="(link, index) in links" :key="index" :href="link.href" :native="true" target="_blank" class="basis-full sm:basis-auto">
                    {{ link.name }}
                </v-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            links() {
                return [
                    {
                        name: 'Laravel 9.x',
                        href: 'https://laravel.com',
                    },
                    {
                        name: 'Inertia',
                        href: 'https://inertiajs.com',
                    },
                    {
                        name: 'Vue 3',
                        href: 'https://v3.vuejs.org',
                    },
                    {
                        name: 'Tailwind CSS 3',
                        href: 'https://tailwindcss.com',
                    },
                    {
                        name: 'Font Awesome 6',
                        href: 'https://fontawesome.com',
                    },
                ];
            },
        },
    };
</script>
