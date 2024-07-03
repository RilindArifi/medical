<script setup>
import UploadAvatar from "@/components/UploadAvatar.vue";
import RadioStatus from "@/components/RadioStatus.vue";
import {useRoute} from "vue-router";

const
    props = defineProps({
      state: Object,
      fieldError: Function
    }),

    route = useRoute(),

    required = !route.path.includes('patients'),

    fieldError = (key) => {
      return props.fieldError(key)
    }
</script>

<template>
  <div class="col-12 col-sm-12">
    <div class="input-block local-forms">
      <label>Address <span v-if="required" class="login-danger">*</span></label>
      <textarea
          v-model="state.address"
          class="form-control" rows="3" cols="30"
          :class="{ 'is-invalid': fieldError('address') }"
      ></textarea>
      <div class="invalid-feedback">{{ fieldError('address') }}</div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-xl-3">
    <div class="input-block local-forms">
      <label>Country <span v-if="required" class="login-danger">*</span></label>
      <country-select
          v-model="state.country"
          :country="state.country"
          topCountry="US"
          class="form-control"
          placeholder=""
          :class="{ 'is-invalid': fieldError('country') }"
      />
      <div class="invalid-feedback">{{ fieldError('country') }}</div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-xl-3">
    <div class="input-block local-forms">
      <label>City <span v-if="required" class="login-danger">*</span></label>
      <region-select
          v-model="state.city"
          class="form-control"
          placeholder=""
          :class="{ 'is-invalid': fieldError('city') }"
          :country="state.country"
          :region="state.city"
      />
      <div class="invalid-feedback">{{ fieldError('city') }}</div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-xl-3">
    <div class="input-block local-forms">
      <label>Postal Code <span v-if="required" class="login-danger">*</span></label>
      <input
          v-model="state.postal_code"
          class="form-control"
          type="number"
          placeholder=""
          :class="{ 'is-invalid': fieldError('postal_code') }"
      />
      <div class="invalid-feedback">{{ fieldError('postal_code') }}</div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-xl-3">
    <div class="input-block select-gender">
      <label class="gen-label">Status <span class="login-danger">*</span></label>
      <radio-status
          v-model:value="state.status"
          :class="{ 'is-invalid': fieldError('status') }"
      />
      <div class="invalid-feedback">{{ fieldError('status') }}</div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-xl-4">
    <div class="input-block local-top-form">
      <upload-avatar :state="state"/>
    </div>
  </div>
</template>

<style scoped>

</style>