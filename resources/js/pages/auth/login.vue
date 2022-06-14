<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-panel class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Application Login
                    </div>
                </template>

                <v-form-group class="mt-6">
                    <template v-slot:label>
                        Email Address
                    </template>

                    <v-input type="email" v-model="form.email" :validation="form.errors.email ? false : null" @input="form.clearErrors()" placeholder="Enter email address..." required autofocus/>

                    <template v-slot:error>
                        {{ form.errors.email }}
                    </template>
                </v-form-group>

                <v-form-group class="mt-4">
                    <template v-slot:label>
                        Password
                    </template>

                    <v-input type="password" v-model="form.password" @input="form.clearErrors()" placeholder="Enter password..." required/>
                </v-form-group>

                <div class="my-6 text-center">
                    <v-checkbox v-model="form.remember">
                        Remember Me
                    </v-checkbox>
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <div class="inline-grid grid-cols-2 gap-4">
                            <v-button type="submit" color="primary" class="w-full" :disabled="form.processing">
                                Authenticate
                            </v-button>

                            <v-link :href="route('register')">
                                <v-button type="button" color="success" class="w-full">
                                    Create Account
                                </v-button>
                            </v-link>
                        </div>

                        <div class="mt-3 mb-1">
                            <v-link :href="route('forgot-password')" class="text-sm">
                                Forgot Your Password?
                            </v-link>
                        </div>
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
