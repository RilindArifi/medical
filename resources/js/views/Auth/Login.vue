<script setup>
import { ref } from 'vue'
import useForm from "@/composables/form.js";
import {required} from "@vuelidate/validators";
import {message} from "ant-design-vue";
import {useRouter} from "vue-router";
import {useAuthStore} from "@/stores/auth.js";
import RButton from "@/components/RButton.vue";

const
    router = useRouter(),
    showPassword = ref(false),
    authStore     = useAuthStore(),

    {isLoading, state, fieldError, prepareRequest, rules, v$, initialState, errors} = useForm({
      initialState: {
        email: null,
        password: null,
        remember: false,
      },
      rules: {
        email: {required},
        password: {required},
      }
    }),

    onSubmit = async () => {
      errors.value = {}
      const result = await v$.value.$validate();

      if(!result){
        return;
      }
      await prepareRequest(() => (authStore.login(state.value)))
    }
</script>

<template>
  <div class="login-right-wrap">
    <div class="account-logo">
      <router-link to="/dashboard"><img src="@/assets/img/login-logo.png" alt="" /></router-link>
    </div>
    <h2>Login</h2>
    <!-- form -->
    <form>
      <div class="input-block local-forms">
        <label>Email <span class="login-danger">*</span></label>
        <input
          v-model="state.email"
          @blur="v$.email.$touch"
          type="text"
          class="form-control"
          :class="{ 'is-invalid': fieldError('email') }"
        />
        <div class="invalid-feedback">{{ fieldError('email') }}</div>
      </div>
      <div class="input-block local-forms">
        <label>Password <span class="login-danger">*</span></label>
        <input
          v-model="state.password"
          @blur="v$.password.$touch"
          :type="showPassword ? 'text' : 'password'"
          class="form-control pass-input mt-2"
          :class="{ 'is-invalid': fieldError('password') }"
        />
        <span @click="showPassword = !showPassword" class="toggle-password">
          <i
            :class="{
              'fas fa-eye': showPassword,
              'fas fa-eye-slash': !showPassword
            }"
          ></i>
        </span>
        <div class="invalid-feedback">{{ fieldError('password') }}</div>
      </div>
      <div class="forgotpass">
        <div class="remember-me">
          <label class="custom_check mr-2 mb-0 d-inline-flex remember-me">
            Remember me
            <input v-model="state.remember" type="checkbox" />
            <span class="checkmark"></span>
          </label>
        </div>
        <router-link :to="{ name: 'forgot.password' }">Forgot Password?</router-link>
      </div>
      <div class="input-block login-btn">
        <r-button @click.prevent="onSubmit" text="Login" :is-loading="isLoading" class-b="btn btn-primary btn-block"/>
      </div>
    </form>
    <!-- /form -->

    <div class="next-sign">
      <p class="account-subtitle">
        Need an account? <router-link :to="{ name: 'register' }">Sign Up</router-link>
      </p>

      <!-- Social Login -->
      <div class="social-login">
        <a href="javascript:;"><img src="@/assets/img/icons/login-icon-01.svg" alt="" /></a>
        <a href="javascript:;"><img src="@/assets/img/icons/login-icon-02.svg" alt="" /></a>
        <a href="javascript:;"><img src="@/assets/img/icons/login-icon-03.svg" alt="" /></a>
      </div>
      <!-- /Social Login -->
    </div>
  </div>
</template>

<style scoped></style>
