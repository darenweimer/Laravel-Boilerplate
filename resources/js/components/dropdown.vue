<template>
    <div class="relative inline font-normal text-base pb-3">
        <button class="inline cursor-pointer focus:outline-none" @click="menuActive = !menuActive" @blur="menuActive = false">
            <i class="fa-2x align-middle" :class="icon"/>

            <i class="ml-2 fas fa-xl align-middle" :class="menuActive ? 'fa-caret-up' : 'fa-caret-down'"/>
        </button>

        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-75" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-100" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-75">
            <div v-if="menuActive" class="absolute inline right-0 top-full z-50 border border-dropdown rounded bg-dropdown text-left whitespace-nowrap py-1">
                <ul>
                    <inertia-link v-for="(item, text) in menu" :href="item.link" :key="text">
                        <li class="text-dropdown pl-4 pr-12 py-1 hover:bg-dropdown-highlight hover:text-dropdown-highlight">
                            <i v-if="item.icon" class="mr-3 fa-fw text-xl align-middle opacity-50" :class="item.icon"/>

                            <span class="align-middle">
                                {{ text }}
                            </span>
                        </li>
                    </inertia-link>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: {
            icon: {
                type: String,
                default: null,
            },
            menu: {
                type: Object,
                required: true,
            },
        },
        data() {
            return {
                menuActive: false,
            };
        },
    };
</script>
