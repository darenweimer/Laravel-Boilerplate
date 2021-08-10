<template>
    <div class="relative inline font-normal text-base pb-3">
        <button class="inline cursor-pointer focus:outline-none" @click="active = !active" @blur="active = false">
            <i class="fa-2x align-middle" :class="icon"></i>

            <i class="ml-2 fas fa-xl align-middle" :class="{ 'fa-caret-up': active, 'fa-caret-down': !active }"></i>
        </button>

        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-75" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-100" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-75">
            <div v-if="active" class="absolute inline right-0 top-full z-50 border border-dropdown rounded bg-dropdown-normal text-left whitespace-nowrap py-1">
                <ul>
                    <inertia-link v-for="(option, label) in options" :href="option.link" :key="label">
                        <li class="text-dropdown-normal pl-4 pr-12 py-1 hover:bg-dropdown-highlight hover:text-dropdown-highlight">
                            <i v-if="option.icon" class="mr-3 fa-fw text-xl align-middle opacity-50" :class="option.icon"></i>

                            <span class="align-middle">
                                {{ label }}
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
                required: true,
            },
            options: {
                type: Object,
                required: true,
            },
        },
        data() {
            return {
                active: false,
            };
        },
    };
</script>
