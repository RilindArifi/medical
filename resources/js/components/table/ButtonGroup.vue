<script setup>

const
    emit = defineEmits(['on-deleted','on-fetch']),
    props = defineProps({
      deleted: Boolean,
      model: String
    })

</script>

<template>
  <router-link v-if="$can(`create ${model}`)" :to="{name: `${model}.create`}" class="btn btn-primary add-pluss ms-2">
    <img src="@/assets/img/icons/plus.svg" alt="" />
  </router-link>
  <a href="javascript:" @click="emit('on-fetch')" class="btn btn-primary doctor-refresh ms-2"
  ><img src="@/assets/img/icons/re-fresh.svg" alt="" />
  </a>
  <a-tooltip placement="topLeft" :title="deleted ? `Active ${model}` : `Deleted ${model}`">
    <button @click="emit('on-deleted')" class="btn btn-trash doctor-refresh ms-2">
      <i class="fa fa-lg" :class="deleted ? 'fa-check-circle' : 'fa-trash'" data-bs-toggle="tooltip" title="fa fa-trash"></i>
    </button>
  </a-tooltip>
</template>