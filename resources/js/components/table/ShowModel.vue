<script setup>

const
    props = defineProps({
      id: Number,
      model: String,
    })

</script>

<template>
  <router-link class="d-flex" :to="{name: `${model}.view`, params:{id: id}}">
    <li>
      <i class="fa fa-address-card" ></i>
    </li>
  </router-link>
</template>

<style scoped>

</style>