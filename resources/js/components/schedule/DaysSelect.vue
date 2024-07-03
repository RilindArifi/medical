<script setup>
import {onBeforeMount, ref} from 'vue';
import useModelOperations from "@/composables/model-operations.js";


const
    options = ref([
      { value: 'Monday', label: 'Monday'},
      { value: 'Tuesday', label: 'Tuesday'},
      { value: 'Wednesday', label: 'Wednesday'},
      { value: 'Thursday', label: 'Thursday'},
      { value: 'Friday', label: 'Friday'},
      { value: 'Saturday', label: 'Saturday'},
      { value: 'Sunday', label: 'Sunday'}
    ]),
    focusHandle = async (opened) => {
      if (opened) {
        options.value
      }
    }

</script>

<template>
    <a-select
        mode="multiple"
        show-search
        class="form-control"
        :options="options"
        @dropdownVisibleChange="focusHandle"
    />
</template>


<style scoped>

.form-control{
  padding: 6px;
}
</style>