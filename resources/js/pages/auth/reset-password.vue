<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-panel class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Reset
                    </div>
                </template>

                <v-alert v-if="form.errors.email" color="error">
                    {{ form.errors.email }}
                </v-alert>

                <v-form-group class="mt-6">
                    <template v-slot:label>
                        New Password
                    </template>

                    <v-input type="password" v-model="form.password" :validation="form.errors.password ? false : null" @input="form.clearErrors()" placeholder="Enter password..." required autofocus/>

                    <template v-slot:error>
                        {{ form.errors.password }}
                    </template>
                </v-form-group>

                <v-form-group class="mt-6 mb-8">
                    <template v-slot:label>
                        Confirm Password
                    </template>

                    <v-input type="password" v-model="form.password_confirmation" :validation="form.errors.password_confirmation ? false : null" @input="form.clearErrors()" placeholder="Confirm password..." required/>

                    <template v-slot:error>
                        {{ form.errors.password_confirmation }}
                    </template>
                </v-form-group>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Reset Password
                        </v-button>
                    </div>
                </template>
            </v-panel>
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
