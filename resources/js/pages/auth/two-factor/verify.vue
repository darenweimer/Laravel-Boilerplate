<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Two-Factor Authentication
                    </div>
                </template>

                <div class="w-32 mx-auto my-4">
                    <v-input type="text" class="text-center" v-model="form.two_factor_code" :invalid="form.errors.two_factor_code" @input="form.clearErrors('two_factor_code')" required autofocus/>
                </div>

                <v-label class="text-center" :error="form.errors.two_factor_code"/>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Submit Code
                        </v-button>
                    </div>
                </template>
            </v-card>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: this.useForm({
                    two_factor_code: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('two-factor.verify'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
