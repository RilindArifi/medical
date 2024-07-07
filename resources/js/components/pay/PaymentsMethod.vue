<script setup>
import {computed, onBeforeMount, ref} from "vue";
import {BANK_TRANSFER, CASH, CREDIT_CARD, OTHER} from "@/enums/payments-method.js";

const
    options = ref([]),
    paymentMethods = computed(() => [ CASH, CREDIT_CARD, BANK_TRANSFER, OTHER]),
    isLoading = ref(false),
    remoteModel = async () => {
        let collect = [];
        paymentMethods.value.forEach((item) => {
            collect.push({
                value: item,
                label: item,
            });
        });
        options.value = collect

        return collect;
    }

onBeforeMount(() => remoteModel());
</script>

<template>
    <a-select
        show-search
        class="form-control"
        :options="options"
        :filter-option="false"
        :not-found-content="isLoading ? undefined : null"
    >
        <template v-if="isLoading" #notFoundContent>
            <a-spin size="small" />
        </template>
    </a-select>
</template>

<style scoped>
.form-control {
    padding: 6px 6px 6px 15px;
}
</style>
