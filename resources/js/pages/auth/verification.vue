<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-panel class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Verification Required
                    </div>
                </template>

                <v-alert v-if="status" color="success">
                    {{ status }}
                </v-alert>

                <div class="mt-6 mb-8 text-justify">
                    Please verify your email address by clicking on the link we
                    emailed to you. If you didn't receive the email, we will
                    gladly send you another.
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <div class="inline-grid grid-cols-2 gap-4">
                            <v-button type="submit" color="primary" class="w-full" :disabled="form.processing">
                                Resend Email
                            </v-button>

                            <v-link :href="route('logout')">
                                <v-button type="button" color="error" class="w-full">
                                    Logout
                                </v-button>
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
                form: this.useForm(),
            };
        },
        methods: {
            submit() {
                this.form.post(
                    this.route('verification.send')
                );
            },
        },
    };
</script>
