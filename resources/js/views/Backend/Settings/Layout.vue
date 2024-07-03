<script setup>

import {useRoute} from "vue-router";
import {computed, onBeforeMount} from "vue";
import {useSettingsStore} from "@/stores/settings.js";
import useForm from "@/composables/form.js";
import {required} from "@vuelidate/validators";
import axiosClient from "@/axios.js";
import {buildFormData} from "@/utils/form.js";
import {message} from "ant-design-vue";


const
    route = useRoute(),
    currentPath = computed(() => route.name),
    settingsStore = useSettingsStore(),

    {isLoading, v$, state, errors, fieldError, prepareRequest} = useForm({
      useFormChanges: true,
      initialState: {
        // app_name: null,
        // app_domain: null,
        // logo: null,
        // logo_url: null,
        // favicon: null,
        // favicon_url: null,
        // date_format: null,
        // time_format: null,
        working_days: [],
        holidays: [],
        working_hours: null,
        // event_name: null,
        // pusher_app_id: null,
        // pusher_key: null,
        // pusher_secret: null,
        // pusher_cluster: null,
      },

      rules: {
        // app_name: {required},
        // app_domain: {required},
        // date_format: {required},
        // time_format: {required},
        working_hours: {required},
        working_days: {required},
      }

    }),
    onSubmit = async () => {
      errors.value = {};
      const result = await v$.value.$validate();

      if (!result) {
        return;
      }

      await prepareRequest(() =>
          axiosClient.post(`settings/update`, buildFormData(state.value), {headers: {'Content-Type': 'multipart/form-data'}})
              .then((response) => {
                message.success('Settings has been successfully')
                settingsStore.setSettings(response.data.data);
              })
      )
    }

onBeforeMount(async () => {
  state.value = settingsStore.settings
})
</script>

<template>
  <div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <breadcrumb title="Dashboard" text="Settings" path="/dashboard" />
      <!-- Settings Menu -->
      <div class="settings-menu-links">
        <ul class="nav nav-tabs menu-tabs">
          <li class="nav-item settings" :class="{ active: currentPath === 'general.settings' }">
            <router-link class="nav-link" :to="{name: 'general.settings'}">General Settings</router-link>
          </li>
          <li class="nav-item settings" :class="{ active: currentPath === 'localization.settings' }">
            <router-link class="nav-link" :to="{name: 'localization.settings'}">Localization</router-link>
          </li>
          <li class="nav-item settings" :class="{ active: currentPath === 'business_hours.settings' }">
            <router-link class="nav-link" :to="{name: 'business_hours.settings'}">Business Hours</router-link>
          </li>
          <li class="nav-item settings" :class="{ active: currentPath === 'payment.settings' }">
            <router-link class="nav-link" :to="{name: 'payment.settings'}">Payment Settings</router-link>
          </li>
          <li class="nav-item settings" :class="{ active: currentPath === 'email.settings' }">
            <router-link class="nav-link" :to="{name: 'email.settings'}">Email Settings</router-link>
          </li>
          <li class="nav-item settings" :class="{ active: currentPath === 'social.media' }">
            <router-link class="nav-link" :to="{name: 'social.media'}">Social Media Login</router-link>
          </li>
          <li class="nav-item settings" :class="{ active: currentPath === 'social.links' }">
            <router-link class="nav-link" :to="{name: 'social.links'}">Social Links</router-link>
          </li>
          <li class="nav-item settings" :class="{ active: currentPath === 'seo.settings' }">
            <router-link class="nav-link" :to="{name: 'seo.settings'}">SEO Settings</router-link>
          </li>
          <li class="nav-item settings" :class="{ active: currentPath === 'others.settings' }">
            <router-link class="nav-link" :to="{name: 'others.settings'}">Others</router-link>
          </li>
        </ul>
      </div>
      <router-view :state="state" :fieldError="fieldError"/>
      <div class="input-block mb-0">
        <div class="settings-btns">
          <button
              @click.prevent="onSubmit"
              type="submit"
              class="border-0 btn btn-primary btn-gradient-primary btn-rounded"
          >
            Submit </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Settings Menu -->
</template>


