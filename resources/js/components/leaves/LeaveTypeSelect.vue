<script setup>
import { onBeforeMount, ref } from "vue";
import useModelOperations from "@/composables/model-operations.js";

const model = useModelOperations("leave_types"),
    options = ref([]),
    isLoading = ref(false),
    focusHandle = async (opened) => {
        if (opened) {
            await remoteMethod();
        }
    },
    remoteMethod = async (query) => {
        isLoading.value = true;
        options.value = await model.remoteModel(query);
        isLoading.value = false;
    };

onBeforeMount(() => remoteMethod());
</script>

<template>
    <a-select
        :loading="isLoading"
        show-search
        class="form-control"
        :options="options"
        @search="remoteMethod"
        @dropdownVisibleChange="focusHandle"
    />
</template>

<style scoped>
.form-control {
    padding: 6px 6px 6px 15px;
}
</style>
