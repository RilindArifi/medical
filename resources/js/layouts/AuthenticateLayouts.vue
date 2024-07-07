<script setup>
import Header from "@/layouts/Components/Header.vue";
import SideBar from "@/layouts/Components/SideBar.vue";
import { useAuthStore } from "@/stores/auth.js";
import { useSettingsStore } from "@/stores/settings.js";
import { onBeforeMount } from "vue";

onBeforeMount(() => {
    useAuthStore().fetchUser();
    useSettingsStore().loadSettings();
});
</script>

<template>
    <div class="main-wrapper">
        <Header />
        <SideBar />
        <router-view></router-view>
    </div>
</template>

<style >
:where(.css-dev-only-do-not-override-1hsjdkk).ant-table-wrapper .ant-table-thead>tr>th, :where(.css-dev-only-do-not-override-1hsjdkk).ant-table-wrapper .ant-table-tbody>tr>td, :where(.css-dev-only-do-not-override-1hsjdkk).ant-table-wrapper tfoot>tr>th, :where(.css-dev-only-do-not-override-1hsjdkk).ant-table-wrapper tfoot>tr>td {
    padding: 8px 16px;
}
:where(.css-dev-only-do-not-override-1hsjdkk).ant-select-single:not( .ant-select-customize-input ) .ant-select-selector {
    height: 26px;
}
</style>
