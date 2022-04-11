<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card :box="true" class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Two-Factor Authentication
                    </div>
                </template>

                <v-alert v-if="form.errors.two_factor_code" color="error" class="mb-8">
                    {{ form.errors.two_factor_code }}
                </v-alert>

                <div class="mt-4 mb-8">
                    <v-label class="mb-2 text-center">
                        Enter your authenticator code:
                    </v-label>

                    <v-input type="text" v-model="form.two_factor_code" class="w-48 mx-auto text-2xl text-center tracking-[0.5rem]" @input="form.clearErrors()" required autofocus/>
                </div>

                <div class="mb-4 text-center">
                    <v-button type="submit" color="primary" :disabled="form.processing">
                        Authenticate
                    </v-button>
                </div>
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
                        this.route('verify-2fa'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
