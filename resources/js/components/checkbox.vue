<template>
    <label class="flex flex-row items-center">
        <input type="checkbox" class="h-4 w-4 mr-2 appearance-none border border-input rounded-sm shadow-sm bg-input focus:outline-none focus:border-input-focus focus:ring-2 focus:ring-input disabled:bg-input-disabled" :value="modelValue" v-model="proxyChecked" :disabled="disabled"/>

        <i v-if="modelValue" class="absolute ml-0.5 mb-0.5 fas fa-check text-input" :class="disabled ? 'text-input-disabled' : null"></i>

        <span class="font-medium text-sm">
            {{ label }}
        </span>
    </label>
</template>

<script>
    export default {
        props: {
            modelValue: {
                type: Boolean,
                default: false,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
            label: String,
        },
        emits: [
            'update:modelValue',
        ],
        computed: {
            proxyChecked: {
                get() {
                    return this.modelValue;
                },
                set(val) {
                    this.$emit('update:modelValue', val);
                },
            },
        },
    };
</script>
