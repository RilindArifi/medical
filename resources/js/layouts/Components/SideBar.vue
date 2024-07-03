<script setup>
import SideBarItems from '@/layouts/Components/SideBarItems.vue'
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'
import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css'
import {useAuthStore} from "@/stores/auth.js";

const settings = {
  suppressScrollX: true
}
</script>

<template>
  <div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
      <PerfectScrollbar class="scroll-area" :settings="settings">
        <div id="sidebar-menu" class="sidebar-menu">
          <SideBarItems />
          <div class="logout-btn">
            <router-link :to="$slots" @click.prevent="useAuthStore().logout()" >
              <span class="menu-side">
                <img src="../../assets/img/icons/logout.svg" alt="" />
              </span>
              <span>Logout</span>
            </router-link>
          </div>
        </div>
      </PerfectScrollbar>
    </div>
  </div>
</template>
