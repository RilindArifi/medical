<script setup>
import { INACTIVE } from "@/enums/status-global.js";

const props = defineProps({
        titleTooltip: {
            default: INACTIVE,
        },
    }),
    emit = defineEmits(["on-disabled"]),
    confirmAction = () => {
        emit("on-disabled");
    };
</script>

<template>
    <a-tooltip placement="right" :title="titleTooltip">
        <a-popconfirm
            :title="`Are you sure you want ${titleTooltip}?`"
            :ok-text="$t('yes')"
            placement="topRight"
            :cancel-text="$t('no')"
            @confirm="confirmAction"
        >
            <li class="li-times">
                <i class="fa fa-times" data-bs-toggle="tooltip"></i>
            </li>
        </a-popconfirm>
    </a-tooltip>
</template>

<style scoped></style>
