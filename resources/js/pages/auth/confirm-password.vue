<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-panel class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Confirmation
                    </div>
                </template>

                <v-form-group class="mt-6 mb-8">
                    <template v-slot:label>
                        Confirm your password:
                    </template>

                    <v-input type="password" v-model="form.password" :validation="form.errors.password ? false : null" @input="form.clearErrors()" placeholder="Confirm password..." required autofocus/>

                    <template v-slot:error>
                        {{ form.errors.password }}
                    </template>
                </v-form-group>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Confirm Password
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
                    password: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('password.confirm'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
