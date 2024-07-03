<script setup>

const
    emit = defineEmits(['on-restore']),
    confirmAction = () => {
      emit('on-restore')
    }
</script>

<template>
  <a-popconfirm
      :title="`Are you sure restore this?`"
      ok-text="Yes"
      placement="topRight"
      cancel-text="No"
      @confirm="confirmAction"
  >
    <li>
      <i class="fa-solid fa-trash-can-arrow-up" data-bs-toggle="tooltip"></i>
    </li>
  </a-popconfirm>
</template>

<style scoped>

</style>