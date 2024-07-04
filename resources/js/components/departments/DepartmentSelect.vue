<script setup>
import { onBeforeMount, ref } from "vue";
import useModelOperations from "@/composables/model-operations.js";

const departments = useModelOperations("departments"),
    options = ref([]),
    isLoading = ref(false),
    search = async (query) => {
        isLoading.value = true;
        options.value = await departments.remoteModel(query);
        isLoading.value = false;
    };

onBeforeMount(() => search());
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
