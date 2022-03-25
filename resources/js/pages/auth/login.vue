<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Application Login
                    </div>
                </template>

                <div class="mt-4">
                    <v-label label="Email Address"/>
                    <v-input type="email" v-model="form.email" :invalid="form.errors.email" @input="form.clearErrors()" placeholder="Enter email address..." required autofocus/>
                    <v-label :error="form.errors.email" :below="true"/>
                </div>

                <div class="mt-4">
                    <v-label label="Password"/>
                    <v-input type="password" v-model="form.password" :invalid="form.errors.password" @input="form.clearErrors()" placeholder="Enter password..." required/>
                    <v-label :error="form.errors.password" :below="true"/>
                </div>

                <div class="mt-6">
                    <v-checkbox label="Remember Me" class="text-center" v-model="form.remember"/>
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <div class="inline-grid grid-cols-2 gap-2">
                            <v-button type="submit" class="w-full" color="primary" :disabled="form.processing">
                                Authenticate
                            </v-button>

                            <v-link :href="route('register')">
                                <v-button type="button" class="w-full" color="success">
                                    Create Account
                                </v-button>
                            </v-link>
                        </div>

                        <div class="mt-4 text-sm">
                            <v-link :href="route('forgot-password')">
                                Forgot Your Password?
                            </v-link>
                        </div>
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
