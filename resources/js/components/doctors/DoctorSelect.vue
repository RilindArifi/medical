<script setup>
import {onBeforeMount, ref} from 'vue';
import useModelOperations from "@/composables/model-operations.js";


  const
      doctors = useModelOperations('doctors'),
      options = ref([]),
      isLoading = ref(false),

      search = async (query) => {
        isLoading.value = true
        options.value = await doctors.remoteModel(query)
        isLoading.value = false
      }

      onBeforeMount(() => search())

</script>

<template>
  <a-select
      show-search
      class="form-control"
      :options="options"
      :filter-option="false"
      :not-found-content="isLoading ? undefined : null"
      @search="search"
  >
    <template v-if="isLoading" #notFoundContent>
      <a-spin size="small" />
    </template>
  </a-select>
</template>


<style scoped>

.form-control{
  padding: 6px 6px 6px 15px;
}
</style>