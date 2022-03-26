<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Verification Required
                    </div>
                </template>

                <div class="my-4 text-justify">
                    Please verify your email address by clicking on the link we
                    emailed to you. If you didn't receive the email, we will
                    gladly send you another.
                </div>

                <v-label class="text-center" :success="status"/>

                <template v-slot:footer>
                    <div class="text-center">
                        <div class="inline-grid grid-cols-2 gap-2">
                            <v-button type="submit" class="w-full" color="primary" :disabled="form.processing">
                                Resend Email
                            </v-button>

                            <v-link :href="route('logout')">
                                <v-button type="submit" class="w-full" color="error">
                                    Logout
                                </v-button>
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
