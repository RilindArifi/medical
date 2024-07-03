<script setup>
import {onBeforeMount, ref} from 'vue';
import useModelOperations from "@/composables/model-operations.js";
import {APPROVED, CANCELLED, PENDING, REJECTED} from "@/enums/status-appointments.js";


const
    options = ref([
      {value: PENDING, label: PENDING},
      {value: APPROVED, label: APPROVED},
      {value: REJECTED, label: REJECTED},
      {value: CANCELLED, label: CANCELLED},
    ]),
    focusHandle = async (opened) => {
      if (opened) {
        options.value
      }
    }

</script>

<template>
  <a-select
      show-search
      class="form-control"
      :options="options"
      @dropdownVisibleChange="focusHandle"
  />
</template>


<style scoped>

.form-control {
  padding: 6px 6px 6px 15px;
}
</style>