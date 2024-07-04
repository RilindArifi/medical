<script setup>
import { ACTIVE } from "@/enums/status-global.js";

const props = defineProps({
    status: String,
});
</script>

<template>
    <span
        class="badge"
        :class="status === ACTIVE ? 'bg-success-light' : 'bg-danger-light'"
        >{{ status }}</span
    >
</template>
