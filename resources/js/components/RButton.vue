<script setup>

const
    props = defineProps({
      isLoading: Boolean,
      text: String,
      classB: String
    })

</script>

<template>
  <b-button type="submit" variant="primary me-1" :class="classB">
    <span v-if="isLoading" class="spinner-border spinner-border-sm me-2" role="status"></span>
    {{text}}
  </b-button>
</template>

<style scoped>

</style>