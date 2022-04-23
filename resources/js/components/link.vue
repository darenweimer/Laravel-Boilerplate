<template>
    <component :is="native ? 'a' : 'inertia-link'" class="focus:outline-none" :class="{ 'inline-block underline underline-offset-4 hover:underline-offset-[3px] decoration-1 hover:decoration-2 decoration-link hover:decoration-link-hover': styled }">
        <slot>
        </slot>
    </component>
</template>

<script>
    export default {
        props: {
            native: {
                type: Boolean,
                default: false,
            },
            styled: {
                type: Boolean,
                default: true,
            },
        },
    };
</script>
