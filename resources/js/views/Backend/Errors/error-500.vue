<template>
  <body class="error-pages">
    <div class="main-wrapper error-wrapper">
      <div class="error-box">
        <img class="img-fluid" src="@/assets/img/error-02.png" alt="Logo" />
        <h3>
          <img class="img-fluid mb-0" src="@/assets/img/icons/danger.svg" alt="Logo" />
          Forbidden 403 THIS ACTION IS UNAUTHORIZED!
        </h3>
        <p>You do not have permission to view this resource</p>
        <router-link :to="{name: 'dashboard.index'}" class="btn btn-primary go-home">Go to Home</router-link>
      </div>
    </div>
  </body>
</template>
