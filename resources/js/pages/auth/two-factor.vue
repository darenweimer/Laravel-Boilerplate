<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-panel class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Two-Factor Authentication
                    </div>
                </template>

                <v-form-group class="w-64 mx-auto mt-6 mb-8">
                    <template v-slot:label>
                        <div class="text-center">
                            Enter your authenticator code:
                        </div>
                    </template>

                    <v-input type="text" v-model="form.two_factor_code" :validation="form.errors.two_factor_code ? false : null" class="text-2xl tracking-[0.5rem] text-center" @input="form.clearErrors()" required autofocus/>

                    <template v-slot:error>
                        {{ form.errors.two_factor_code }}
                    </template>
                </v-form-group>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Authenticate
                        </v-button>
                    </div>
                </template>
            </v-panel>
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
