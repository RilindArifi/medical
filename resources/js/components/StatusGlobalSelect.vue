<script setup>
import { onBeforeMount, ref } from "vue";
import useModelOperations from "@/composables/model-operations.js";
import {
    APPROVED,
    CANCELLED,
    PENDING,
    REJECTED,
} from "@/enums/status-appointments.js";
import { ACTIVE, INACTIVE } from "@/enums/status-global.js";

const options = ref([
        { value: ACTIVE, label: ACTIVE },
        { value: INACTIVE, label: INACTIVE },
    ]),
    focusHandle = async (opened) => {
        if (opened) {
            options.value;
        }
    };
</script>

<template>
    <a-select
        show-search
        class="form-control"
        :options="options"
        @dropdownVisibleChange="focusHandle"
        placeholder="Enter status name"
    />
</template>

<style scoped>
.form-control {
    padding: 6px 6px 6px 15px;
}
</style>
