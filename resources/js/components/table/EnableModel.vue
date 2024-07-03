<script setup>
import {ACTIVE} from "@/enums/status-global.js";

const
    props = defineProps({
      titleTooltip: {
        default: ACTIVE
      },
      model: String
    }),
    emit = defineEmits(['on-enabled']),
    confirmAction = () => {
      emit('on-enabled')
    }
</script>

<template>
  <a-tooltip placement="left" :title="titleTooltip">
    <a-popconfirm
        :title="`Are you sure you want ${titleTooltip} ?`"
        :ok-text="$t('yes')"
        placement="topRight"
        :cancel-text="$t('no')"
        @confirm="confirmAction"
    >
      <li class="li-check">
        <i class="fa fa-check" data-bs-toggle="tooltip"></i>
      </li>
    </a-popconfirm>
  </a-tooltip>
</template>

<style scoped>

</style>