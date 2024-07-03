<script setup>
import VueAvatar from "@webzlodimir/vue-avatar";
defineProps({user: Object})
</script>

<template>
  <vue-avatar
      :size="40"
      :img-src="user.avatar"
      :username="user.name"
  />
</template>

<style>
.vue-avatar[data-v-ae9e4b12] {
  margin-right: 6px;
}
</style>