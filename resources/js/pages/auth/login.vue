<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card :box="true" class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Application Login
                    </div>
                </template>

                <v-alert v-if="form.errors.email" color="error" class="mb-8">
                    {{ form.errors.email }}
                </v-alert>

                <div class="my-4">
                    <v-label>
                        Email Address
                    </v-label>

                    <v-input type="email" v-model="form.email" @input="form.clearErrors()" placeholder="Enter email address..." required autofocus/>
                </div>

                <div class="mb-6">
                    <v-label>
                        Password
                    </v-label>

                    <v-input type="password" v-model="form.password" @input="form.clearErrors()" placeholder="Enter password..." required/>
                </div>

                <div class="mb-8">
                    <v-checkbox v-model="form.remember" class="text-center">
                        Remember Me
                    </v-checkbox>
                </div>

                <div class="mb-4 text-center">
                    <div class="inline-grid grid-cols-2 gap-4 mb-4">
                        <v-button type="submit" color="primary" class="w-full" :disabled="form.processing">
                            Authenticate
                        </v-button>

                        <v-link :href="route('register')">
                            <v-button type="button" color="success" class="w-full">
                                Create Account
                            </v-button>
                        </v-link>
                    </div>

                    <div class="text-sm">
                        <v-link :href="route('forgot-password')">
                            Forgot Your Password?
                        </v-link>
                    </div>
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
                    email: null,
                    password: null,
                    remember: false,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('login'), {
                            onFinish: () => this.form.reset('password'),
                        }
                    );
            },
        },
    };
</script>
