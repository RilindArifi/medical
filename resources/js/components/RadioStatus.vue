<script setup>
import {ACTIVE, INACTIVE} from "@/enums/status-global.js";
</script>

<template>
  <a-radio-group>
    <a-radio :value="ACTIVE">{{ACTIVE}}</a-radio>
    <a-radio :value="INACTIVE">{{INACTIVE}}</a-radio>
  </a-radio-group>
</template>

<style scoped>

</style>