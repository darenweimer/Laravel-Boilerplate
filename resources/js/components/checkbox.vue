<template>
    <label class="inline-flex flex-row gap-2.5 items-center font-default font-normal text-base text-default tracking-wide cursor-pointer">
        <div class="relative inline-flex flex-row items-center">
            <input type="checkbox" v-model="proxyChecked" class="w-5 h-5 appearance-none focus:outline-none border border-input focus:border-input-focused disabled:border-input-disabled rounded bg-transparent disabled:bg-input-disabled cursor-pointer transition ease-linear duration-200" :disabled="disabled"/>

            <i v-if="modelValue" class="fa-solid fa-check absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 pl-1.5 pb-0.5 text-2xl" :class="{ 'text-input': !disabled, 'text-input-disabled': disabled }"></i>
        </div>

        <slot>
        </slot>
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
