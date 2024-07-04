<script setup>
const emit = defineEmits(["on-delete"]),
    confirmAction = () => {
        emit("on-delete");
    };
</script>

<template>
    <a-popconfirm
        :title="`Are you sure delete this?`"
        ok-text="Yes"
        placement="topRight"
        cancel-text="No"
        @confirm="confirmAction"
    >
        <li>
            <i
                class="fa fa-trash"
                data-bs-toggle="tooltip"
                title="fa fa-trash"
            ></i>
        </li>
    </a-popconfirm>
</template>

<style scoped></style>
