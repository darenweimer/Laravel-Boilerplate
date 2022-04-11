<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card :box="true" class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Account Registration
                    </div>
                </template>

                <div class="my-4">
                    <v-label>
                        First Name
                    </v-label>

                    <v-input type="text" v-model="form.first_name" @input="form.clearErrors('first_name')" placeholder="Enter first name..." required autofocus/>

                    <v-label :enabled="form.errors.first_name" :footnote="true" :valid="false">
                        {{ form.errors.first_name }}
                    </v-label>
                </div>

                <div class="mb-4">
                    <v-label>
                        Last Name
                    </v-label>

                    <v-input type="text" v-model="form.last_name" @input="form.clearErrors('last_name')" placeholder="Enter last name..." required/>

                    <v-label :enabled="form.errors.last_name" :footnote="true" :valid="false">
                        {{ form.errors.last_name }}
                    </v-label>
                </div>

                <div class="mb-4">
                    <v-label>
                        Email Address
                    </v-label>

                    <v-input type="email" v-model="form.email" @input="form.clearErrors('email')" placeholder="Enter email address..." required/>

                    <v-label :enabled="form.errors.email" :footnote="true" :valid="false">
                        {{ form.errors.email }}
                    </v-label>
                </div>

                <div class="mb-4">
                    <v-label>
                        Password
                    </v-label>

                    <v-input type="password" v-model="form.password" @input="form.clearErrors('password')" placeholder="Enter password..." required/>

                    <v-label :enabled="form.errors.password" :footnote="true" :valid="false">
                        {{ form.errors.password }}
                    </v-label>
                </div>

                <div class="mb-8">
                    <v-label>
                        Confirm Password
                    </v-label>

                    <v-input type="password" v-model="form.password_confirmation" @input="form.clearErrors('password_confirmation')" placeholder="Confirm password..." required/>

                    <v-label :enabled="form.errors.password_confirmation" :footnote="true" :valid="false">
                        {{ form.errors.password_confirmation }}
                    </v-label>
                </div>

                <div class="mb-4 text-center">
                    <v-button type="submit" color="primary" class="mb-4" :disabled="form.processing">
                        Create Account
                    </v-button>

                    <div class="text-sm">
                        <v-link :href="route('login')">
                            Return to Application Login
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
                    first_name: null,
                    last_name: null,
                    email: null,
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
                        this.route('register'), {
                            onFinish: () => {
                                this.form.reset('password');
                                this.form.reset('password_confirmation');
                            },
                        }
                    );
            },
        },
    };
</script>
