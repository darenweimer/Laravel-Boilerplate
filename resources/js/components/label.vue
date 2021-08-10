<template>
    <div v-if="label || success || error">
        <label v-if="label" class="block w-full font-medium text-base text-default" :class="{ 'mt-1': below, 'mb-1': !below }">
            {{ label }}
        </label>

        <label v-if="success" class="block w-full font-medium text-sm text-success" :class="{ 'mt-1': below, 'mb-1': !below }">
            {{ success }}
        </label>

        <label v-if="error" class="block w-full font-medium text-sm text-danger" :class="{ 'mt-1': below, 'mb-1': !below }">
            {{ error }}
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                default: null,
            },
            success: {
                type: String,
                default: null,
            },
            error: {
                type: String,
                default: null,
            },
            below: {
                type: Boolean,
                default: false,
            },
        },
    };
</script>
