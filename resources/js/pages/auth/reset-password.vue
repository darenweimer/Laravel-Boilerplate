<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card :box="true" class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Reset
                    </div>
                </template>

                <v-alert v-if="form.errors.password" color="error" class="mb-8">
                    {{ form.errors.password }}
                </v-alert>

                <v-alert v-if="form.errors.password_confirmation" color="error" class="mb-8">
                    {{ form.errors.password_confirmation }}
                </v-alert>

                <div class="my-4">
                    <v-label>
                        New Password
                    </v-label>

                    <v-input type="password" v-model="form.password" @input="form.clearErrors()" placeholder="Enter password..." required autofocus/>
                </div>

                <div class="mb-8">
                    <v-label>
                        Confirm Password
                    </v-label>

                    <v-input type="password" v-model="form.password_confirmation" @input="form.clearErrors()" placeholder="Confirm password..." required/>
                </div>

                <div class="mb-4 text-center">
                    <v-button type="submit" color="primary" :disabled="form.processing">
                        Reset Password
                    </v-button>
                </div>
            </v-card>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            token: String,
            email: String,
        },
        data() {
            return {
                form: this.useForm({
                    token: this.token,
                    email: this.email,
                    password: null,
                    password_confirmation: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('reset-password'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
