<template>
    <div>
        <label class="inline-flex flex-row items-center cursor-pointer">
            <input type="checkbox" class="h-5 w-5 mr-2 appearance-none border border-input-normal rounded bg-input-normal cursor-pointer focus:outline-none focus:border-input-focused focus:ring focus:ring-input disabled:bg-input-disabled" v-model="proxyChecked" :disabled="disabled"/>

            <span v-if="modelValue" class="absolute ml-0.5 mb-2 text-3xl" :class="{ 'text-input-normal': !disabled, 'text-input-disabled': disabled }">
                &check;
            </span>

            <span class="font-default font-medium text-base text-default">
                {{ label }}
            </span>
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
            modelValue: {
                type: Boolean,
                default: false,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
        },
        emits: [
            'update:modelValue',
        ],
        computed: {
            proxyChecked: {
                get() {
                    return this.modelValue;
                },
                set(value) {
                    this.$emit('update:modelValue', value);
                },
            },
        },
    };
</script>
