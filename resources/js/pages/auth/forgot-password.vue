<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card :box="true" class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Reset Request
                    </div>
                </template>

                <v-alert v-if="status" color="success" class="mb-8">
                    {{ status }}
                </v-alert>

                <v-alert v-if="form.errors.email" color="error" class="mb-8">
                    {{ form.errors.email }}
                </v-alert>

                <div class="mt-4 mb-8">
                    <v-label class="mb-2 text-center">
                        Confirm your email address:
                    </v-label>

                    <v-input type="email" v-model="form.email" @input="form.clearErrors()" placeholder="Enter email address..." required autofocus/>
                </div>

                <div class="mb-4 text-center">
                    <v-button type="submit" color="primary" :disabled="form.processing">
                        Email Password Reset Link
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
                    email: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('forgot-password')
                    );
            },
        },
    };
</script>
