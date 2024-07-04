<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth.js";
import useForm from "@/composables/form.js";
import { required } from "@vuelidate/validators";

const showPassword = ref(false),
    showPassword1 = ref(false),
    authStore = useAuthStore(),
    {
        isLoading,
        state,
        fieldError,
        prepareRequest,
        rules,
        v$,
        initialState,
        errors,
    } = useForm({
        initialState: {
            first_name: null,
            last_name: null,
            email: null,
            password: null,
            password_confirmation: null,
        },
        rules: {
            first_name: { required },
            last_name: { required },
            email: { required },
            password: { required },
            password_confirmation: { required },
        },
    }),
    onSubmit = async () => {
        errors.value = {};
        const result = await v$.value.$validate();

        if (!result) {
            return;
        }
        await prepareRequest(() => authStore.register(state.value));
    };
</script>

<template>
    <div class="login-right-wrap">
        <div class="account-logo">
            <router-link to="dashboard"
                ><img src="@/assets/img/login-logo.png" alt=""
            /></router-link>
        </div>
        <h2>Getting Started</h2>
        <!-- form -->
        <form @submit.prevent="onSubmit">
            <div class="input-block">
                <label>First Name <span class="login-danger">*</span></label>
                <input
                    v-model="state.first_name"
                    @blur="v$.first_name.$touch"
                    class="form-control"
                    type="text"
                    :class="{ 'is-invalid': fieldError('first_name') }"
                />
                <div class="invalid-feedback">
                    {{ fieldError("first_name") }}
                </div>
                <div class="emailshow text-danger" id="email"></div>
            </div>
            <div class="input-block">
                <label>Last Name <span class="login-danger">*</span></label>
                <input
                    v-model="state.last_name"
                    @blur="v$.last_name.$touch"
                    class="form-control"
                    type="text"
                    :class="{ 'is-invalid': fieldError('last_name') }"
                />
                <div class="invalid-feedback">
                    {{ fieldError("last_name") }}
                </div>
                <div class="emailshow text-danger" id="email"></div>
            </div>
            <div class="input-block">
                <label>Email <span class="login-danger">*</span></label>
                <input
                    v-model="state.email"
                    @blur="v$.email.$touch"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': fieldError('email') }"
                />
                <div class="invalid-feedback">{{ fieldError("email") }}</div>
                <div class="emailshow text-danger" id="email"></div>
            </div>
            <div class="input-block">
                <label>Password <span class="login-danger">*</span></label>
                <input
                    v-model="state.password"
                    @blur="v$.password.$touch"
                    name="password"
                    :type="showPassword ? 'text' : 'password'"
                    class="form-control pass-input mt-2"
                    :class="{ 'is-invalid': fieldError('password') }"
                />
                <span
                    @click="showPassword = !showPassword"
                    class="toggle-password"
                >
                    <i
                        :class="{
                            'fas fa-eye': showPassword,
                            'fas fa-eye-slash': !showPassword,
                        }"
                    ></i>
                </span>
                <div class="invalid-feedback">{{ fieldError("password") }}</div>
                <div class="emailshow text-danger" id="password"></div>
            </div>
            <div class="input-block">
                <label
                    >Confirm Password <span class="login-danger">*</span></label
                >
                <input
                    v-model="state.password_confirmation"
                    @blur="v$.password_confirmation.$touch"
                    name="confirmpassword"
                    :type="showPassword1 ? 'text' : 'password'"
                    class="form-control pass-input mt-2"
                    :class="{
                        'is-invalid': fieldError('password_confirmation'),
                    }"
                />
                <span
                    @click="showPassword1 = !showPassword1"
                    class="toggle-password"
                >
                    <i
                        :class="{
                            'fas fa-eye': showPassword1,
                            'fas fa-eye-slash': !showPassword1,
                        }"
                    ></i>
                </span>
                <div class="invalid-feedback">
                    {{ fieldError("password_confirmation") }}
                </div>
                <div class="emailshow text-danger" id="confirmpassword"></div>
            </div>
            <div class="forgotpass">
                <div class="remember-me">
                    <label
                        class="custom_check mr-2 mb-0 d-inline-flex remember-me"
                    >
                        I agree to the
                        <a href="javascript:;"
                            >&nbsp;&nbsp; terms of service
                        </a>
                        &nbsp;&nbsp; and
                        <a href="javascript:;"> &nbsp;&nbsp; privacy policy </a>
                        <input type="checkbox" name="radio" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="input-block login-btn">
                <b-button
                    type="submit"
                    variant="primary me-1"
                    class="btn btn-primary btn-block"
                >
                    <span
                        v-if="isLoading"
                        class="spinner-border spinner-border-sm me-2"
                        role="status"
                    ></span>
                    Sign up
                </b-button>
            </div>
        </form>
        <!-- /form -->

        <div class="next-sign">
            <p class="account-subtitle">
                Already have account?
                <router-link :to="{ name: 'login' }">Login</router-link>
            </p>

            <!-- Social Login -->
            <div class="social-login">
                <a href="javascript:;"
                    ><img src="@/assets/img/icons/login-icon-01.svg" alt=""
                /></a>
                <a href="javascript:;"
                    ><img src="@/assets/img/icons/login-icon-02.svg" alt=""
                /></a>
                <a href="javascript:;"
                    ><img src="@/assets/img/icons/login-icon-03.svg" alt=""
                /></a>
            </div>
            <!-- /Social Login -->
        </div>
    </div>
</template>

<style scoped></style>
