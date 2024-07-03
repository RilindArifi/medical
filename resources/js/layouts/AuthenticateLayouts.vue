<script setup>
import Header from '@/layouts/Components/Header.vue';
import SideBar from '@/layouts/Components/SideBar.vue';
import {useAuthStore} from "@/stores/auth.js";
import {useSettingsStore} from "@/stores/settings.js";
import {onBeforeMount} from "vue";

onBeforeMount(() => {
  useAuthStore().fetchUser()
  useSettingsStore().loadSettings()
})
</script>

<template>
  <div class="main-wrapper">
    <Header />
    <SideBar />
    <router-view></router-view>
  </div>
</template>

<style scoped></style>
