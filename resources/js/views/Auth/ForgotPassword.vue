<script setup></script>

<template>
  <div class="login-right-wrap">
    <div class="account-logo">
      <router-link to="dashboard"><img src="@/assets/img/login-logo.png" alt="" /></router-link>
    </div>
    <h2>Reset Password</h2>
    <!-- form -->
    <form>
      <div class="input-block">
        <label>Email <span class="login-danger">*</span></label>
        <input class="form-control" type="text" />
      </div>
      <div class="input-block login-btn">
        <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
      </div>
    </form>
    <!-- /form -->

    <div class="next-sign">
      <p class="account-subtitle">
        Need an account?
        <router-link :to="{ name: 'login' }">Login</router-link>
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
