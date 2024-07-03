<template>
  <div class="error-pages">
    <div class="main-wrapper error-wrapper">
      <div class="error-box">
        <img class="img-fluid" src="@/assets/img/error-01.png" alt="Logo" />
        <h3>
          <img class="img-fluid mb-0" src="@/assets/img/icons/danger.svg" alt="Logo" />
          Service Unavailable
        </h3>
        <p>You may have mistyped the address or the page may have moved.</p>
        <router-link to="dashboard" class="btn btn-primary go-home"
          >Back to Home</router-link
        >
      </div>
    </div>
  </div>
</template>
