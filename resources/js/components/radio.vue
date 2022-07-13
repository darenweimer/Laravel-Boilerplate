<template>
    <label class="inline-flex flex-row gap-2.5 items-center font-default font-normal text-base text-default tracking-wide cursor-pointer">
        <div class="relative inline-flex flex-row items-center">
            <input type="radio" :value="value" v-model="proxyChecked" class="w-5 h-5 appearance-none focus:outline-none border border-input focus:border-input-focused disabled:border-input-disabled rounded-full bg-transparent disabled:bg-input-disabled cursor-pointer transition ease-linear duration-200" :disabled="disabled"/>

            <i v-if="value === modelValue" class="fa-solid fa-circle absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 text-[0.6rem]" :class="{ 'text-input': !disabled, 'text-input-disabled': disabled }"></i>
        </div>

        <slot>
        </slot>
    </label>
</template>

<script>
    export default {
        props: {
            value: {
                required: true,
            },
            modelValue: {
                default: null,
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
